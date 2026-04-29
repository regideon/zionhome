<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="light">
<head>
    <meta charset="utf-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>ZionHome — Your Community, In Your Pocket</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet"/>
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    @vite(['resources/css/community.css', 'resources/js/app.js'])

    <style>
        body { font-family: 'Inter', sans-serif; background-color: #faf8ff; color: #191b23; -webkit-font-smoothing: antialiased; overflow-x: hidden; }
        .material-symbols-outlined { font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24; }
        .hero-gradient { background: linear-gradient(135deg, #1d42d0 0%, #0d1f8c 55%, #060e45 100%); }
        .section-gap { padding-top: 96px; padding-bottom: 96px; }
    </style>
</head>
<body>

    {{-- Top Nav --}}
    <nav class="fixed top-0 w-full z-50 bg-white/90 backdrop-blur-md border-b border-slate-100 shadow-[0_4px_20px_rgba(0,0,0,0.04)]">
        <div class="max-w-6xl mx-auto flex items-center justify-between px-6 py-4">
            <div class="text-2xl font-black text-blue-700">ZionHome</div>
            <div class="hidden md:flex items-center gap-8">
                <a href="#features" class="text-slate-600 hover:text-primary text-sm font-semibold transition-colors">Features</a>
                <a href="#why" class="text-slate-600 hover:text-primary text-sm font-semibold transition-colors">Community</a>
                <a href="#testimonials" class="text-slate-600 hover:text-primary text-sm font-semibold transition-colors">Reviews</a>
            </div>
            <a href="{{ route('filament.community.auth.login') }}"
               class="bg-primary text-white px-5 py-2.5 rounded-full text-sm font-semibold hover:opacity-90 active:scale-95 transition-all shadow-sm">
                Login Member
            </a>
        </div>
    </nav>

    <main>

        {{-- Hero --}}
        <section class="hero-gradient pt-32 pb-0 overflow-hidden relative">
            <div class="absolute top-0 left-0 w-96 h-96 bg-white/5 rounded-full blur-3xl -translate-x-1/2 -translate-y-1/2"></div>
            <div class="absolute top-1/2 right-0 w-80 h-80 bg-blue-400/10 rounded-full blur-3xl translate-x-1/2"></div>

            <div class="max-w-6xl mx-auto px-6 text-center relative z-10">
                <span class="inline-block px-4 py-1.5 mb-6 rounded-full bg-white/10 text-white/80 text-[11px] font-bold uppercase tracking-widest border border-white/20">
                    Cainta Greenland Smart Subdivision
                </span>
                <h1 class="text-[48px] md:text-[68px] font-extrabold leading-[1.08] tracking-tight text-white mb-6">
                    Your Community,<br>In Your Pocket.
                </h1>
                <p class="text-[18px] text-white/70 max-w-xl mx-auto mb-10 leading-relaxed">
                    The all-in-one app for modern subdivision living — digital ID, bill payments, visitor passes, and more.
                </p>
                <div class="flex flex-col sm:flex-row justify-center gap-4 mb-16">
                    <a href="{{ route('filament.community.auth.login') }}"
                       class="bg-white text-primary px-8 py-4 rounded-xl font-bold text-[15px] hover:shadow-xl transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">login</span>
                        Login Member
                    </a>
                    <button class="border-2 border-white/30 text-white px-8 py-4 rounded-xl font-bold text-[15px] hover:bg-white/10 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined text-[20px]">download</span>
                        Download App
                    </button>
                </div>

                {{-- 3 Phone Mockups --}}
                <div class="relative flex justify-center items-end max-w-4xl mx-auto">
                    <div class="w-[320px] md:w-[420px] translate-y-10 -mr-10 z-10 rounded-[2.5rem] overflow-hidden border-[4px] border-slate-900 shadow-2xl flex-shrink-0">
                        <img class="w-full block" alt="ZionHome App" src="/images/banners/mobile-2.png"/>
                    </div>
                    <div class="w-[320px] md:w-[420px] -mb-10 z-20 rounded-[2.5rem] overflow-hidden border-[4px] border-slate-900 shadow-[0_40px_80px_rgba(0,0,0,0.5)] flex-shrink-0">
                        <img class="w-full block" alt="ZionHome App" src="/images/banners/mobile-1.png"/>
                    </div>
                    <div class="w-[320px] md:w-[420px] translate-y-10 -ml-10 z-10 rounded-[2.5rem] overflow-hidden border-[4px] border-slate-900 shadow-2xl flex-shrink-0">
                        <img class="w-full block" alt="ZionHome App" src="/images/banners/mobile-3.png"/>
                    </div>
                </div>

            </div>
        </section>

        {{-- Features --}}
        <section id="features" class="section-gap bg-white">
            <div class="max-w-6xl mx-auto px-6">
                <div class="text-center mb-16">
                    <h2 class="text-[40px] font-bold text-on-background mb-4">Everything You Need. Nothing You Don't.</h2>
                    <p class="text-on-surface-variant max-w-xl mx-auto">Focused features designed to make subdivision living seamless and stress-free.</p>
                </div>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach([
                        ['icon' => 'badge',            'bg' => 'bg-blue-50',   'color' => 'text-blue-600',   'title' => 'Digital ID & Security',  'desc' => 'Verified homeowner badge and secure QR passes for seamless gate entry and checkpoint verification.'],
                        ['icon' => 'payments',         'bg' => 'bg-green-50',  'color' => 'text-green-600',  'title' => 'Easy Bill Payments',     'desc' => 'Pay dues via GCash, Maya, or bank transfer instantly with real-time digital receipts.'],
                        ['icon' => 'support_agent',    'bg' => 'bg-orange-50', 'color' => 'text-orange-600', 'title' => 'Community Care',         'desc' => 'File concerns, report maintenance issues, and track their resolution through our ticketing system.'],
                        ['icon' => 'qr_code_scanner',  'bg' => 'bg-purple-50', 'color' => 'text-purple-600', 'title' => 'Visitor Management',     'desc' => 'Register guests and issue time-limited QR gate passes from anywhere, anytime.'],
                        ['icon' => 'event_available',  'bg' => 'bg-rose-50',   'color' => 'text-rose-600',   'title' => 'Facility Booking',       'desc' => 'Reserve the pool, basketball court, or clubhouse in seconds from within the app.'],
                        ['icon' => 'receipt_long',     'bg' => 'bg-amber-50',  'color' => 'text-amber-600',  'title' => 'Ledger & Statements',    'desc' => 'Access your complete payment history and download official billing statements on demand.'],
                    ] as $feature)
                        <div class="bg-surface-container-low p-8 rounded-[1.5rem] border border-outline-variant/20 hover:bg-white hover:shadow-xl transition-all duration-300">
                            <div class="w-14 h-14 {{ $feature['bg'] }} flex items-center justify-center rounded-2xl mb-6">
                                <span class="material-symbols-outlined {{ $feature['color'] }} text-[28px]">{{ $feature['icon'] }}</span>
                            </div>
                            <h3 class="text-[20px] font-bold mb-3 text-on-background">{{ $feature['title'] }}</h3>
                            <p class="text-on-surface-variant leading-relaxed text-sm">{{ $feature['desc'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Why ZionHome --}}
        <section id="why" class="section-gap">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-[40px] font-bold text-center mb-20 text-on-background">Why Homeowners Love ZionHome</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-12">
                    <div class="space-y-6">
                        <div class="aspect-[4/4] rounded-3xl overflow-hidden shadow-lg border border-blue-100">
                            <img src="/images/banners/banner-1.png" alt="Verified Digital ID" class="w-full h-full object-cover"/>
                        </div>
                        <h4 class="text-[22px] font-bold text-on-background">Verified Digital ID</h4>
                        <p class="text-on-surface-variant leading-relaxed">Instantly prove your residency with a tamper-proof QR badge accepted at every gate checkpoint.</p>
                    </div>
                    <div class="space-y-6 mt-12">
                        <div class="aspect-[4/4] rounded-3xl overflow-hidden shadow-lg border border-green-100">
                            <img src="/images/banners/banner-2.png" alt="Instant Payments" class="w-full h-full object-cover"/>
                        </div>
                        <h4 class="text-[22px] font-bold text-on-background">Instant Payments</h4>
                        <p class="text-on-surface-variant leading-relaxed">Pay dues in seconds via GCash or bank transfer. Get a verified digital receipt immediately.</p>
                    </div>
                    <div class="space-y-6">
                        <div class="aspect-[4/4] rounded-3xl overflow-hidden shadow-lg border border-orange-100">
                            <img src="/images/banners/banner-3.png" alt="Community Support" class="w-full h-full object-cover"/>
                        </div>
                        <h4 class="text-[22px] font-bold text-on-background">Community Support</h4>
                        <p class="text-on-surface-variant leading-relaxed">File concerns anytime and track resolution status through our integrated support system.</p>
                    </div>

                </div>
            </div>
        </section>

        {{-- Testimonials --}}
        <section id="testimonials" class="section-gap bg-surface-container-low">
            <div class="max-w-6xl mx-auto px-6">
                <h2 class="text-[40px] font-bold text-center mb-16 text-on-background">Real Residents. Real Stories.</h2>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                    @foreach([
                        ['q' => '"Paying dues used to mean a trip to the HOA office. Now it\'s done in 30 seconds from my couch."',     'name' => 'Maria Santos',    'loc' => 'Block 2, Lot 7'],
                        ['q' => '"The visitor QR pass is a game-changer. My parents\' entry at the gate is always smooth now."',         'name' => 'Carlo Reyes',     'loc' => 'Block 5, Lot 3'],
                        ['q' => '"I filed a maintenance concern on Monday and it was resolved by Wednesday. Never happened before!"',     'name' => 'Anna Villanueva', 'loc' => 'Block 1, Lot 12'],
                    ] as $t)
                        <div class="bg-white p-8 rounded-[2rem] border border-slate-100 shadow-sm">
                            <div class="flex gap-0.5 mb-5">
                                <span class="material-symbols-outlined text-yellow-400 text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-400 text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-400 text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-400 text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                                <span class="material-symbols-outlined text-yellow-400 text-[20px]" style="font-variation-settings: 'FILL' 1;">star</span>
                            </div>
                            <p class="text-on-surface-variant mb-8 italic leading-relaxed">{{ $t['q'] }}</p>
                            <div class="flex items-center gap-4">
                                <div class="w-12 h-12 rounded-full bg-primary flex items-center justify-center text-white font-bold text-lg flex-shrink-0">
                                    {{ substr($t['name'], 0, 1) }}
                                </div>
                                <div>
                                    <div class="font-bold text-on-background">{{ $t['name'] }}</div>
                                    <div class="text-sm text-on-surface-variant">{{ $t['loc'] }}</div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="my-20 max-w-6xl mx-auto px-6">
            <div class="bg-gradient-to-br from-primary to-blue-900 rounded-[3rem] py-20 px-8 text-center text-white relative overflow-hidden">
                <div class="relative z-10">
                    <h2 class="text-[40px] font-bold mb-4">Ready to simplify your home life?</h2>
                    <p class="text-[18px] text-white/75 max-w-xl mx-auto mb-10 leading-relaxed">
                        Join hundreds of residents enjoying a smarter, safer way of living at Cainta Greenland.
                    </p>
                    <div class="flex flex-col sm:flex-row justify-center gap-4">
                        <a href="{{ route('filament.community.auth.login') }}"
                           class="bg-white text-primary px-8 py-4 rounded-full font-bold text-[15px] hover:shadow-xl transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">login</span>
                            Login as Member
                        </a>
                        <button class="border-2 border-white/40 text-white px-8 py-4 rounded-full font-bold text-[15px] hover:bg-white/10 transition-all flex items-center justify-center gap-2">
                            <span class="material-symbols-outlined text-[20px]">download</span>
                            Download App
                        </button>
                    </div>
                </div>
                <div class="absolute -top-24 -left-24 w-64 h-64 bg-white/10 rounded-full blur-3xl"></div>
                <div class="absolute -bottom-24 -right-24 w-96 h-96 bg-blue-400/20 rounded-full blur-3xl"></div>
            </div>
        </section>

    </main>

    {{-- Footer --}}
    <footer class="bg-slate-50 border-t border-slate-200 py-20">
        <div class="max-w-6xl mx-auto px-6 grid grid-cols-1 md:grid-cols-4 gap-12">
            <div>
                <div class="text-xl font-black text-blue-700 mb-4">ZionHome</div>
                <p class="text-slate-500 text-sm mb-6 leading-relaxed">Empowering neighborhood associations with smart technology for safer, more connected communities.</p>
            </div>
            <div>
                <div class="font-bold text-slate-900 mb-6 text-sm">Product</div>
                <ul class="space-y-3 text-slate-500 text-sm">
                    <li><a href="#features" class="hover:text-primary transition-colors">Features</a></li>
                    <li><a href="#why" class="hover:text-primary transition-colors">Community</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Download App</a></li>
                </ul>
            </div>
            <div>
                <div class="font-bold text-slate-900 mb-6 text-sm">Legal</div>
                <ul class="space-y-3 text-slate-500 text-sm">
                    <li><a href="#" class="hover:text-primary transition-colors">Privacy Policy</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Terms of Service</a></li>
                    <li><a href="#" class="hover:text-primary transition-colors">Cookie Policy</a></li>
                </ul>
            </div>
            <div>
                <div class="font-bold text-slate-900 mb-6 text-sm">Support</div>
                <ul class="space-y-3 text-slate-500 text-sm">
                    <li><a href="#" class="hover:text-primary transition-colors">Contact Support</a></li>
                    <li><a href="{{ route('filament.community.auth.login') }}" class="hover:text-primary transition-colors">Member Login</a></li>
                </ul>
            </div>
        </div>
        <div class="max-w-6xl mx-auto px-6 mt-12 pt-8 border-t border-slate-200 text-center text-slate-400 text-sm">
            &copy; {{ date('Y') }} ZionHome Technologies. All rights reserved.
        </div>
    </footer>

</body>
</html>
