<?php

namespace App\Livewire\Community;

use App\Models\Feedback as FeedbackModel;
use App\Models\FeedbackAiLog;
use App\Models\FeedbackCategory;
use App\Models\FeedbackPriority;
use App\Models\FeedbackStatus;
use App\Models\FeedbackType;
use App\Support\ModuleReference;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use OpenAI\Laravel\Facades\OpenAI;

#[Layout('layouts.community')]
class Feedback extends Component
{
    use WithFileUploads;

    public ?int $selectedTypeId     = null;
    public ?int $selectedPriorityId = null;
    public ?int $selectedCategoryId = null;
    public string $description      = '';
    public $photo                   = null;
    public bool $showForm           = false;
    public ?array $aiResult         = null;

    public function mount(): void
    {
        $this->selectedTypeId = FeedbackType::where('is_active', true)->value('id');
    }

    public function updatedDescription(): void
    {
        if (strlen(trim($this->description)) < 15) {
            return;
        }

        $this->classifyWithAI();
    }

    public function selectType(int $typeId): void
    {
        $this->selectedTypeId = ($this->selectedTypeId === $typeId) ? null : $typeId;
    }

    public function toggleForm(): void
    {
        $this->showForm = ! $this->showForm;
        $this->reset(['selectedTypeId', 'selectedPriorityId', 'selectedCategoryId', 'description', 'photo', 'aiResult']);
        $this->selectedTypeId = FeedbackType::where('is_active', true)->value('id');
    }

    public function classifyWithAI(): void
    {
        $types      = FeedbackType::where('is_active', true)->pluck('name', 'id');
        $priorities = FeedbackPriority::orderBy('sort_order')->pluck('name', 'id');
        $categories = FeedbackCategory::where('is_active', true)->pluck('name', 'id');

        $typeList     = $types->map(fn($n, $i) => "{$i}: {$n}")->implode(', ');
        $priorityList = $priorities->map(fn($n, $i) => "{$i}: {$n}")->implode(', ');
        $categoryList = $categories->map(fn($n, $i) => "{$i}: {$n}")->implode(', ');

        $prompt = <<<EOT
You are an AI assistant for a Philippine subdivision HOA (Homeowners Association) management system.
Analyze the following resident feedback, which may be in Filipino/Tagalog, English, or mixed (Taglish).
Respond ONLY with a valid JSON object — no markdown, no explanation.

Feedback: "{$this->description}"

Available feedback_type_id options: {$typeList}
Available feedback_priority_id options: {$priorityList}
Available feedback_category_id options: {$categoryList}

Rules:
- "May magnanakaw", "may nakalusot", "gate security", fire, flood, medical emergency → priority=Emergency (id=1)
- Maintenance, broken streetlights, garbage → priority=High or Medium
- Suggestions, appreciations → priority=Low
- Match language context carefully

Return exactly this JSON structure:
{
  "feedback_type_id": <integer>,
  "feedback_priority_id": <integer>,
  "feedback_category_id": <integer>,
  "detected_sentiment": "<positive|negative|neutral|urgent>",
  "is_high_risk": <true|false>,
  "summary": "<one-sentence English summary>",
  "suggested_action": "<brief action for HOA staff in English>"
}
EOT;

        try {
            $response = OpenAI::chat()->create([
                'model'       => env('OPENAI_MODEL', 'gpt-4o-mini'),
                'messages'    => [
                    ['role' => 'system', 'content' => 'You are an HOA feedback classifier. Respond only with valid JSON.'],
                    ['role' => 'user',   'content' => $prompt],
                ],
                'temperature' => 0.1,
                'max_tokens'  => 300,
            ]);

            $raw  = trim($response->choices[0]->message->content);
            $data = json_decode($raw, true);

            if (json_last_error() !== JSON_ERROR_NONE || ! is_array($data)) {
                return;
            }

            $this->selectedTypeId     = isset($data['feedback_type_id'])    ? (int) $data['feedback_type_id']    : $this->selectedTypeId;
            $this->selectedPriorityId = isset($data['feedback_priority_id']) ? (int) $data['feedback_priority_id'] : null;
            $this->selectedCategoryId = isset($data['feedback_category_id']) ? (int) $data['feedback_category_id'] : null;

            $this->aiResult = [
                'feedback_type_id'      => $data['feedback_type_id'] ?? null,
                'feedback_priority_id'  => $data['feedback_priority_id'] ?? null,
                'feedback_category_id'  => $data['feedback_category_id'] ?? null,
                'detected_sentiment'    => $data['detected_sentiment'] ?? null,
                'detected_priority'     => $priorities[(int) ($data['feedback_priority_id'] ?? 0)] ?? null,
                'detected_category'     => $categories[(int) ($data['feedback_category_id'] ?? 0)] ?? null,
                'is_high_risk'          => (bool) ($data['is_high_risk'] ?? false),
                'summary'               => $data['summary'] ?? null,
                'suggested_action'      => $data['suggested_action'] ?? null,
                'raw_response'          => $data,
            ];
        } catch (\Throwable $e) {
            logger()->error('AI classification failed: ' . $e->getMessage());
        }
    }

    public function submit(): void
    {
        $this->validate([
            'selectedTypeId' => 'required|exists:feedback_types,id',
            'description'    => 'required|min:10|max:2000',
            'photo'          => 'nullable|image|max:5120',
        ]);

        $user    = auth()->user();
        $profile = $user->homeownerProfile;

        $property = null;
        if ($profile) {
            $ownership = $profile->propertyOwnerships()
                ->where('is_current', true)
                ->with('property')
                ->first();
            $property = $ownership?->property;
        }

        $defaultStatus = FeedbackStatus::where('name', 'Submitted')->first()
            ?? FeedbackStatus::first();

        $feedback = FeedbackModel::create([
            'user_id'              => $user->id,
            'homeowner_profile_id' => $profile?->id,
            'property_id'          => $property?->id,
            'subdivision_phase_id' => $property?->subdivision_phase_id,
            'street_id'            => $property?->street_id,
            'block_no'             => $property?->block_no,
            'lot_no'               => $property?->lot_no,
            'feedback_type_id'     => $this->selectedTypeId,
            'feedback_category_id' => $this->selectedCategoryId,
            'feedback_priority_id' => $this->selectedPriorityId,
            'feedback_status_id'   => $defaultStatus?->id,
            'is_emergency'         => (bool) ($this->aiResult['is_high_risk'] ?? false),
            'message'              => $this->description,
            'submitted_at'         => now(),
            'reference_no'         => ModuleReference::generate('feedback'),
        ]);

        if ($this->photo) {
            $path = $this->photo->store('feedback-attachments', 'public');
            $feedback->attachments()->create([
                'file_path' => $path,
                'file_name' => $this->photo->getClientOriginalName(),
                'file_type' => $this->photo->getMimeType(),
            ]);
        }

        if ($this->aiResult) {
            FeedbackAiLog::create([
                'feedback_id'        => $feedback->id,
                'detected_category'  => $this->aiResult['detected_category'] ?? null,
                'detected_sentiment' => $this->aiResult['detected_sentiment'] ?? null,
                'detected_priority'  => $this->aiResult['detected_priority'] ?? null,
                'is_high_risk'       => $this->aiResult['is_high_risk'] ?? false,
                'summary'            => $this->aiResult['summary'] ?? null,
                'suggested_action'   => $this->aiResult['suggested_action'] ?? null,
                'raw_response'       => $this->aiResult['raw_response'] ?? null,
            ]);
        }

        $this->reset(['selectedTypeId', 'selectedPriorityId', 'selectedCategoryId', 'description', 'photo', 'showForm', 'aiResult']);
        session()->flash('success', 'Your concern has been submitted successfully!');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.community.feedback', [
            'feedbackTypes'      => FeedbackType::where('is_active', true)->get(),
            'feedbackPriorities' => FeedbackPriority::orderBy('sort_order')->get(),
            'recentFeedbacks'    => FeedbackModel::with(['type', 'status'])
                ->where('user_id', auth()->id())
                ->latest('submitted_at')
                ->limit(3)
                ->get(),
        ]);
    }
}
