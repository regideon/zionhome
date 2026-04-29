<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light h-full">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ZionHome') }}</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet">

    @vite(['resources/css/community.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-surface text-on-surface min-h-screen pb-28 antialiased">

    {{-- Top AppBar --}}
    <header class="bg-white border-b border-slate-100 shadow-sm fixed top-0 z-50 flex justify-between items-center w-full px-4 h-16">
        <div class="flex items-center gap-3">
            <a href="{{ route('community.profile') }}">
                <div class="w-10 h-10 rounded-full bg-blue-700 flex items-center justify-center text-white text-sm font-bold flex-shrink-0">
                    {{ strtoupper(substr(auth()->user()->name ?? 'H', 0, 2)) }}
                </div>
            </a>
            <span class="font-black text-blue-700 text-xl" style="font-family: 'Inter', sans-serif;">{{ config('app.name') }}</span>
        </div>
        <button class="text-slate-500 hover:bg-slate-50 transition-colors p-2 rounded-full active:scale-95 duration-200">
            <span class="material-symbols-outlined">notifications</span>
        </button>
    </header>

    {{-- Main content --}}
    <main class="pt-20 px-4 max-w-md mx-auto space-y-6">
        {{ $slot }}
    </main>

    {{-- Bottom Navigation Bar --}}
    <nav class="fixed bottom-0 left-0 w-full z-50 bg-black/80 backdrop-blur-md flex justify-around items-end px-2 pt-3 pb-safe rounded-t-[24px]"
         style="min-height: 64px;">

        @php
            $navItems = [
                ['route' => 'community.home',     'icon' => 'home',              'label' => 'Home'],
                ['route' => 'community.bills',    'icon' => 'payments',          'label' => 'Bills'],
                ['route' => 'community.feedback', 'icon' => 'volunteer_activism','label' => 'Care'],
                ['route' => 'community.visitors', 'icon' => 'qr_code_scanner',   'label' => 'Visitors'],
                ['route' => 'community.profile',  'icon' => 'person',            'label' => 'Profile'],
            ];
        @endphp

        @foreach($navItems as $index => $item)
            @php
                $isActive = request()->routeIs($item['route']);
                $isCenter = $index === 2;
            @endphp

            @if($isCenter)
                {{-- Prominent center FAB --}}
                <a href="{{ route($item['route']) }}"
                   class="flex flex-col items-center -mt-8 active:scale-90 transition-transform duration-150 pb-2">
                    <div class="w-16 h-16 rounded-full flex items-center justify-center shadow-[0_4px_24px_rgba(29,85,208,0.5)] transition-all duration-150
                        {{ $isActive ? 'bg-blue-500' : 'bg-blue-600' }}"
                         style="border: 3px solid rgba(255,255,255,0.2);">
                        <span class="material-symbols-outlined text-white text-[28px]"
                              style="font-variation-settings: 'FILL' 1;">{{ $item['icon'] }}</span>
                    </div>
                    <span class="text-[10px] font-bold tracking-wide mt-1.5
                        {{ $isActive ? 'text-blue-300' : 'text-white/60' }}">
                        {{ $item['label'] }}
                    </span>
                </a>
            @else
                {{-- Regular nav item --}}
                <a href="{{ route($item['route']) }}"
                   class="flex flex-col items-center justify-center py-2 px-3 rounded-xl transition-all duration-150 active:scale-90
                       {{ $isActive ? 'text-white' : 'text-white/40 hover:text-white/70' }}">
                    <span class="material-symbols-outlined text-[24px]"
                          style="font-variation-settings: 'FILL' {{ $isActive ? '1' : '0' }}">
                        {{ $item['icon'] }}
                    </span>
                    <span class="text-[10px] font-bold tracking-wide mt-0.5">{{ $item['label'] }}</span>
                </a>
            @endif

        @endforeach

    </nav>

    @livewireScripts
    @stack('scripts')
</body>
</html>
