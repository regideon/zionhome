<?php

namespace App\Livewire\Community;

use App\Models\Feedback as FeedbackModel;
use App\Models\FeedbackStatus;
use App\Models\FeedbackType;
use App\Support\ModuleReference;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout('layouts.community')]
class Feedback extends Component
{
    use WithFileUploads;

    public ?int $selectedTypeId = null;
    public string $description = '';
    public $photo = null;
    public bool $showForm = false;

    public function selectType(int $typeId): void
    {
        $this->selectedTypeId = ($this->selectedTypeId === $typeId) ? null : $typeId;
    }

    public function toggleForm(): void
    {
        $this->showForm = ! $this->showForm;
        $this->reset(['selectedTypeId', 'description', 'photo']);
    }

    public function submit(): void
    {
        $this->validate([
            'selectedTypeId' => 'required|exists:feedback_types,id',
            'description'    => 'required|min:10|max:2000',
            'photo'          => 'nullable|image|max:5120',
        ]);

        $defaultStatus = FeedbackStatus::where('name', 'Submitted')->first()
            ?? FeedbackStatus::first();

        $feedback = FeedbackModel::create([
            'user_id'            => auth()->id(),
            'feedback_type_id'   => $this->selectedTypeId,
            'feedback_status_id' => $defaultStatus?->id,
            'message'            => $this->description,
            'submitted_at'       => now(),
            'reference_no'       => ModuleReference::generate('feedback'),
        ]);

        if ($this->photo) {
            $path = $this->photo->store('feedback-attachments', 'public');
            $feedback->attachments()->create([
                'file_path' => $path,
                'file_name' => $this->photo->getClientOriginalName(),
                'file_type' => $this->photo->getMimeType(),
            ]);
        }

        $this->reset(['selectedTypeId', 'description', 'photo', 'showForm']);
        session()->flash('success', 'Your concern has been submitted successfully!');
    }

    public function render(): \Illuminate\View\View
    {
        return view('livewire.community.feedback', [
            'feedbackTypes'   => FeedbackType::where('is_active', true)->get(),
            'recentFeedbacks' => FeedbackModel::with(['type', 'status'])
                ->where('user_id', auth()->id())
                ->latest('submitted_at')
                ->limit(3)
                ->get(),
        ]);
    }
}
