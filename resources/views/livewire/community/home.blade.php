<div class="space-y-6">

    {{-- Greeting Section --}}
    {{-- <section class="mt-4"> --}}
        {{-- <h1 class="text-[24px] font-semibold leading-[1.3] tracking-[-0.01em] text-on-surface">
            Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }},
            {{ auth()->user()->name }}
        </h1> --}}
        {{-- <p class="text-[16px] leading-[1.5] text-on-surface-variant">
            Good {{ now()->hour < 12 ? 'morning' : (now()->hour < 18 ? 'afternoon' : 'evening') }},
            {{ auth()->user()->name }}. Here's what needs your attention today.
        </p> --}}
    {{-- </section> --}}

    {{-- Homeowner ID Card --}}
    <section>
        <div class="relative overflow-hidden premium-card-bg rounded-[2rem] p-6 shadow-xl border border-white/10">
            {{-- Decorative blobs --}}
            <div class="absolute -right-16 -top-16 w-48 h-48 bg-white/5 rounded-full blur-3xl"></div>
            <div class="absolute -left-20 bottom-0 w-64 h-64 rounded-full blur-3xl" style="background: rgba(0,74,198,0.20)"></div>
            {{-- Shield icon watermark --}}
            <div class="absolute top-0 right-0 p-4 opacity-10">
                <span class="material-symbols-outlined text-[120px]" style="font-variation-settings: 'FILL' 1;">shield_person</span>
            </div>

            <div class="relative z-10 flex flex-col gap-6">
                {{-- Top row: photo + verified badge --}}
                <div class="flex justify-between items-start">
                    {{-- Profile photo --}}
                    <div class="relative">
                        <div class="w-20 h-20 rounded-2xl border-2 border-white/30 p-1 overflow-hidden shadow-inner bg-white/10 backdrop-blur-md flex items-center justify-center">
                            <span class="text-white text-2xl font-black">{{ strtoupper(substr(auth()->user()->name ?? 'H', 0, 2)) }}</span>
                        </div>
                        <div class="absolute -bottom-2 -right-2 bg-green-500 text-white w-8 h-8 rounded-full flex items-center justify-center border-4 shadow-lg" style="border-color:#00174b">
                            <span class="material-symbols-outlined text-[18px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                        </div>
                    </div>

                    {{-- Right: verified badge + ID --}}
                    <div class="flex flex-col items-end gap-2">
                        <span class="bg-white/20 backdrop-blur-md text-white border border-white/30 px-3 py-1 rounded-full font-bold text-[10px] uppercase tracking-widest flex items-center gap-1">
                            <span class="w-1.5 h-1.5 bg-green-400 rounded-full animate-pulse"></span>
                            Verified Homeowner
                        </span>
                        <div class="text-white/60 text-[12px] uppercase tracking-widest text-right" style="font-weight: 700;">
                            <span class="text-white font-mono text-[14px]">ID#: ZH-2024-{{ str_pad(auth()->user()->id, 4, '0', STR_PAD_LEFT) }}</span><br>
                            {{-- ZionHome ID No.<br> --}}
                            Member since 2021
                        </div>
                    </div>
                </div>

                {{-- Bottom row: name+location (left) + QR (right) --}}
                <div class="flex items-end justify-between gap-4">

                    {{-- Name + location --}}
                    <div class="space-y-1">
                        <h2 class="text-white text-2xl font-semibold tracking-tight">{{ auth()->user()->name }}</h2>
                        <div class="flex items-center gap-2 text-white/70">
                            <span class="material-symbols-outlined text-[18px]">location_on</span>
                            <span class="text-sm font-medium">Block 3, Lot 4B &bull; Phase 2</span>
                        </div>
                    </div>

                    {{-- QR Code --}}
                    <div class="flex-shrink-0">
                        <div class="p-1.5 bg-white rounded-xl shadow-md">
                            <img src="{{ asset('images/dummy/qr-zionhome.png') }}"
                                alt="ZionHome QR"
                                class="w-16 h-16 object-contain rounded-lg" />
                        </div>
                    </div>

                </div>

                {{-- Footer row --}}
                {{-- <div class="pt-4 border-t border-white/10 flex items-center justify-between">
                    <div class="px-4 py-1.5 glass-effect rounded-xl">
                        <span class="text-white font-black text-[12px] uppercase tracking-widest">Homeowner</span>
                    </div>
                    <span class="text-white/40 text-[10px] font-medium uppercase tracking-tighter">Member since 2021</span>
                </div> --}}
            </div>
        </div>
    </section>

    <section class="space-y-4">
        <div class="flex justify-between items-center">
            <h2 class="text-[20px] font-semibold leading-[1.4]">Community Updates</h2>
            <button class="text-primary text-[12px] font-bold uppercase">View All</button>
        </div>
        <div class="space-y-3">
            {{-- Emergency notice --}}
            <div class="bg-error-container/10 border border-error/20 rounded-2xl p-4 flex gap-4 items-start">
                <div class="w-10 h-10 bg-error rounded-xl flex items-center justify-center shrink-0">
                    <span class="material-symbols-outlined text-white text-[20px]" style="font-variation-settings: 'FILL' 1;">emergency</span>
                </div>
                <div>
                    <h4 class="text-[14px] font-medium text-error">Emergency Notice</h4>
                    <p class="text-[14px] leading-[1.5] text-on-surface-variant mt-1">New security protocols at the Main Gate are now in effect.</p>
                    <button class="w-full py-2 mt-2 bg-error rounded-lg text-[14px] font-bold text-white active:scale-95 transition-all">
                        Read Notice
                    </button>

                </div>
                {{-- Add button here "Read Notice" --}}
            </div>
            
            {{-- Event card with image --}}
            {{-- <div class="bg-white rounded-2xl p-4 border border-outline-variant shadow-sm flex gap-4">
                <div class="w-20 h-20 rounded-xl overflow-hidden shrink-0 bg-surface-container flex items-center justify-center">
                    <span class="material-symbols-outlined text-on-surface-variant text-[40px]" style="font-variation-settings: 'FILL' 1;">event</span>
                </div>
                <div class="flex flex-col justify-center">
                    <span class="text-error text-[10px] font-bold uppercase mb-1">Upcoming Event</span>
                    <h4 class="text-[14px] font-medium leading-tight">Monthly Homeowners Meeting</h4>
                    <p class="text-[12px] text-on-surface-variant mt-1">May 28, 2024 • Clubhouse</p>
                </div>
            </div> --}}

            <div class="bg-surface-container-lowest border border-outline-variant p-4 rounded-xl shadow-sm space-y-3">
                <div class="flex justify-between items-start">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary">calendar_month</span>
                        <span class="bg-tertiary-fixed text-on-tertiary-fixed-variant px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider">Upcoming Event</span>
                    </div>
                </div>
                <h3 class="text-[14px] font-medium leading-[1.2]">Monthly Homeowners Meeting - May 28, 2026 Clubhouse</h3>
            </div>

            {{-- Warning notice card --}}
            <div class="bg-surface-container-lowest border border-outline-variant p-4 rounded-xl shadow-sm space-y-3">
                <div class="flex justify-between items-start">
                    <div class="flex items-center gap-2">
                        <span class="material-symbols-outlined text-tertiary">warning</span>
                        <span class="bg-tertiary-fixed text-on-tertiary-fixed-variant px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider">IMPORTANT</span>
                    </div>
                </div>
                <h3 class="text-[14px] font-medium leading-[1.2]">Water interruption - May 11, 2026 9AM–3PM</h3>
                {{-- <button class="w-full py-2 bg-surface-container-high rounded-lg text-[14px] font-medium text-primary-container hover:bg-surface-container-highest transition-colors">
                    Read Update
                </button> --}}
            </div>

            
        </div>
    </section>


    {{-- Priority Actions --}}
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            {{-- <h2 class="text-[20px] font-semibold leading-[1.4]">May kailangan kang i-check</h2> --}}
            <h2 class="text-[20px] font-semibold leading-[1.4]">Payments</h2>
            <span class="text-[12px] font-semibold uppercase tracking-wider text-primary">View All</span>
        </div>

        {{-- 2-col grid: dues + receipt --}}
        <div class="grid grid-cols-2 gap-3">
            <div class="bg-error-container/10 border border-error/20 p-4 rounded-xl space-y-3">
                <div class="flex flex-col gap-1">
                    <span class="bg-error text-on-error px-2 py-0.5 rounded-full text-[10px] font-bold uppercase tracking-wider w-fit">DUE SOON</span>
                    <p class="text-[14px] font-medium text-on-surface">May HOA dues</p>
                    <p class="text-[20px] font-semibold leading-[1.4] text-error">₱12,000</p>
                </div>
                <a href="{{ route('community.bills') }}"
                   class="w-full py-2 bg-error text-on-error rounded-lg text-[14px] font-medium flex items-center justify-center active:scale-95 transition-transform">
                    Pay Now
                </a>
            </div>
            <div class="bg-surface-container-low border border-outline-variant p-4 rounded-xl flex flex-col justify-between">
                <div class="space-y-2">
                    <span class="material-symbols-outlined text-secondary">receipt_long</span>
                    <p class="text-[14px] leading-normal text-on-surface-variant">Receipt waiting for verification</p>
                </div>
                <span class="mt-4 text-[10px] font-bold uppercase tracking-wider text-secondary">Pending Verification</span>
            </div>
        </div>
    </section>

    {{-- Recent Requests --}}
    <section class="space-y-4">
        <div class="flex items-center justify-between">
            <h2 class="text-[20px] font-semibold leading-[1.4]">Recent Requests</h2>
            <a href="{{ route('community.feedback') }}" class="text-primary text-[12px] font-bold uppercase">View All</a>
        </div>
        <div class="flex flex-col gap-3">

            {{-- Request: In Progress --}}
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-outline-variant">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-secondary-fixed flex items-center justify-center text-on-secondary-fixed">
                            <span class="material-symbols-outlined">lightbulb</span>
                        </div>
                        <div>
                            <h4 class="text-[14px] font-medium">Streetlight Repair</h4>
                            <p class="text-[12px] text-on-surface-variant leading-none">Phase 2, Block 3</p>
                        </div>
                    </div>
                    <span class="bg-secondary-fixed text-on-secondary-fixed px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">In Progress</span>
                </div>
                <div class="h-1.5 w-full bg-surface-container-highest rounded-full overflow-hidden">
                    <div class="h-full bg-primary-container rounded-full" style="width: 65%"></div>
                </div>
                <div class="flex justify-between mt-2">
                    <p class="text-[12px] text-on-surface-variant">Update: Tech dispatched</p>
                    <p class="text-[12px] text-on-surface-variant">2h ago</p>
                </div>
            </div>

            {{-- Request: Resolved --}}
            <div class="bg-white rounded-2xl p-4 shadow-sm border border-outline-variant">
                <div class="flex justify-between items-start mb-3">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-xl bg-tertiary-fixed flex items-center justify-center text-on-tertiary-fixed-variant">
                            <span class="material-symbols-outlined">delete</span>
                        </div>
                        <div>
                            <h4 class="text-[14px] font-medium">Missed Garbage Collection</h4>
                            <p class="text-[12px] text-on-surface-variant leading-none">Block 3 Lot 4B</p>
                        </div>
                    </div>
                    <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-[10px] font-bold uppercase tracking-wider">Resolved</span>
                </div>
                <div class="flex items-center gap-2 p-2 bg-green-50 rounded-lg border border-green-100">
                    <span class="material-symbols-outlined text-green-600 text-[16px]" style="font-variation-settings: 'FILL' 1;">check_circle</span>
                    <p class="text-[11px] text-green-700">Work completed at 10:15 AM today</p>
                </div>
            </div>

        </div>
    </section>

    {{-- Financial View --}}
    <section class="space-y-4">
        {{-- <h2 class="text-[20px] font-semibold leading-[1.4]">Bayarin this month</h2>

        <div class="relative overflow-hidden bg-primary-container text-on-primary rounded-2xl p-6 shadow-lg">
            <div class="absolute -right-12 -top-12 w-48 h-48 bg-white/10 rounded-full blur-3xl"></div>
            <div class="absolute -left-12 -bottom-12 w-32 h-32 rounded-full blur-2xl" style="background: rgba(184,200,255,0.20)"></div>
            <div class="relative z-10 space-y-4">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-[12px] font-semibold uppercase tracking-wider text-on-primary-container">TOTAL BALANCE</p>
                        <p class="text-[30px] font-semibold leading-[1.3] tracking-[-0.01em]">₱2,500.00</p>
                    </div>
                    <span class="material-symbols-outlined text-white/40">account_balance_wallet</span>
                </div>
                <div class="grid grid-cols-2 gap-4 py-4 border-t border-white/10">
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-on-primary-container">DUE DATE</p>
                        <p class="text-[14px] font-medium">May 15, 2024</p>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold uppercase tracking-wider text-on-primary-container">LAST PAYMENT</p>
                        <p class="text-[14px] font-medium">₱2,500 Verified</p>
                    </div>
                </div>
                <div class="grid grid-cols-2 gap-2">
                    <button class="bg-white text-primary text-[14px] font-medium py-3 rounded-xl active:scale-[0.98] transition-transform">
                        Pay Now
                    </button>
                    <button class="bg-on-primary-container/20 text-white border border-white/20 text-[14px] font-medium py-3 rounded-xl active:scale-[0.98] transition-transform">
                        Upload Receipt
                    </button>
                </div>
            </div>
        </div> --}}

        <div class="grid grid-cols-2 gap-3">
            <button class="flex items-center justify-center gap-2 py-3 border border-outline-variant rounded-xl text-[14px] font-medium text-secondary hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined text-[20px]">description</span>
                View Statement
            </button>
            <button class="flex items-center justify-center gap-2 py-3 border border-outline-variant rounded-xl text-[14px] font-medium text-secondary hover:bg-surface-container transition-colors">
                <span class="material-symbols-outlined text-[20px]">history</span>
                History
            </button>
        </div>
    </section>

    {{-- Community & Home --}}
    <section class="space-y-4 pb-8">
        <div class="flex items-center justify-between">
            <h2 class="text-[20px] font-semibold leading-[1.4]">Community & Home</h2>
            <div class="flex items-center gap-2 text-on-surface-variant">
                <span class="material-symbols-outlined text-[18px]">location_on</span>
                <span class="text-[12px] font-semibold uppercase tracking-wider">BLK 3 LOT 4B</span>
            </div>
        </div>

        <div class="grid grid-cols-4 gap-4">
            @foreach([
                ['icon' => 'campaign',     'label' => 'Announce'],
                ['icon' => 'badge',        'label' => 'Pass'],
                ['icon' => 'build',        'label' => 'Repair'],
                ['icon' => 'folder_open',  'label' => 'Docs'],
            ] as $action)
                <div class="flex flex-col items-center gap-2">
                    <div class="w-14 h-14 bg-surface-container rounded-2xl flex items-center justify-center hover:bg-primary-fixed transition-colors cursor-pointer group">
                        <span class="material-symbols-outlined text-on-surface group-hover:text-primary">{{ $action['icon'] }}</span>
                    </div>
                    <span class="text-[10px] font-bold uppercase tracking-wider text-center">{{ $action['label'] }}</span>
                </div>
            @endforeach
        </div>
    </section>

</div>
