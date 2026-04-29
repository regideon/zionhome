<div class="space-y-6 pb-4">

    {{-- Page Header --}}
    <section class="space-y-1 pt-2">
        {{-- <h1 class="text-[24px] font-semibold leading-tight text-on-surface">Bills &amp; Payments</h1> --}}
        <h1 class="text-[32px] font-extrabold tracking-tight text-on-surface leading-tight">Bills &amp; Payments</h1>
        <p class="text-base text-on-surface-variant mt-1">View your dues, bills, and payment history.</p>
        {{-- <p class="text-sm text-on-surface-variant">View your dues, bills, and payment history</p> --}}
        <div class="inline-flex items-center gap-2 px-3 py-1 bg-surface-container-high rounded-full mt-2">
            <span class="material-symbols-outlined text-primary text-[18px]">location_on</span>
            <span class="text-[12px] font-medium text-on-surface">BLK 3 LOT 4B, Fir St.</span>
            <span class="material-symbols-outlined text-on-surface-variant text-[16px]">expand_more</span>
        </div>
    </section>

    {{-- Summary Card --}}
    <section>
        <div class="flex items-center justify-between">
            <h3 class="text-[20px] font-semibold">{{ date('Y') }} Association Dues</h3>
        </div>
        <div class="bg-white rounded-[16px] p-5 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-100 relative overflow-hidden">
            <div class="absolute top-0 right-0 p-4 mb-3 opacity-[0.07]">
                <span class="material-symbols-outlined text-[80px]">account_balance_wallet</span>
            </div>
            <div class="relative z-10 space-y-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[12px] font-medium text-on-surface-variant">Outstanding Balance</p>
                        <p class="text-[32px] font-bold leading-tight tracking-tight text-on-surface">&#8369;12,000</p>
                    </div>
                    <span class="px-3 py-1 bg-amber-100 text-amber-700 rounded-full text-[12px] font-semibold">Partially Paid</span>
                </div>
                <div class="flex items-center justify-between pt-3 border-t border-stone-100">
                    <div>
                        <p class="text-[12px] font-medium text-on-surface-variant"></p>
                        <p class="text-[20px] font-semibold text-primary"></p>
                    </div>
                    <a href="{{ route('bills.dues.pay', 1) }}"
                    class="bg-primary text-white h-12 px-5 rounded-xl text-[14px] font-semibold flex items-center gap-2 active:scale-95 transition-all shadow-lg shadow-blue-600/20">
                        <span class="material-symbols-outlined text-[20px]">cloud_upload</span>
                        View Payment Details
                    </a>

                </div>
            </div>
        </div>
    </section>

    {{-- Tabs --}}
    <section class="flex overflow-x-auto gap-2 py-1" style="-ms-overflow-style:none; scrollbar-width:none;">
        <button class="px-5 py-2.5 bg-primary text-white rounded-full text-[14px] font-semibold whitespace-nowrap active:scale-95 transition-transform">
            Unpaid
        </button>
        <button class="px-5 py-2.5 bg-surface-container-high text-on-surface-variant rounded-full text-[14px] font-semibold whitespace-nowrap active:scale-95 transition-transform">
            Pending Verification
        </button>
        <button class="px-5 py-2.5 bg-surface-container-high text-on-surface-variant rounded-full text-[14px] font-semibold whitespace-nowrap active:scale-95 transition-transform">
            Paid
        </button>
        <button class="px-5 py-2.5 bg-surface-container-high text-on-surface-variant rounded-full text-[14px] font-semibold whitespace-nowrap active:scale-95 transition-transform">
            All
        </button>
    </section>

    {{-- Unpaid Bills --}}
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h3 class="text-[20px] font-semibold">Unpaid Bills</h3>
            <span class="text-primary text-[12px] font-semibold">3 items</span>
        </div>

        {{-- Item: Association Dues April --}}
        <div class="bg-white p-4 rounded-[16px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-100 flex flex-col gap-3">
            <div class="flex justify-between items-start">
                <div class="flex gap-3">
                    <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600 flex-shrink-0">
                        <span class="material-symbols-outlined">home_work</span>
                    </div>
                    <div>
                        <p class="text-[14px] font-semibold leading-tight">Construction Permit - May 2026</p>
                        <p class="text-[12px] text-on-surface-variant mt-0.5">Due: June 15, 2026</p>
                    </div>
                </div>
                <p class="text-[20px] font-semibold flex-shrink-0">&#8369;1,000</p>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-stone-50">
                <span class="px-3 py-1 bg-stone-100 text-on-surface-variant rounded-full text-[12px] font-medium">Unpaid</span>
                <button class="text-primary text-[14px] font-semibold flex items-center gap-1 active:scale-95 transition-transform">
                    Make Payment
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>


        <div class="bg-white p-4 rounded-2xl shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-100 flex flex-col gap-3">
            <div class="flex justify-between items-start">
                <div class="flex gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 shrink-0">
                        <span class="material-symbols-outlined">shield</span>
                    </div>
                    <div>
                        <p class="text-[14px] font-semibold leading-tight">Clubhouse Reservation</p>
                        <p class="text-[12px] text-on-surface-variant mt-0.5">Scheduled: May 28, 2026</p>
                    </div>
                </div>
                <p class="text-[20px] font-semibold shrink-0">&#8369;500</p>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-stone-50">
                <span class="px-3 py-1 bg-stone-100 text-on-surface-variant rounded-full text-[12px] font-medium">Unpaid</span>
                <button class="text-primary text-[14px] font-semibold flex items-center gap-1 active:scale-95 transition-transform">
                    Make Payment
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>

        {{-- Item: Security Fund --}}
        <div class="bg-white p-4 rounded-[16px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-100 flex flex-col gap-3">
            <div class="flex justify-between items-start">
                <div class="flex gap-3">
                    <div class="w-10 h-10 rounded-full bg-emerald-50 flex items-center justify-center text-emerald-600 flex-shrink-0">
                        <span class="material-symbols-outlined">shield</span>
                    </div>
                    <div>
                        <p class="text-[14px] font-semibold leading-tight">Security Fund</p>
                        <p class="text-[12px] text-on-surface-variant mt-0.5">Annual contribution</p>
                    </div>
                </div>
                <p class="text-[20px] font-semibold flex-shrink-0">&#8369;500</p>
            </div>
            <div class="flex justify-between items-center pt-2 border-t border-stone-50">
                <span class="px-3 py-1 bg-stone-100 text-on-surface-variant rounded-full text-[12px] font-medium">Unpaid</span>
                <button class="text-primary text-[14px] font-semibold flex items-center gap-1 active:scale-95 transition-transform">
                    Make Payment
                    <span class="material-symbols-outlined text-[18px]">chevron_right</span>
                </button>
            </div>
        </div>


    </section>

    {{-- Pending Verification --}}
    <section class="space-y-4">
        <h3 class="text-[20px] font-semibold">Pending Verification</h3>
        <div class="bg-white p-4 rounded-[16px] border border-dashed border-stone-300 flex items-center justify-between gap-3">
            <div class="flex gap-3 items-center">
                <div class="w-10 h-10 rounded-full bg-amber-50 flex items-center justify-center text-amber-600 flex-shrink-0">
                    <span class="material-symbols-outlined">history</span>
                </div>
                <div>
                    <p class="text-[14px] font-semibold">GCASH-839201</p>
                    <p class="text-[12px] text-on-surface-variant">Waiting for accounting verification</p>
                </div>
            </div>
            <p class="text-[14px] font-semibold flex-shrink-0">&#8369;1,000</p>
        </div>
    </section>

    {{-- Quick Actions --}}
    <section class="grid grid-cols-2 gap-3">
        <button class="flex flex-col items-center justify-center p-4 bg-white rounded-[16px] shadow-sm border border-stone-100 gap-2 active:scale-95 transition-transform">
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <span class="material-symbols-outlined">receipt_long</span>
            </div>
            <span class="text-[12px] font-semibold">View Ledger</span>
        </button>
        <button class="flex flex-col items-center justify-center p-4 bg-white rounded-[16px] shadow-sm border border-stone-100 gap-2 active:scale-95 transition-transform">
            <div class="w-10 h-10 rounded-full bg-blue-50 flex items-center justify-center text-blue-600">
                <span class="material-symbols-outlined">download</span>
            </div>
            <span class="text-[12px] font-semibold">Statement</span>
        </button>
        <button class="col-span-2 flex items-center justify-center gap-3 p-4 bg-white rounded-[16px] shadow-sm border border-stone-100 active:scale-95 transition-transform">
            <span class="material-symbols-outlined text-blue-600">support_agent</span>
            <span class="text-[14px] font-semibold">Contact Accounting Support</span>
        </button>
    </section>

</div>
