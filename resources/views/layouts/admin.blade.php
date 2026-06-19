<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Dashboard Admin - Hijab Pin House</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Playfair+Display:ital,wght@0,400;0,600;0,700;1,400&display=swap" rel="stylesheet">

    <!-- CSS / JS Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Alpine.js -->
    
    <!-- Lucide Icons CDN -->
    <script src="https://unpkg.com/lucide@latest"></script>

    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        .font-playfair {
            font-family: 'Playfair Display', serif;
        }
        [x-cloak] { display: none !important; }
    </style>
</head>
<body class="bg-gray-50 text-gray-800 antialiased min-h-screen flex" x-data="{ sidebarOpen: false }">

    <!-- Sidebar (Desktop) -->
    <aside class="w-64 bg-[#1E1B18] text-[#FAF6F0] shrink-0 hidden md:flex flex-col border-r border-[#C5A880]/10 shadow-lg relative z-20">
        <!-- Logo Header -->
        <div class="p-6 border-b border-gray-800 flex items-center gap-3">
            <img src="{{ asset('logo.jpeg') }}" alt="Logo HP" class="h-10 w-10 rounded-full border border-[#C5A880]/20">
            <div class="flex flex-col">
                <span class="text-lg font-bold font-playfair italic text-white leading-tight">Hijab Pin</span>
                <span class="text-[9px] uppercase tracking-widest text-[#C5A880] -mt-0.5 font-bold">Admin Panel</span>
            </div>
        </div>

        <!-- Navigation Menu -->
        <nav class="flex-grow p-4 space-y-2 mt-4 text-sm font-medium">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Route::is('admin.dashboard') ? 'bg-[#C5A880] text-white' : 'hover:bg-white/5 text-[#FAF6F0]/80 hover:text-white' }}">
                <i data-lucide="layout-dashboard" class="w-4.5 h-4.5"></i> Ringkasan
            </a>

            <a href="{{ route('admin.products.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Route::is('admin.products.*') ? 'bg-[#C5A880] text-white' : 'hover:bg-white/5 text-[#FAF6F0]/80 hover:text-white' }}">
                <i data-lucide="package" class="w-4.5 h-4.5"></i> Kelola Produk
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Route::is('admin.orders.*') ? 'bg-[#C5A880] text-white' : 'hover:bg-white/5 text-[#FAF6F0]/80 hover:text-white' }}">
                <i data-lucide="shopping-bag" class="w-4.5 h-4.5"></i> Kelola Pesanan
            </a>

            <hr class="border-gray-850 my-4">

            <a href="{{ route('shop.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-[#FAF6F0]/70 hover:text-white transition-all">
                <i data-lucide="external-link" class="w-4.5 h-4.5"></i> Lihat Toko
            </a>
        </nav>

        <!-- Footer profile / logout -->
        <div class="p-4 border-t border-gray-800 flex items-center justify-between text-xs">
            <div class="min-w-0">
                <p class="font-bold text-white truncate">{{ auth()->user()->name }}</p>
                <p class="text-[#FAF6F0]/50 mt-0.5 truncate">Administrator</p>
            </div>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="p-2 hover:bg-rose-950/30 hover:text-rose-400 rounded-lg transition-colors text-[#FAF6F0]/60" title="Keluar">
                    <i data-lucide="log-out" class="w-4 h-4"></i>
                </button>
            </form>
        </div>
    </aside>

    <!-- Mobile Sidebar Drawer -->
    <div x-show="sidebarOpen" class="fixed inset-0 overflow-hidden z-50 md:hidden" x-cloak>
        <div class="absolute inset-0 bg-black/60 backdrop-blur-sm" @click="sidebarOpen = false"></div>
        <div class="absolute inset-y-0 left-0 max-w-xs w-full flex">
            <div class="w-64 bg-[#1E1B18] text-[#FAF6F0] flex flex-col shadow-2xl relative">
                <div class="p-6 border-b border-gray-800 flex items-center justify-between">
                    <div class="flex items-center gap-3">
                        <img src="{{ asset('logo.jpeg') }}" alt="Logo HP" class="h-10 w-10 rounded-full border border-[#C5A880]/20">
                        <div class="flex flex-col">
                            <span class="text-base font-bold font-playfair italic text-white">Hijab Pin</span>
                            <span class="text-[9px] uppercase tracking-widest text-[#C5A880] -mt-0.5 font-bold">Admin Panel</span>
                        </div>
                    </div>
                    <button @click="sidebarOpen = false" class="text-gray-400 hover:text-white">
                        <i data-lucide="x" class="w-5 h-5"></i>
                    </button>
                </div>

                <nav class="flex-grow p-4 space-y-2 text-sm font-medium mt-4">
                    <a href="{{ route('admin.dashboard') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Route::is('admin.dashboard') ? 'bg-[#C5A880] text-white' : 'hover:bg-white/5 text-[#FAF6F0]/80' }}">
                        <i data-lucide="layout-dashboard" class="w-4.5 h-4.5"></i> Ringkasan
                    </a>
                    <a href="{{ route('admin.products.index') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Route::is('admin.products.*') ? 'bg-[#C5A880] text-white' : 'hover:bg-white/5 text-[#FAF6F0]/80' }}">
                        <i data-lucide="package" class="w-4.5 h-4.5"></i> Kelola Produk
                    </a>
                    <a href="{{ route('admin.orders.index') }}" @click="sidebarOpen = false" class="flex items-center gap-3 px-4 py-3 rounded-xl transition-all {{ Route::is('admin.orders.*') ? 'bg-[#C5A880] text-white' : 'hover:bg-white/5 text-[#FAF6F0]/80' }}">
                        <i data-lucide="shopping-bag" class="w-4.5 h-4.5"></i> Kelola Pesanan
                    </a>
                    <hr class="border-gray-800 my-4">
                    <a href="{{ route('shop.index') }}" class="flex items-center gap-3 px-4 py-3 rounded-xl hover:bg-white/5 text-[#FAF6F0]/70">
                        <i data-lucide="external-link" class="w-4.5 h-4.5"></i> Lihat Toko
                    </a>
                </nav>

                <div class="p-4 border-t border-gray-800 flex items-center justify-between text-xs">
                    <div>
                        <p class="font-bold text-white">{{ auth()->user()->name }}</p>
                        <p class="text-gray-500 mt-0.5">Administrator</p>
                    </div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="p-2 hover:bg-rose-950/30 text-[#FAF6F0]/60 rounded-lg">
                            <i data-lucide="log-out" class="w-4 h-4"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Content Panel -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Top bar Header -->
        <header class="bg-white border-b border-gray-150 h-16 px-6 flex items-center justify-between sticky top-0 z-10 shadow-sm">
            <!-- Mobile Menu Toggle Button -->
            <button @click="sidebarOpen = true" class="md:hidden p-2 text-gray-500 hover:text-gray-700 focus:outline-none">
                <i data-lucide="menu" class="w-6 h-6"></i>
            </button>

            <!-- Dashboard Title / Breadcrumbs -->
            <div class="hidden sm:flex items-center gap-2 text-xs font-semibold text-gray-500">
                <span class="text-[#2A2421]">Hijab Pin House</span>
                <i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
                <span class="text-gray-400">Admin</span>
                @yield('breadcrumbs')
            </div>

            <!-- Profile and Direct links -->
            <div class="flex items-center gap-4">
                <a href="{{ route('shop.index') }}" class="text-xs font-bold text-[#C5A880] hover:text-[#2A2421] transition-colors flex items-center gap-1">
                    <i data-lucide="home" class="w-3.5 h-3.5"></i> Lihat Toko Utama
                </a>
            </div>
        </header>

        <!-- Dynamic Success & Error Toast Alerts -->
        <div class="fixed top-20 right-6 z-50 flex flex-col gap-2 max-w-sm w-full pointer-events-none">
            @if(session('success'))
                <div class="bg-emerald-50 border-l-4 border-emerald-500 text-emerald-800 p-4 rounded-r-xl shadow-lg flex items-start gap-3 pointer-events-auto transform transition-all duration-300"
                     x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 4000)">
                    <i data-lucide="check-circle" class="w-5 h-5 text-emerald-500 shrink-0 mt-0.5"></i>
                    <div class="flex-1 text-xs">
                        <p class="font-bold text-sm">Berhasil</p>
                        <p class="mt-0.5">{{ session('success') }}</p>
                    </div>
                    <button @click="show = false" class="text-emerald-500 hover:text-emerald-800"><i data-lucide="x" class="w-4 h-4"></i></button>
                </div>
            @endif
            @if(session('error'))
                <div class="bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 rounded-r-xl shadow-lg flex items-start gap-3 pointer-events-auto transform transition-all duration-300"
                     x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 5000)">
                    <i data-lucide="alert-triangle" class="w-5 h-5 text-rose-500 shrink-0 mt-0.5"></i>
                    <div class="flex-1 text-xs">
                        <p class="font-bold text-sm">Gagal</p>
                        <p class="mt-0.5">{{ session('error') }}</p>
                    </div>
                    <button @click="show = false" class="text-rose-500 hover:text-rose-800"><i data-lucide="x" class="w-4 h-4"></i></button>
                </div>
            @endif
        </div>

        <!-- Main Panel Body -->
        <main class="flex-grow p-6 sm:p-8 overflow-y-auto">
            @yield('content')
        </main>
    </div>

    <!-- Initialize Lucide icons -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            lucide.createIcons();
        });
    </script>
</body>
</html>
