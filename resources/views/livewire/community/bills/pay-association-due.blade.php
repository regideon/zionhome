<div class="space-y-6 pb-6">

    {{-- Sub-page header --}}
    <div class="-mx-4 px-4 py-3 bg-white border-b border-slate-100 sticky top-16 z-40 flex items-center gap-3">
        <a href="{{ route('community.bills') }}"
           class="w-9 h-9 flex items-center justify-center rounded-xl bg-slate-100 text-slate-500 active:scale-95 transition-transform">
            <span class="material-symbols-outlined text-[20px]">arrow_back</span>
        </a>
        <h1 class="text-[18px] font-bold text-primary">Create Payment</h1>
    </div>

    {{-- Header --}}
    <section class="pt-1">
        <h2 class="text-[24px] font-semibold text-on-surface">Payment Details</h2>
        <p class="text-sm text-on-surface-variant mt-1">
            Pay your dues and upload your receipt for verification. Please double check details bago i-submit.
        </p>
    </section>

    {{-- Outstanding Balance Card --}}
    <section>
        <div class="bg-white rounded-[20px] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-100 relative overflow-hidden">
            <div class="absolute top-4 right-4">
                <span class="bg-red-50 text-red-600 px-3 py-1 rounded-full text-[11px] font-bold">Payment Needed</span>
            </div>
            <p class="text-[12px] font-semibold text-on-surface-variant">Outstanding Balance</p>
            <h3 class="text-[32px] font-bold text-primary mt-1">
                &#8369;{{ number_format($due->balance_amount, 2) }}
            </h3>
            <div class="mt-4 space-y-2 border-t border-stone-100 pt-4">
                <div class="flex justify-between text-[14px]">
                    <span class="text-on-surface-variant">Association Dues ({{ $due->billing_year }})</span>
                    <span class="font-semibold">&#8369;{{ number_format($due->balance_amount, 2) }}</span>
                </div>
                <div class="flex justify-between text-[14px] mt-2 pt-2 border-t border-dashed border-stone-200">
                    <span class="text-on-surface-variant italic">Ref No.</span>
                    <span class="font-bold text-on-surface">{{ $due->reference_no }}</span>
                </div>
            </div>
        </div>
    </section>

    {{-- Select What to Pay --}}
    <section class="space-y-3">
        <div class="flex justify-between items-end">
            <h4 class="text-[20px] font-semibold text-on-surface">Select What to Pay</h4>
            <span class="text-primary text-[13px] font-bold">
                Total: &#8369;{{ number_format($this->selectedTotal, 2) }}
            </span>
        </div>

        <div class="space-y-3">
            @foreach($this->payableItems as $item)
                @php $checked = in_array((string) $item->id, $selectedItemIds); @endphp
                <button type="button"
                        wire:click="toggleItem({{ $item->id }})"
                        class="w-full flex items-center gap-4 p-4 rounded-xl border transition-all active:scale-[0.98]
                            {{ $checked
                                ? 'bg-blue-50 border-blue-200'
                                : 'bg-surface-container-low border-stone-200' }}">
                    <div class="w-6 h-6 rounded flex items-center justify-center flex-shrink-0
                        {{ $checked ? 'bg-primary' : 'bg-stone-200' }}">
                        @if($checked)
                            <span class="material-symbols-outlined text-white text-[16px]" style="font-variation-settings: 'FILL' 1;">check</span>
                        @endif
                    </div>
                    <div class="flex-1 text-left">
                        <p class="text-[14px] font-bold text-on-surface">{{ $item->description }}</p>
                        <p class="text-[12px] text-on-surface-variant">
                            Due: {{ \Carbon\Carbon::parse($item->due_date)->format('M d, Y') }}
                        </p>
                    </div>
                    <span class="font-bold text-[14px] text-on-surface flex-shrink-0">
                        &#8369;{{ number_format($item->balance_amount, 2) }}
                    </span>
                </button>
            @endforeach
        </div>
        @error('selectedItemIds')
            <p class="text-red-500 text-xs">Please select at least one item.</p>
        @enderror
    </section>

    {{-- Payment Method --}}
    <section class="space-y-3">
        <h4 class="text-[20px] font-semibold text-on-surface">Payment Method</h4>
        <div class="flex gap-3 overflow-x-auto pb-1" style="-ms-overflow-style:none; scrollbar-width:none;">
            @foreach([
                ['key' => 'gcash', 'icon' => 'wallet',           'label' => 'GCash'],
                ['key' => 'bank',  'icon' => 'account_balance',   'label' => 'Bank'],
                ['key' => 'cash',  'icon' => 'payments',          'label' => 'Cash'],
                ['key' => 'check', 'icon' => 'description',       'label' => 'Check'],
            ] as $method)
                <button type="button"
                        wire:click="selectPaymentMethod('{{ $method['key'] }}')"
                        class="flex-shrink-0 px-5 py-3 rounded-xl flex items-center gap-2 border-2 transition-all active:scale-95
                            {{ $paymentMethod === $method['key']
                                ? 'bg-primary text-white border-primary shadow-md shadow-primary/20'
                                : 'bg-surface-container-low text-on-surface-variant border-transparent' }}">
                    <span class="material-symbols-outlined text-[20px]">{{ $method['icon'] }}</span>
                    <span class="text-[14px] font-semibold">{{ $method['label'] }}</span>
                </button>
            @endforeach
        </div>

        {{-- GCash Info Card --}}
        @if($paymentMethod === 'gcash')
            <div class="bg-blue-50 border border-blue-100 rounded-2xl p-5 flex gap-4">
                <div class="flex-1 space-y-2">
                    <p class="text-[10px] font-bold text-primary uppercase tracking-wider">GCash Payment Info</p>
                    <div>
                        <p class="text-[12px] text-on-surface-variant">Account Name</p>
                        <p class="font-bold text-on-surface text-[14px]">ZionHome Highlands HOA</p>
                    </div>
                    <div>
                        <p class="text-[12px] text-on-surface-variant">Account Number</p>
                        <p class="font-bold text-on-surface text-[14px]">0917 123 4567</p>
                    </div>
                    <p class="text-[11px] text-on-surface-variant mt-1 italic leading-tight">
                        Send exact amount then screenshot po your receipt. Salamat!
                    </p>
                </div>
                <div class="w-20 h-20 bg-white rounded-xl border border-blue-100 flex items-center justify-center shadow-sm flex-shrink-0">
                    <img src="{{ asset('images/dummy/gcash.png') }}"
                         alt="GCash QR" class="w-16 h-16 object-contain rounded-lg"/>
                </div>
            </div>
        @endif

        @if($paymentMethod === 'bank')
            <div class="bg-slate-50 border border-slate-200 rounded-2xl p-5 space-y-2">
                <p class="text-[10px] font-bold text-slate-500 uppercase tracking-wider">Bank Transfer Info</p>
                <div>
                    <p class="text-[12px] text-on-surface-variant">Bank / Account Name</p>
                    <p class="font-bold text-on-surface text-[14px]">BDO — ZionHome HOA</p>
                </div>
                <div>
                    <p class="text-[12px] text-on-surface-variant">Account Number</p>
                    <p class="font-bold text-on-surface text-[14px]">0012 3456 7890</p>
                </div>
            </div>
        @endif
    </section>

    {{-- Upload Receipt --}}
    <section class="space-y-4">
        <h4 class="text-[20px] font-semibold text-on-surface">Upload Receipt</h4>
        <label class="border-2 border-dashed border-stone-200 rounded-2xl p-8 bg-surface-container-low flex flex-col items-center justify-center gap-3 text-center cursor-pointer active:scale-[0.98] transition-all">
            <div class="w-14 h-14 bg-primary/10 rounded-full flex items-center justify-center text-primary">
                <span class="material-symbols-outlined text-[28px]">add_a_photo</span>
            </div>
            @if($receipt)
                <p class="font-bold text-primary text-sm">{{ $receipt->getClientOriginalName() }}</p>
            @else
                <div>
                    <p class="font-bold text-on-surface text-sm">Tap to upload receipt</p>
                    <p class="text-[12px] text-on-surface-variant">JPEG, PNG or PDF (Max 5MB)</p>
                </div>
            @endif
            <input type="file" wire:model="receipt" class="hidden" accept="image/*,.pdf" capture="environment">
        </label>
        @error('receipt')
            <p class="text-red-500 text-xs">{{ $message }}</p>
        @enderror

        <div class="space-y-4">
            <div class="space-y-1.5">
                <label class="text-[14px] font-bold text-on-surface px-1">Reference Number</label>
                <input wire:model="referenceNumber"
                       type="text"
                       placeholder="Enter Ref # from receipt"
                       class="w-full bg-surface-container-low border-none rounded-xl py-4 px-4 focus:ring-2 focus:ring-primary text-on-surface outline-none text-[14px]"/>
                @error('referenceNumber')
                    <p class="text-red-500 text-xs px-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="grid grid-cols-2 gap-4">
                <div class="space-y-1.5">
                    <label class="text-[14px] font-bold text-on-surface px-1">Paid Date</label>
                    <input wire:model="paidDate"
                           type="date"
                           class="w-full bg-surface-container-low border-none rounded-xl py-4 px-4 focus:ring-2 focus:ring-primary text-on-surface outline-none text-[14px]"/>
                    @error('paidDate')
                        <p class="text-red-500 text-xs px-1">{{ $message }}</p>
                    @enderror
                </div>
                <div class="space-y-1.5">
                    <label class="text-[14px] font-bold text-on-surface px-1">Amount Paid</label>
                    <input wire:model="amountPaid"
                           type="number"
                           step="0.01"
                           placeholder="0.00"
                           class="w-full bg-surface-container-low border-none rounded-xl py-4 px-4 focus:ring-2 focus:ring-primary font-bold text-primary outline-none text-[14px]"/>
                    @error('amountPaid')
                        <p class="text-red-500 text-xs px-1">{{ $message }}</p>
                    @enderror
                </div>
            </div>
        </div>
    </section>

    {{-- Review Summary --}}
    <section class="bg-stone-50 rounded-[20px] p-6 border border-stone-200">
        <h4 class="text-[20px] font-semibold text-on-surface mb-4">Review Summary</h4>
        <div class="space-y-3">
            <div class="flex justify-between text-[14px] text-on-surface-variant">
                <span>Items Selected ({{ count($selectedItemIds) }})</span>
                <span class="text-on-surface font-semibold">&#8369;{{ number_format($this->selectedTotal, 2) }}</span>
            </div>
            <div class="flex justify-between text-[14px] text-on-surface-variant">
                <span>Transaction Fee</span>
                <span class="text-on-surface font-semibold">&#8369;0.00</span>
            </div>
            <div class="pt-3 border-t border-stone-200 flex justify-between items-center">
                <span class="font-bold text-on-surface">Total Amount</span>
                <span class="text-[20px] font-bold text-primary">&#8369;{{ number_format($this->selectedTotal, 2) }}</span>
            </div>
            <div class="flex items-center gap-2 text-[12px] font-bold text-amber-700 bg-amber-50 px-3 py-2 rounded-lg mt-2">
                <span class="material-symbols-outlined text-[16px]">verified_user</span>
                Status: Pending Verification
            </div>
        </div>
    </section>

    {{-- Actions --}}
    <div class="flex flex-col gap-3 pt-2">
        <button type="button"
                wire:click="submit"
                wire:loading.attr="disabled"
                class="w-full h-14 bg-primary text-white font-bold rounded-xl shadow-lg shadow-primary/20 active:scale-95 transition-all disabled:opacity-70 flex items-center justify-center gap-2">
            <span wire:loading.remove wire:target="submit">Submit Payment</span>
            <span wire:loading wire:target="submit" class="flex items-center gap-2">
                <span class="material-symbols-outlined text-[18px] animate-spin">progress_activity</span>
                Submitting...
            </span>
        </button>
        <a href="{{ route('community.bills') }}"
           class="w-full h-14 flex items-center justify-center font-bold text-primary rounded-xl border border-primary/30 active:scale-95 transition-all text-[15px]">
            Cancel
        </a>
    </div>

</div>
