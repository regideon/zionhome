<div class="space-y-6 pb-4">

    {{-- Hero Profile Card --}}
    <section>
        <div class="bg-white rounded-[24px] p-6 shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-200/50 flex flex-col items-center text-center relative overflow-hidden">
            {{-- Top gradient band --}}
            <div class="absolute top-0 left-0 w-full h-24 bg-gradient-to-r from-primary to-blue-400 opacity-10 rounded-t-[24px]"></div>

            {{-- Avatar --}}
            <div class="relative mt-4">
                <div class="w-24 h-24 rounded-full border-4 border-white shadow-md bg-blue-700 flex items-center justify-center text-white text-3xl font-black">
                    {{ strtoupper(substr(auth()->user()->name ?? 'H', 0, 2)) }}
                </div>
                <button class="absolute bottom-0 right-0 bg-primary text-white p-2 rounded-full shadow-lg active:scale-95 transition-transform">
                    <span class="material-symbols-outlined text-[18px]">edit</span>
                </button>
            </div>

            <h1 class="text-[24px] font-semibold mt-4 text-on-surface">{{ auth()->user()->name }}</h1>
            <p class="text-sm text-on-surface-variant mb-4">Block 3, Lot 4B &bull; Fir St.</p>

            <div class="flex gap-2">
                <span class="inline-flex items-center px-4 py-1.5 rounded-full bg-emerald-50 text-emerald-700 text-[13px] font-semibold border border-emerald-200">
                    <span class="material-symbols-outlined mr-1 text-[16px]" style="font-variation-settings: 'FILL' 1;">verified</span>
                    Verified Owner
                </span>
            </div>
        </div>
    </section>

    {{-- Account Settings --}}
    <section class="bg-white p-5 rounded-[20px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-200/50">
        <h3 class="text-[20px] font-semibold mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-primary">manage_accounts</span>
            Account Settings
        </h3>
        <div class="space-y-1">
            <button class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-stone-50 transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-400 group-hover:text-primary transition-colors">person</span>
                    <span class="text-[16px] text-on-surface">Personal Information</span>
                </div>
                <span class="material-symbols-outlined text-stone-300">chevron_right</span>
            </button>
            <button class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-stone-50 transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-400 group-hover:text-primary transition-colors">security</span>
                    <span class="text-[16px] text-on-surface">Password &amp; Security</span>
                </div>
                <span class="material-symbols-outlined text-stone-300">chevron_right</span>
            </button>
            <button class="w-full flex items-center justify-between p-3 rounded-xl hover:bg-stone-50 transition-colors group">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-400 group-hover:text-primary transition-colors">group</span>
                    <span class="text-[16px] text-on-surface">Household Members</span>
                </div>
                <span class="material-symbols-outlined text-stone-300">chevron_right</span>
            </button>
        </div>
    </section>

    {{-- Preferences --}}
    <section class="bg-white p-5 rounded-[20px] shadow-[0_4px_20px_rgba(0,0,0,0.04)] border border-stone-200/50">
        <h3 class="text-[20px] font-semibold mb-4 flex items-center gap-2">
            <span class="material-symbols-outlined text-amber-600">tune</span>
            Preferences
        </h3>
        <div class="space-y-4">
            <div class="flex items-center justify-between p-1">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-400">notifications_active</span>
                    <span class="text-[16px] text-on-surface">Push Notifications</span>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" checked class="sr-only peer">
                    <div class="w-11 h-6 bg-stone-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-stone-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>
            <div class="flex items-center justify-between p-1">
                <div class="flex items-center gap-3">
                    <span class="material-symbols-outlined text-stone-400">dark_mode</span>
                    <span class="text-[16px] text-on-surface">Dark Mode</span>
                </div>
                <label class="relative inline-flex items-center cursor-pointer">
                    <input type="checkbox" class="sr-only peer">
                    <div class="w-11 h-6 bg-stone-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-stone-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-primary"></div>
                </label>
            </div>
        </div>
    </section>

    {{-- Quick Cards --}}
    <section class="grid grid-cols-2 gap-4">
        <div class="bg-blue-50 p-5 rounded-[20px] border border-blue-100 flex flex-col justify-between cursor-pointer active:scale-95 transition-all">
            <span class="material-symbols-outlined text-primary mb-2">help</span>
            <div>
                <p class="text-[14px] font-semibold text-primary">Help Center</p>
                <p class="text-[12px] text-blue-400 leading-tight">FAQs &amp; Support</p>
            </div>
        </div>
        <div class="bg-emerald-50 p-5 rounded-[20px] border border-emerald-100 flex flex-col justify-between cursor-pointer active:scale-95 transition-all">
            <span class="material-symbols-outlined text-emerald-700 mb-2">description</span>
            <div>
                <p class="text-[14px] font-semibold text-emerald-700">Bylaws</p>
                <p class="text-[12px] text-emerald-400 leading-tight">Village Rules</p>
            </div>
        </div>
    </section>

    {{-- Logout --}}
    <form method="POST" action="{{ filament()->getPanel('community')->getLogoutUrl() }}">
        @csrf
        <button type="submit"
                class="w-full flex items-center justify-center gap-2 py-4 px-6 rounded-xl text-red-600 text-[16px] font-semibold border border-red-100 hover:bg-red-50 active:scale-[0.98] transition-all">
            <span class="material-symbols-outlined">logout</span>
            Logout
        </button>
    </form>

    {{-- Footer --}}
    <p class="text-center text-stone-400 text-[12px] pb-2">
        App Version 1.0.0 (Build 1)<br>
        &copy; {{ date('Y') }} Zion Home - Smart Subdivision
    </p>

</div>
