<div class="px-4 max-w-md mx-auto py-2 space-y-6">
    {{-- Profile card --}}
    <div class="flex flex-col items-center pt-4">
        <div class="w-20 h-20 rounded-full bg-gradient-to-br from-blue-600 to-blue-900 flex items-center justify-center text-white text-2xl font-bold ring-4 ring-blue-100">
            {{ strtoupper(substr(auth()->user()->name ?? 'H', 0, 2)) }}
        </div>
        <h2 class="mt-3 text-lg font-bold text-gray-900">{{ auth()->user()->name }}</h2>
        <p class="text-sm text-gray-400">{{ auth()->user()->email }}</p>
    </div>

    {{-- Logout --}}
    <form method="POST" action="{{ filament()->getPanel('community')->getLogoutUrl() }}">

        @csrf
        <button type="submit"
                class="w-full py-3 rounded-xl bg-red-50 text-red-600 text-sm font-semibold flex items-center justify-center gap-2 hover:bg-red-100 transition-colors">
            <span class="material-symbols-outlined" style="font-size:18px">logout</span>
            Sign Out
        </button>
    </form>
</div>
