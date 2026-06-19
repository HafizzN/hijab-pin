<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Hijab Pin House') — Premium Hijab Accessories</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=DM+Sans:ital,opsz,wght@0,9..40,300;0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        /* Base */
        * { font-family: 'DM Sans', sans-serif; }
        .font-display { font-family: 'Cormorant Garamond', serif !important; }
        [x-cloak] { display: none !important; }

        /* Scrollbar */
        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #FAF6F0; }
        ::-webkit-scrollbar-thumb { background: #E8D5B0; border-radius: 99px; }

        /* Ticker */
        @keyframes ticker {
            0%   { transform: translateX(0); }
            100% { transform: translateX(-50%); }
        }
        .ticker-wrap { overflow: hidden; white-space: nowrap; }
        .ticker-inner { display: inline-flex; animation: ticker 28s linear infinite; }
        .ticker-inner:hover { animation-play-state: paused; }

        /* Nav link underline */
        .nav-item {
            display: inline-block;
            position: relative;
            text-decoration: none;
        }
        .nav-item::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 0;
            height: 2px;
            background-color: #C5A46B;
            transition: width 0.3s ease;
        }
        .nav-item:hover::after {
            width: 100%;
        }

        /* Nav shadow on scroll */
        .nav-scrolled { box-shadow: 0 4px 30px rgba(28,25,21,.08); }

        /* Blob decoration */
        .blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(80px);
            pointer-events: none;
        }

        /* Card hover glow */
        .card-glow { transition: box-shadow .35s ease, transform .35s ease; }
        .card-glow:hover {
            box-shadow: 0 20px 48px rgba(197,164,107,0.18);
            transform: translateY(-6px);
        }

        /* Reveal on scroll */
        .reveal {
            opacity: 0;
            transform: translateY(24px);
            transition: opacity 0.6s ease, transform 0.6s ease;
        }
        .reveal.visible { opacity: 1; transform: translateY(0); }

        /* Button pulse ring */
        @keyframes ring-pulse {
            0%   { box-shadow: 0 0 0 0 rgba(197,164,107,.45); }
            80%  { box-shadow: 0 0 0 12px rgba(197,164,107,0); }
            100% { box-shadow: 0 0 0 0 rgba(197,164,107,0); }
        }
        .btn-ring:hover { animation: ring-pulse 1.2s ease-out infinite; }

        /* Button shimmer */
        @keyframes shimmer-slide {
            0%   { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(220%) skewX(-15deg); }
        }
        .btn-shimmer { position: relative; overflow: hidden; }
        .btn-shimmer::after {
            content: '';
            position: absolute; top: 0; left: 0;
            width: 40%; height: 100%;
            background: linear-gradient(90deg,transparent,rgba(255,255,255,.2),transparent);
            animation: shimmer-slide 2.2s ease-in-out infinite;
        }

        /* Float animation */
        @keyframes float-up {
            0%,100% { transform: translateY(0); }
            50%      { transform: translateY(-10px); }
        }
        .float-anim      { animation: float-up 5s ease-in-out infinite; }
        .float-anim-slow { animation: float-up 7s ease-in-out infinite reverse; }

        /* Section helpers */
        .section-eyebrow {
            color: #C5A46B;
            font-size: 0.75rem;
            letter-spacing: 0.15em;
            font-weight: 700;
            text-transform: uppercase;
        }
        .form-input {
            width: 100%; padding: 0.875rem 1.25rem;
            border-radius: 1rem; border: 1px solid #e5e7eb;
            background: #f9fafb; font-size: 0.875rem;
            color: #1C1915; outline: none;
            transition: all 0.2s ease;
        }
        .form-input:focus { background: #fff; border-color: #C5A46B; box-shadow: 0 0 0 3px rgba(197,164,107,0.15); }
        .form-input::placeholder { color: #9ca3af; }
    </style>
</head>
<body class="bg-[#FAF6F0] text-[#1C1915] min-h-screen flex flex-col antialiased" x-data="{ cartOpen: false, mobileMenu: false }">

    <!-- ══ Top ticker ══ -->

    <div class="bg-[#1C1915] text-[#FAF6F0] py-2.5 overflow-hidden text-xs font-medium tracking-widest">
        <div class="ticker-wrap">
            <div class="ticker-inner gap-16 px-8">
                @foreach(range(1,2) as $_)
                <span class="inline-flex items-center gap-10">
                    <span class="flex items-center gap-2 opacity-90"><i data-lucide="package" class="w-3 h-3 text-[#C5A46B]"></i> Gratis Ongkir Pembelian ≥ Rp 150.000</span>
                    <span class="text-[#C5A46B]">✦</span>
                    <span class="flex items-center gap-2 opacity-90"><i data-lucide="shield-check" class="w-3 h-3 text-[#C5A46B]"></i> Bahan Premium • Tidak Mudah Pudar</span>
                    <span class="text-[#C5A46B]">✦</span>
                    <span class="flex items-center gap-2 opacity-90"><i data-lucide="heart" class="w-3 h-3 text-[#C5A46B]"></i> Aman untuk Semua Jenis Hijab</span>
                    <span class="text-[#C5A46B]">✦</span>
                    <span class="flex items-center gap-2 opacity-90"><i data-lucide="phone" class="w-3 h-3 text-[#C5A46B]"></i> WA: 0838-2110-2186</span>
                    <span class="text-[#C5A46B]">✦</span>
                </span>
                @endforeach
            </div>
        </div>
    </div>

    <!-- ══ Navigation ══ -->
    <nav id="main-nav" class="sticky top-0 z-40 bg-white/95 backdrop-blur-xl border-b border-[#E8D5B0]/40 transition-all duration-300">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 h-20 flex items-center justify-between gap-6">

            <!-- Logo -->
            <a href="{{ route('shop.index') }}" class="flex items-center gap-3.5 group shrink-0">
                <div class="relative">
                    <img src="{{ asset('logo.jpeg') }}" alt="Hijab Pin House" class="h-12 w-12 rounded-full object-cover border-2 border-[#C5A46B]/40 shadow transition-transform duration-300 group-hover:scale-110">
                    <div class="absolute -inset-1 rounded-full border border-[#C5A46B]/25 scale-0 group-hover:scale-100 transition-transform duration-300"></div>
                </div>
                <div class="leading-none">
                    <div class="font-display text-2xl font-semibold italic text-[#1C1915] leading-none">Hijab Pin</div>
                    <div class="text-[9px] uppercase tracking-[.25em] text-[#C5A46B] font-semibold mt-0.5">House Premium</div>
                </div>
            </a>

            <!-- Desktop links -->
            <div class="hidden lg:flex items-center gap-8">
                <a href="{{ route('shop.index') }}" class="nav-item text-sm font-medium text-[#1C1915] hover:text-[#C5A46B] transition-colors pb-0.5">Belanja</a>
                <a href="{{ route('shop.index') }}?category=premium-pins" class="nav-item text-sm font-medium text-[#6B5E52] hover:text-[#C5A46B] transition-colors pb-0.5">Premium Pins</a>
                <a href="{{ route('shop.index') }}?category=brooches-rings" class="nav-item text-sm font-medium text-[#6B5E52] hover:text-[#C5A46B] transition-colors pb-0.5">Bros & Cincin</a>
                <a href="https://wa.me/6283821102186" target="_blank" class="nav-item text-sm font-medium text-[#6B5E52] hover:text-[#C5A46B] transition-colors pb-0.5">Hubungi Kami</a>
            </div>

            <!-- Right actions -->
            <div class="flex items-center gap-2 sm:gap-3">
                @auth
                    <div class="relative" x-data="{ open: false }">
                        <button @click="open = !open" class="flex items-center gap-2 pl-1 pr-3 py-1.5 rounded-full border border-[#E8D5B0] hover:border-[#C5A46B] hover:bg-[#C5A46B]/5 transition-all group">
                            <div class="h-8 w-8 rounded-full bg-gradient-to-br from-[#C5A46B] to-[#1C1915] flex items-center justify-center text-white font-bold text-sm">
                                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                            </div>
                            <span class="hidden sm:block text-sm font-medium text-[#1C1915] max-w-[90px] truncate">{{ auth()->user()->name }}</span>
                            <i data-lucide="chevron-down" class="w-3.5 h-3.5 text-[#C5A46B] transition-transform duration-200" :class="open ? 'rotate-180' : ''"></i>
                        </button>

                        <div x-show="open" @click.away="open = false" x-cloak
                             x-transition:enter="transition ease-out duration-150"
                             x-transition:enter-start="opacity-0 scale-95 -translate-y-2"
                             x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                             x-transition:leave="transition ease-in duration-100"
                             x-transition:leave-start="opacity-100 scale-100"
                             x-transition:leave-end="opacity-0 scale-95"
                             class="absolute right-0 top-full mt-3 w-60 bg-white border border-[#E8D5B0]/40 rounded-2xl shadow-2xl overflow-hidden z-50">

                            <div class="px-5 py-4 bg-gradient-to-br from-[#C5A46B]/8 to-transparent border-b border-[#E8D5B0]/25">
                                <p class="text-xs text-[#6B5E52]">Masuk sebagai</p>
                                <p class="font-semibold text-sm text-[#1C1915] mt-0.5 truncate">{{ auth()->user()->email }}</p>
                            </div>

                            <div class="p-2">
                                @if(auth()->user()->isAdmin())
                                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-[#C5A46B]/8 text-[#1C1915] transition-colors text-sm">
                                        <i data-lucide="layout-dashboard" class="w-4 h-4 text-[#C5A46B]"></i> Dashboard Admin
                                    </a>
                                @else
                                    <a href="{{ route('dashboard') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-[#C5A46B]/8 text-[#1C1915] transition-colors text-sm">
                                        <i data-lucide="user-circle-2" class="w-4 h-4 text-[#C5A46B]"></i> Dashboard Saya
                                    </a>
                                    <a href="{{ route('orders.index') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-[#C5A46B]/8 text-[#1C1915] transition-colors text-sm">
                                        <i data-lucide="shopping-bag" class="w-4 h-4 text-[#C5A46B]"></i> Riwayat Pesanan
                                    </a>
                                @endif
                                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-[#C5A46B]/8 text-[#1C1915] transition-colors text-sm">
                                    <i data-lucide="settings" class="w-4 h-4 text-[#6B5E52]"></i> Pengaturan Akun
                                </a>
                                <div class="border-t border-[#E8D5B0]/30 mt-1 pt-1">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <button type="submit" class="w-full flex items-center gap-3 px-3 py-2.5 rounded-xl hover:bg-rose-50 text-rose-600 transition-colors text-sm">
                                            <i data-lucide="log-out" class="w-4 h-4"></i> Keluar
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 text-sm font-medium text-[#1C1915] hover:text-[#C5A46B] transition-colors px-4 py-2 rounded-full border border-[#E8D5B0] hover:border-[#C5A46B] hover:bg-[#C5A46B]/5">
                        <i data-lucide="log-in" class="w-4 h-4"></i> Masuk
                    </a>
                    <a href="{{ route('register') }}" class="hidden sm:flex items-center gap-2 text-sm font-semibold text-white bg-[#1C1915] hover:bg-[#C5A46B] transition-colors px-5 py-2 rounded-full btn-ring">
                        Daftar
                    </a>
                @endauth

                <!-- Cart -->
                <button @click="cartOpen = true"
                        class="relative flex items-center justify-center h-10 w-10 bg-[#1C1915] hover:bg-[#C5A46B] text-white rounded-full transition-all duration-300 shadow-md hover:shadow-lg btn-ring focus:outline-none">
                    <i data-lucide="shopping-cart" class="w-4 h-4"></i>
                    @php
                        $cartCount = 0;
                        $cart = session()->get('cart', []);
                        foreach($cart as $item) { $cartCount += $item['quantity']; }
                    @endphp
                    @if($cartCount > 0)
                        <span class="absolute -top-1.5 -right-1.5 bg-[#C5A46B] text-white text-[9px] font-bold h-5 w-5 rounded-full flex items-center justify-center border-2 border-white">
                            {{ $cartCount }}
                        </span>
                    @endif
                </button>

                <!-- Hamburger -->
                <button @click="mobileMenu = !mobileMenu" class="lg:hidden flex items-center justify-center h-10 w-10 rounded-full border border-[#E8D5B0] hover:border-[#C5A46B] transition-colors">
                    <i data-lucide="menu" class="w-5 h-5" x-show="!mobileMenu"></i>
                    <i data-lucide="x" class="w-5 h-5" x-show="mobileMenu" x-cloak></i>
                </button>
            </div>
        </div>

        <!-- Mobile menu -->
        <div x-show="mobileMenu" x-cloak
             x-transition:enter="transition ease-out duration-200"
             x-transition:enter-start="opacity-0 -translate-y-4"
             x-transition:enter-end="opacity-100 translate-y-0"
             x-transition:leave="transition ease-in duration-150"
             x-transition:leave-end="opacity-0 -translate-y-4"
             class="lg:hidden border-t border-[#E8D5B0]/30 bg-white px-5 py-6 space-y-1">
            <a href="{{ route('shop.index') }}" @click="mobileMenu=false" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#C5A46B]/8 text-base font-medium text-[#1C1915]">
                <i data-lucide="store" class="w-5 h-5 text-[#C5A46B]"></i> Belanja
            </a>
            <a href="{{ route('shop.index') }}?category=premium-pins" @click="mobileMenu=false" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#C5A46B]/8 text-base font-medium text-[#1C1915]">
                <i data-lucide="gem" class="w-5 h-5 text-[#C5A46B]"></i> Premium Pins
            </a>
            <a href="{{ route('shop.index') }}?category=brooches-rings" @click="mobileMenu=false" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#C5A46B]/8 text-base font-medium text-[#1C1915]">
                <i data-lucide="star" class="w-5 h-5 text-[#C5A46B]"></i> Bros & Cincin
            </a>
            <a href="https://wa.me/6283821102186" target="_blank" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-[#C5A46B]/8 text-base font-medium text-[#1C1915]">
                <i data-lucide="message-circle" class="w-5 h-5 text-[#C5A46B]"></i> WhatsApp Kami
            </a>
            @guest
            <div class="pt-4 border-t border-[#E8D5B0]/30 flex gap-3">
                <a href="{{ route('login') }}" class="flex-1 text-center py-3 border border-[#C5A46B] text-[#1C1915] rounded-xl font-semibold text-sm">Masuk</a>
                <a href="{{ route('register') }}" class="flex-1 text-center py-3 bg-[#1C1915] text-white rounded-xl font-semibold text-sm">Daftar</a>
            </div>
            @endguest
        </div>
    </nav>

    <!-- ══ Toast Notifications ══ -->
    <div class="fixed top-24 right-5 z-50 flex flex-col gap-3 max-w-sm w-full pointer-events-none">
        @if(session('success'))
            <div class="bg-white border border-emerald-200 shadow-2xl text-[#1C1915] p-4 rounded-2xl flex items-start gap-3 pointer-events-auto"
                 x-data="{ show: true }" x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-init="setTimeout(() => show = false, 4500)">
                <div class="h-9 w-9 rounded-full bg-emerald-50 flex items-center justify-center shrink-0">
                    <i data-lucide="check" class="w-4 h-4 text-emerald-600"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm text-emerald-700">Berhasil!</p>
                    <p class="text-xs text-[#6B5E52] mt-0.5">{{ session('success') }}</p>
                </div>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600 mt-0.5"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-white border border-rose-200 shadow-2xl text-[#1C1915] p-4 rounded-2xl flex items-start gap-3 pointer-events-auto"
                 x-data="{ show: true }" x-show="show"
                 x-transition:enter="transition ease-out duration-300"
                 x-transition:enter-start="opacity-0 translate-x-8"
                 x-transition:enter-end="opacity-100 translate-x-0"
                 x-init="setTimeout(() => show = false, 5000)">
                <div class="h-9 w-9 rounded-full bg-rose-50 flex items-center justify-center shrink-0">
                    <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-600"></i>
                </div>
                <div class="flex-1">
                    <p class="font-semibold text-sm text-rose-700">Terjadi Kesalahan</p>
                    <p class="text-xs text-[#6B5E52] mt-0.5">{{ session('error') }}</p>
                </div>
                <button @click="show = false" class="text-gray-400 hover:text-gray-600 mt-0.5"><i data-lucide="x" class="w-4 h-4"></i></button>
            </div>
        @endif
    </div>

    <!-- ══ Main Content ══ -->
    <main class="flex-grow">
        @yield('content')
    </main>

    <!-- ══ Cart Drawer ══ -->
    <div x-show="cartOpen" class="fixed inset-0 z-50 overflow-hidden" x-cloak>
        <div class="absolute inset-0 bg-[#1C1915]/50 backdrop-blur-sm"
             x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
             x-transition:leave="ease-in duration-200" x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
             @click="cartOpen = false"></div>

        <div class="pointer-events-none absolute inset-y-0 right-0 flex max-w-full pl-12">
            <div class="pointer-events-auto w-screen max-w-[420px]"
                 x-transition:enter="transform transition ease-out duration-300"
                 x-transition:enter-start="translate-x-full" x-transition:enter-end="translate-x-0"
                 x-transition:leave="transform transition ease-in duration-250"
                 x-transition:leave-start="translate-x-0" x-transition:leave-end="translate-x-full">
                <div class="flex h-full flex-col bg-white">
                    <!-- Cart Header -->
                    <div class="flex items-center justify-between px-7 py-6 border-b border-gray-100 bg-[#FAF6F0]">
                        <div>
                            <h2 class="font-display text-2xl font-semibold italic text-[#1C1915]">Keranjang</h2>
                            <p class="text-xs text-[#6B5E52] mt-0.5">Hijab Pin House</p>
                        </div>
                        <button @click="cartOpen = false" class="h-10 w-10 flex items-center justify-center rounded-full border border-gray-200 hover:border-[#C5A46B] hover:bg-[#C5A46B]/5 transition-all text-gray-500 hover:text-[#1C1915]">
                            <i data-lucide="x" class="w-5 h-5"></i>
                        </button>
                    </div>

                    <!-- Cart Items -->
                    <div class="flex-grow overflow-y-auto px-7 py-5">
                        @php $cart = session()->get('cart', []); @endphp
                        @if(empty($cart))
                            <div class="flex flex-col items-center justify-center h-full text-center py-16 space-y-4">
                                <div class="h-20 w-20 rounded-full bg-[#C5A46B]/10 flex items-center justify-center">
                                    <i data-lucide="shopping-cart" class="w-9 h-9 text-[#C5A46B]"></i>
                                </div>
                                <div>
                                    <h3 class="font-display text-xl font-semibold italic text-[#1C1915]">Keranjang Kosong</h3>
                                    <p class="text-sm text-[#6B5E52] mt-1 max-w-[200px] leading-relaxed">Temukan koleksi pin hijab eksklusif kami.</p>
                                </div>
                                <a href="{{ route('shop.index') }}" @click="cartOpen = false"
                                   class="mt-2 inline-flex items-center gap-2 bg-[#1C1915] hover:bg-[#C5A46B] text-white text-sm font-semibold px-6 py-3 rounded-full transition-all btn-ring">
                                    <i data-lucide="store" class="w-4 h-4"></i> Mulai Belanja
                                </a>
                            </div>
                        @else
                            @php $subtotal = 0; @endphp
                            <div class="space-y-5">
                                @foreach($cart as $id => $item)
                                    @php $subtotal += $item['price'] * $item['quantity']; @endphp
                                    <div class="flex gap-4 py-4 border-b border-gray-100 last:border-0">
                                        <div class="h-20 w-20 flex-shrink-0 overflow-hidden rounded-xl border border-gray-100 bg-gray-50">
                                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                        </div>
                                        <div class="flex flex-1 flex-col justify-between min-w-0">
                                            <div>
                                                <h4 class="font-semibold text-sm text-[#1C1915] leading-snug truncate pr-2">
                                                    <a href="{{ route('shop.show', $item['slug']) }}" @click="cartOpen = false">{{ $item['name'] }}</a>
                                                </h4>
                                                <p class="text-sm font-bold text-[#C5A46B] mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                            </div>
                                            <div class="flex items-center justify-between mt-2">
                                                <form method="POST" action="{{ route('cart.update', $id) }}" class="flex items-center bg-gray-50 border border-gray-200 rounded-xl overflow-hidden">
                                                    @csrf
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-3 py-1.5 hover:bg-gray-100 text-gray-500 font-bold transition-colors text-sm">−</button>
                                                    <span class="px-3 text-sm font-semibold text-[#1C1915]">{{ $item['quantity'] }}</span>
                                                    <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-3 py-1.5 hover:bg-gray-100 text-gray-500 font-bold transition-colors text-sm">+</button>
                                                </form>
                                                <form method="POST" action="{{ route('cart.remove', $id) }}">
                                                    @csrf
                                                    <button type="submit" class="text-rose-400 hover:text-rose-600 transition-colors p-1.5 rounded-lg hover:bg-rose-50">
                                                        <i data-lucide="trash-2" class="w-4 h-4"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>

                    <!-- Cart Footer -->
                    @if(!empty($cart))
                        <div class="border-t border-gray-100 px-7 py-6 bg-[#FAF6F0] space-y-4">
                            <div class="flex justify-between items-center">
                                <span class="text-sm text-[#6B5E52]">Subtotal</span>
                                <span class="text-lg font-bold text-[#1C1915]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                            </div>
                            <p class="text-xs text-[#6B5E52]">Ongkos kirim dihitung saat checkout.</p>
                            <a href="{{ route('checkout.index') }}" @click="cartOpen = false"
                               class="flex items-center justify-center gap-2 w-full bg-[#1C1915] hover:bg-[#C5A46B] text-white py-4 rounded-2xl font-semibold text-sm transition-all duration-300 btn-ring">
                                <i data-lucide="credit-card" class="w-4 h-4"></i> Lanjut ke Checkout
                            </a>
                            <button @click="cartOpen = false" class="w-full text-center text-sm text-[#6B5E52] hover:text-[#C5A46B] transition-colors py-1">
                                ← Lanjut Belanja
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- ══ Footer ══ -->
    <footer class="bg-[#1C1915] text-white">
        <div class="max-w-7xl mx-auto px-5 sm:px-8 pt-20 pb-12 grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-12">

            <!-- Brand -->
            <div class="space-y-5 lg:col-span-1">
                <div class="flex items-center gap-3">
                    <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-12 w-12 rounded-full border-2 border-[#C5A46B]/30 object-cover">
                    <div>
                        <div class="font-display text-xl font-semibold italic text-white">Hijab Pin House</div>
                        <div class="text-[10px] uppercase tracking-widest text-[#C5A46B] font-medium">Premium Quality</div>
                    </div>
                </div>
                <p class="text-sm leading-relaxed text-white/55">
                    Cantik, elegan, dan nyaman untuk setiap hijabmu. Pin hijab terbaik dengan bahan premium yang aman dan tidak mudah pudar.
                </p>
                <div class="flex gap-3 pt-1">
                    <a href="https://instagram.com/hijab_pin_house" target="_blank" class="h-10 w-10 rounded-full border border-white/10 hover:border-[#C5A46B] hover:bg-[#C5A46B]/10 flex items-center justify-center transition-all text-white/50 hover:text-white">
                        <i data-lucide="instagram" class="w-4 h-4"></i>
                    </a>
                    <a href="https://facebook.com/hijabpinhouse" target="_blank" class="h-10 w-10 rounded-full border border-white/10 hover:border-[#C5A46B] hover:bg-[#C5A46B]/10 flex items-center justify-center transition-all text-white/50 hover:text-white">
                        <i data-lucide="facebook" class="w-4 h-4"></i>
                    </a>
                    <a href="https://wa.me/6283821102186" target="_blank" class="h-10 w-10 rounded-full border border-white/10 hover:border-[#C5A46B] hover:bg-[#C5A46B]/10 flex items-center justify-center transition-all text-white/50 hover:text-white">
                        <i data-lucide="message-circle" class="w-4 h-4"></i>
                    </a>
                </div>
                <div class="space-y-2 pt-2 border-t border-white/5">
                    <span class="text-[10px] text-white/40 uppercase tracking-widest font-semibold block">Official Store</span>
                    <div class="flex flex-wrap gap-2">
                        <a href="https://id.shp.ee/JuGwMo5q" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-white/5 border border-white/10 hover:border-[#C5A46B] text-xs text-white/60 hover:text-white transition-all">
                            <span class="text-orange-500 font-extrabold">S</span> Shopee
                        </a>
                        <a href="https://tk.tokopedia.com/ZSQvfd611/" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-white/5 border border-white/10 hover:border-[#C5A46B] text-xs text-white/60 hover:text-white transition-all">
                            <span class="text-emerald-500 font-extrabold">T</span> Tokopedia
                        </a>
                        <a href="https://www.lazada.co.id/shop/hijabpinhouse" target="_blank" class="inline-flex items-center gap-1.5 px-2.5 py-1.5 rounded-lg bg-white/5 border border-white/10 hover:border-[#C5A46B] text-xs text-white/60 hover:text-white transition-all">
                            <span class="text-blue-500 font-extrabold">L</span> Lazada
                        </a>
                    </div>
                </div>
            </div>

            <!-- Koleksi -->
            <div>
                <h4 class="font-display text-lg font-semibold italic text-white mb-5">Koleksi</h4>
                <ul class="space-y-3 text-sm">
                    @foreach([
                        ['Semua Produk', route('shop.index')],
                        ['Premium Pins', route('shop.index').'?category=premium-pins'],
                        ['Brooches & Rings', route('shop.index').'?category=brooches-rings'],
                    ] as $link)
                    <li><a href="{{ $link[1] }}" class="text-white/50 hover:text-[#C5A46B] transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> {{ $link[0] }}</a></li>
                    @endforeach
                </ul>
            </div>

            <!-- Layanan -->
            <div>
                <h4 class="font-display text-lg font-semibold italic text-white mb-5">Layanan</h4>
                <ul class="space-y-3 text-sm">
                    @auth
                    <li><a href="{{ route('dashboard') }}" class="text-white/50 hover:text-[#C5A46B] transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Dashboard Saya</a></li>
                    <li><a href="{{ route('orders.index') }}" class="text-white/50 hover:text-[#C5A46B] transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Riwayat Pesanan</a></li>
                    @endauth
                    <li><a href="https://wa.me/6283821102186" target="_blank" class="text-white/50 hover:text-[#C5A46B] transition-colors flex items-center gap-2"><i data-lucide="chevron-right" class="w-3 h-3"></i> Cara Pemesanan</a></li>
                </ul>
            </div>

            <!-- Kontak -->
            <div>
                <h4 class="font-display text-lg font-semibold italic text-white mb-5">Hubungi Kami</h4>
                <ul class="space-y-4 text-sm">
                    <li class="flex items-start gap-3">
                        <div class="h-8 w-8 rounded-lg bg-[#C5A46B]/10 flex items-center justify-center shrink-0 mt-0.5">
                            <i data-lucide="map-pin" class="w-3.5 h-3.5 text-[#C5A46B]"></i>
                        </div>
                        <span class="text-white/50 leading-relaxed">Perumahan Taman Anugerah, Blok G7, Balai Gadang, Kec. Koto Tangah</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-lg bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                            <i data-lucide="mail" class="w-3.5 h-3.5 text-[#C5A46B]"></i>
                        </div>
                        <span class="text-white/50">hijabpinhouse@gmail.com</span>
                    </li>
                    <li class="flex items-center gap-3">
                        <div class="h-8 w-8 rounded-lg bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                            <i data-lucide="phone" class="w-3.5 h-3.5 text-[#C5A46B]"></i>
                        </div>
                        <a href="https://wa.me/6283821102186" target="_blank" class="text-white/50 hover:text-[#C5A46B] transition-colors">0838-2110-2186</a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="border-t border-white/5 px-5 sm:px-8 py-6">
            <div class="max-w-7xl mx-auto flex flex-col sm:flex-row items-center justify-between gap-3 text-xs text-white/30">
                <div>
                    <p>&copy; {{ date('Y') }} Hijab Pin House Premium Quality. Semua Hak Dilindungi.</p>
                    <p class="mt-0.5">Dikelola oleh <span class="text-[#C5A46B]/60">Meri Purnama Sari</span> &nbsp;·&nbsp; NIB: 0406260106079</p>
                </div>
                <div class="flex gap-4">
                    <a href="#" class="hover:text-[#C5A46B] transition-colors">Kebijakan Privasi</a>
                    <a href="#" class="hover:text-[#C5A46B] transition-colors">Syarat & Ketentuan</a>
                </div>
            </div>
        </div>
    </footer>

    <!-- ══ Scripts ══ -->
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            // Nav shadow on scroll
            const nav = document.getElementById('main-nav');
            window.addEventListener('scroll', () => {
                nav.classList.toggle('nav-scrolled', window.scrollY > 10);
            });

            // Reveal on scroll
            const reveals = document.querySelectorAll('.reveal');
            const observer = new IntersectionObserver((entries) => {
                entries.forEach((e, i) => {
                    if (e.isIntersecting) {
                        setTimeout(() => e.target.classList.add('visible'), i * 80);
                        observer.unobserve(e.target);
                    }
                });
            }, { threshold: 0.1 });
            reveals.forEach(el => observer.observe(el));
        });
    </script>
</body>
</html>
