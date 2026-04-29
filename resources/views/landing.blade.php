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
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }
        body {
            min-height: max(884px, 100dvh);
            background-color: #faf8ff;
            color: #191b23;
            -webkit-font-smoothing: antialiased;
            overflow-x: hidden;
        }
    </style>
</head>
<body class="font-[Inter]">

    {{-- Top App Bar --}}
    <header class="fixed top-0 left-0 w-full z-50 flex justify-between items-center px-4 h-16 bg-white shadow-sm">
        <div class="flex items-center gap-2">
            <span class="text-lg font-black text-blue-700">ZionHome</span>
        </div>
        <a href="{{ route('filament.community.auth.login') }}"
           class="bg-primary text-white px-4 py-2 rounded-lg text-sm font-semibold transition-all hover:opacity-90 active:scale-95 shadow-sm">
            Login Member
        </a>
    </header>

    <main class="pt-16">

        {{-- Hero Section --}}
        <section class="relative px-6 py-12 flex flex-col items-center text-center bg-gradient-to-b from-white to-surface-container-low">
            <div class="max-w-md mx-auto">
                <span class="inline-block px-3 py-1 mb-4 rounded-full bg-primary-fixed text-on-primary-fixed-variant text-[10px] font-bold uppercase tracking-widest">
                    Cainta Greenland Smart Subdivision
                </span>
                <h1 class="text-[30px] font-semibold leading-tight tracking-tight text-on-background mb-4">
                    Your Community,<br>In Your Pocket.
                </h1>
                <p class="text-[18px] leading-relaxed text-secondary mb-8">
                    The all-in-one app for modern subdivision living.
                </p>
                <div class="relative mt-8 group">
                    <div class="absolute inset-0 bg-primary/10 rounded-[3rem] blur-2xl group-hover:bg-primary/20 transition-all"></div>
                    <img alt="ZionHome App Digital ID"
                         class="relative z-10 w-full max-w-[280px] mx-auto drop-shadow-2xl rounded-[2.5rem] border-[8px] border-on-background"
                         src="https://lh3.googleusercontent.com/aida-public/AB6AXuBYV6DqLSXuL5hIpUl8oxjWHnfkrDLI-F3IFTgreMbxvPuSyOu9D2FDs48M52oCkXwMXk6jWrRjRS1-0hxUKhdP-tpP6lpwzfTbWR23E7mHZPDlXGEPFAGrohxfEYoR66lcRfngiTqrCgBA5ijqSqHIIY0XmUtSjccp5tfHCikL8MqfBH9e46R8lppjcqp2vqN6SBARxulECjV23MgSaqp7Tm0ES3DBhxkeVRTIO8fdJweq-NDOfRLTL4GXlSPJRYLb9GKUsvGATS0D"/>
                </div>
            </div>
        </section>

        {{-- Features Bento Section --}}
        <section class="px-6 py-16 bg-white">
            <div class="max-w-md mx-auto space-y-6">
                <div class="flex flex-col gap-4 text-center mb-10">
                    <h2 class="text-[24px] font-semibold text-on-background">Modern Living Simplified</h2>
                    <p class="text-sm text-secondary">Everything you need to manage your home is just a tap away.</p>
                </div>
                <div class="grid grid-cols-1 gap-4">

                    <div class="p-6 bg-surface-container-low border border-outline-variant/30 rounded-xl hover:bg-white hover:shadow-lg transition-all">
                        <div class="w-12 h-12 rounded-lg bg-primary/10 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-primary">badge</span>
                        </div>
                        <h3 class="text-[20px] font-semibold mb-2">Digital ID &amp; Security</h3>
                        <p class="text-sm text-secondary">Verified homeowner ID and secure QR passes for seamless entry and gate verification.</p>
                    </div>

                    <div class="p-6 bg-surface-container-low border border-outline-variant/30 rounded-xl hover:bg-white hover:shadow-lg transition-all">
                        <div class="w-12 h-12 rounded-lg bg-green-100 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-green-700">payments</span>
                        </div>
                        <h3 class="text-[20px] font-semibold mb-2">Easy Payments</h3>
                        <p class="text-sm text-secondary">Pay dues via GCash, Maya, or bank transfer instantly with real-time digital receipts.</p>
                    </div>

                    <div class="p-6 bg-surface-container-low border border-outline-variant/30 rounded-xl hover:bg-white hover:shadow-lg transition-all">
                        <div class="w-12 h-12 rounded-lg bg-orange-100 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-orange-700">support_agent</span>
                        </div>
                        <h3 class="text-[20px] font-semibold mb-2">Community Care</h3>
                        <p class="text-sm text-secondary">File concerns, report maintenance, and track resolution status through the ticketing system.</p>
                    </div>

                    <div class="p-6 bg-surface-container-low border border-outline-variant/30 rounded-xl hover:bg-white hover:shadow-lg transition-all">
                        <div class="w-12 h-12 rounded-lg bg-purple-100 flex items-center justify-center mb-4">
                            <span class="material-symbols-outlined text-purple-700">event_available</span>
                        </div>
                        <h3 class="text-[20px] font-semibold mb-2">Smart Access</h3>
                        <p class="text-sm text-secondary">Register visitors and book community amenities like the pool or court from anywhere.</p>
                    </div>

                </div>
            </div>
        </section>

        {{-- Social Proof Section --}}
        <section class="px-6 py-12 bg-surface-container">
            <div class="max-w-md mx-auto text-center">
                <p class="text-[10px] font-bold text-secondary uppercase mb-8 tracking-widest">
                    Trusted by premier HOAs across Metro Manila
                </p>
                <div class="flex flex-wrap justify-center gap-8 opacity-60 grayscale">
                    <div class="flex items-center gap-1 font-bold text-lg">
                        <span class="material-symbols-outlined">domain</span> PRIMEWOOD
                    </div>
                    <div class="flex items-center gap-1 font-bold text-lg">
                        <span class="material-symbols-outlined">park</span> LAKESIDE
                    </div>
                    <div class="flex items-center gap-1 font-bold text-lg">
                        <span class="material-symbols-outlined">villa</span> THE HEIGHTS
                    </div>
                </div>
            </div>
        </section>

        {{-- Call to Action Section --}}
        <section class="px-6 py-20 bg-primary-container text-white">
            <div class="max-w-md mx-auto text-center">
                <h2 class="text-[24px] font-semibold mb-4">Ready to simplify your home life?</h2>
                <p class="text-base text-on-primary-container mb-10 opacity-90">
                    Join thousands of residents enjoying a smarter, safer way of living.
                </p>
                <div class="flex flex-col gap-4">
                    <button class="bg-white text-primary w-full py-4 rounded-xl font-semibold text-lg shadow-xl active:scale-95 transition-all flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined">download</span> Download Now
                    </button>
                    <div class="flex justify-center gap-6 mt-4 opacity-80">
                        <div class="flex flex-col items-center gap-1">
                            <span class="material-symbols-outlined">phone_iphone</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">App Store</span>
                        </div>
                        <div class="flex flex-col items-center gap-1">
                            <span class="material-symbols-outlined">play_store_installed</span>
                            <span class="text-[10px] font-bold uppercase tracking-widest">Play Store</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Map Visual --}}
        <section class="w-full h-48 relative overflow-hidden">
            <img class="w-full h-full object-cover opacity-50 contrast-125 grayscale"
                 alt="Aerial map of residential subdivision"
                 src="https://lh3.googleusercontent.com/aida-public/AB6AXuCeeeaibDLTeWBtQMVwjg1n6toEx2477__1oANTdmwHJ1ajYMkDl5XSbn73Oe2JFmhs1WY9PpqxKliPTd92kzggsel1SBaOIyukrasEo9ci_9n4CwL4j6Sj2sQz_F49mFWv0B-lzMNtfFh1T0XRSsDhSjh6C6fttopCZ4ef5szeRf3rNNV0vjcn0dN9eaecLPj52IL3NrnyzIsJS4LocSxMmMLN0CZojUsGN2Z2_JUUCKfvF5yWFJ3g6reOn4Ss88CELnw_uc19c2hk"/>
            <div class="absolute inset-0 bg-gradient-to-t from-surface to-transparent"></div>
        </section>

    </main>

    {{-- Footer --}}
    <footer class="bg-surface text-secondary px-6 py-12 pb-24 border-t border-outline-variant/20">
        <div class="max-w-md mx-auto">
            <div class="font-black text-blue-700 text-xl mb-4">ZionHome</div>
            <p class="text-sm mb-8">Empowering neighborhood associations with smart technology for safer and more connected communities.</p>
            <div class="grid grid-cols-2 gap-8 text-[12px] font-semibold">
                <div class="flex flex-col gap-3">
                    <a class="hover:text-primary transition-colors" href="#">Privacy Policy</a>
                    <a class="hover:text-primary transition-colors" href="#">Terms of Service</a>
                </div>
                <div class="flex flex-col gap-3">
                    <a class="hover:text-primary transition-colors" href="#">Contact Support</a>
                    <a class="hover:text-primary transition-colors" href="{{ route('filament.community.auth.login') }}">Login Member</a>
                </div>
            </div>
            <p class="mt-12 text-[10px] text-slate-400">&copy; {{ date('Y') }} ZionHome Technologies. All rights reserved.</p>
        </div>
    </footer>

</body>
</html>
