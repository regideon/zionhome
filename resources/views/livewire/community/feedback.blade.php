<div class="space-y-6 pb-4">

    {{-- Flash success --}}
    @if(session('success'))
        <div class="bg-green-50 border border-green-200 text-green-700 rounded-xl px-4 py-3 text-sm font-medium flex items-center gap-2">
            <span class="material-symbols-outlined text-green-600 !text-lg">check_circle</span>
            {{ session('success') }}
        </div>
    @endif

    {{-- Hero --}}
    <section>
        <h1 class="text-[32px] font-extrabold tracking-tight text-on-surface leading-tight">Community Care</h1>
        <p class="text-base text-on-surface-variant mt-1">How can we help make your neighborhood better today?</p>
    </section>

    {{-- File a New Concern Card --}}
    @if(!$showForm)
    <section>
        <div class="bg-blue-600 text-white rounded-[20px] p-6 shadow-lg flex flex-col gap-4 relative overflow-hidden">
            <div class="z-10">
                <h2 class="text-xl font-bold mb-1">File a New Feedback or Concern</h2>
                <p class="text-sm font-semibold opacity-90">Report feedback or issues directly to the HOA team.</p>
            </div>
            <div class="z-10 flex gap-2 mt-2">
                <button wire:click="toggleForm"
                        class="bg-white text-blue-600 px-5 py-2.5 rounded-xl text-sm font-bold shadow-sm active:scale-95 transition-transform">
                    Submit a Report
                </button>
            </div>
            <div class="absolute -right-4 -bottom-4 opacity-20 transform rotate-12 pointer-events-none">
                <span class="material-symbols-outlined" style="font-size: 120px; line-height: 1;">edit_note</span>
            </div>
        </div>
    </section>
    @endif

    {{-- Recent Requests --}}
    @if(!$showForm && $recentFeedbacks->isNotEmpty())
        <section>
            <div class="flex items-center justify-between mb-4">
                <h3 class="text-xl font-bold text-on-surface">Recent Requests</h3>
                <span class="text-sm font-semibold text-blue-600">View All</span>
            </div>
            <div class="flex flex-col gap-4">
                @foreach($recentFeedbacks as $fb)
                    @php
                        $typeIconMap = [
                            'Concern'             => 'report_problem',
                            'Complaint'           => 'feedback',
                            'Suggestion'          => 'lightbulb',
                            'Appreciation'        => 'thumb_up',
                            'Maintenance Request' => 'construction',
                            'Security Concern'    => 'security',
                            'Billing Concern'     => 'receipt_long',
                            'Inquiry'             => 'help',
                        ];
                        $icon       = $typeIconMap[$fb->type?->name] ?? 'chat_bubble';
                        $statusName = $fb->status?->name ?? 'Submitted';
                        $isResolved = in_array($statusName, ['Resolved', 'Closed']);
                        $isProgress = in_array($statusName, ['In Progress', 'Assigned']);
                    @endphp
                    <div class="bg-white rounded-[16px] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-100">
                        <div class="flex justify-between items-start mb-3">
                            <div class="flex items-center gap-3">
                                <div class="w-10 h-10 rounded-xl flex items-center justify-center
                                    {{ $isResolved ? 'bg-green-100 text-green-700' : ($isProgress ? 'bg-amber-100 text-amber-700' : 'bg-blue-50 text-blue-600') }}">
                                    <span class="material-symbols-outlined !text-[20px]">{{ $icon }}</span>
                                </div>
                                <div>
                                    <h4 class="text-sm font-bold text-on-surface leading-tight">{{ $fb->type?->name ?? 'Concern' }}</h4>
                                    <p class="text-[11px] text-on-surface-variant">{{ $fb->reference_no }}</p>
                                </div>
                            </div>
                            <span class="px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider
                                {{ $isResolved ? 'bg-green-100 text-green-700' : ($isProgress ? 'bg-amber-100 text-amber-700' : 'bg-stone-100 text-stone-500') }}">
                                {{ $statusName }}
                            </span>
                        </div>

                        @if($isProgress)
                            <div class="h-1.5 w-full bg-stone-100 rounded-full overflow-hidden">
                                <div class="h-full bg-amber-400 w-[60%] rounded-full"></div>
                            </div>
                            <div class="flex justify-between mt-2">
                                <p class="text-[11px] text-on-surface-variant">{{ Str::limit($fb->message, 40) }}</p>
                                <p class="text-[11px] text-on-surface-variant">{{ $fb->submitted_at?->diffForHumans() }}</p>
                            </div>
                        @elseif($isResolved)
                            <div class="flex items-center gap-2 mt-3 p-3 bg-green-50 rounded-lg border border-green-100">
                                <span class="material-symbols-outlined text-green-600 !text-lg" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                                <p class="text-[11px] text-green-700 font-medium">
                                    Resolved {{ $fb->resolved_at?->diffForHumans() ?? $fb->updated_at->diffForHumans() }}
                                </p>
                            </div>
                        @else
                            <p class="text-[11px] text-on-surface-variant mt-1 leading-relaxed">{{ Str::limit($fb->message, 70) }}</p>
                        @endif
                    </div>
                @endforeach
            </div>
        </section>
    @endif

    {{-- Submit Form --}}
    @if($showForm)
        <section class="bg-white rounded-[24px] p-6 shadow-xl border border-stone-100">
            <div class="flex items-center gap-3 mb-6">
                <button wire:click="toggleForm" class="w-9 h-9 flex items-center justify-center rounded-xl bg-stone-100 text-stone-500 active:scale-95 transition-transform">
                    <span class="material-symbols-outlined !text-[20px]">arrow_back</span>
                </button>
                <h3 class="text-xl font-bold text-on-surface">Submit a Report</h3>
            </div>
            <form wire:submit="submit" class="flex flex-col gap-6">

                {{-- Type pills --}}
                <div class="flex flex-col gap-2">
                    <label class="text-[11px] font-bold text-stone-400 uppercase tracking-widest px-1">Type of Feedback</label>
                    <div class="flex flex-wrap gap-2">
                        @foreach($feedbackTypes as $type)
                            <button type="button"
                                    wire:click="selectType({{ $type->id }})"
                                    class="px-4 py-2 rounded-full text-sm font-semibold transition-all active:scale-95
                                        {{ $selectedTypeId === $type->id
                                            ? 'bg-blue-600 text-white shadow-sm'
                                            : 'bg-stone-100 text-stone-600 border border-stone-200' }}">
                                {{ $type->name }}
                            </button>
                        @endforeach
                    </div>
                    @error('selectedTypeId')
                        <p class="text-red-500 text-xs px-1">Please select a type.</p>
                    @enderror
                </div>

                {{-- Description --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1">Description</label>
                    <textarea wire:model="description"
                              class="w-full bg-stone-50 border border-stone-200 rounded-xl p-4 focus:ring-2 focus:ring-blue-500 focus:border-transparent text-base placeholder:text-stone-400 resize-none outline-none transition"
                              placeholder="Tell us more about your feedback..."
                              rows="3"></textarea>
                    @error('description')
                        <p class="text-red-500 text-xs px-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Photo upload --}}
                <div class="flex flex-col gap-2">
                    <label class="text-sm font-semibold text-on-surface-variant px-1">Photo Reference</label>
                    <label class="border-2 border-dashed border-stone-200 rounded-xl p-8 flex flex-col items-center justify-center gap-2 bg-stone-50/50 hover:bg-stone-100/50 transition-colors cursor-pointer">
                        <span class="material-symbols-outlined text-stone-400 !text-[32px]">add_a_photo</span>
                        @if($photo)
                            <p class="text-sm text-blue-600 font-medium">{{ $photo->getClientOriginalName() }}</p>
                        @else
                            <p class="text-[11px] text-stone-400">Upload or take a photo</p>
                        @endif
                        <input type="file" wire:model="photo" class="hidden" accept="image/*" capture="environment">
                        @error('photo')
                            <p class="text-red-500 text-xs px-1">{{ $message }}</p>
                        @enderror
                    </label>
                    @error('photo')
                        <p class="text-red-500 text-xs px-1">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Submit button --}}
                <button type="submit"
                        class="h-14 bg-blue-600 text-white rounded-xl font-bold text-base shadow-md active:scale-95 transition-all mt-2 flex items-center justify-center gap-2 disabled:opacity-70"
                        wire:loading.attr="disabled">
                    <span wire:loading.remove wire:target="submit">Submit Concern</span>
                    <span wire:loading wire:target="submit" class="flex items-center gap-2">
                        <span class="material-symbols-outlined !text-base animate-spin">progress_activity</span>
                        Submitting...
                    </span>
                </button>
            </form>
        </section>
    @endif

</div>
