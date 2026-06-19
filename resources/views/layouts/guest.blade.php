<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Hijab Pin House') }} — Premium Hijab Accessories</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:ital,wght@0,400;0,500;0,600;0,700;1,400;1,600&family=DM+Sans:opsz,wght@9..40,300;9..40,400;9..40,500;9..40,600;9..40,700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://unpkg.com/lucide@latest"></script>
</head>
<body class="min-h-screen antialiased bg-[#FAF6F0] text-[#1C1915] overflow-x-hidden">

    <div class="min-h-screen grid grid-cols-1 lg:grid-cols-2">

        {{-- ══ LEFT PANEL — Brand Showcase ══ --}}
        <div class="relative hidden lg:flex flex-col justify-between bg-[#1C1915] p-14 overflow-hidden">

            {{-- Background decorations --}}
            <div class="absolute inset-0" style="background: radial-gradient(ellipse 60% 50% at 50% 0%, rgba(197,164,107,0.2) 0%, transparent 100%)"></div>
            <div class="absolute -bottom-20 -right-20 w-96 h-96 rounded-full bg-[#C5A46B]/15 blur-3xl"></div>
            <div class="absolute top-1/3 -left-10 w-48 h-48 rounded-full bg-[#C5A46B]/8 blur-2xl"></div>

            {{-- Floating circles --}}
            <div class="float-anim absolute top-1/4 right-12 h-8 w-8 rounded-full border-2 border-[#C5A46B]/25"></div>
            <div class="float-anim-slow absolute top-1/3 right-1/4 h-4 w-4 rounded-full bg-[#C5A46B]/20"></div>
            <div class="float-anim absolute bottom-1/3 right-16 h-6 w-6 rounded-full border border-[#C5A46B]/20"></div>

            {{-- Logo --}}
            <a href="{{ route('shop.index') }}" class="flex items-center gap-4 relative z-10">
                <img src="{{ asset('logo.jpeg') }}" alt="Hijab Pin House" class="h-14 w-14 rounded-full border-2 border-[#C5A46B]/30 object-cover shadow-2xl">
                <div>
                    <div class="font-display text-2xl font-semibold italic text-white">Hijab Pin House</div>
                    <div class="text-[10px] uppercase tracking-[.22em] text-[#C5A46B] font-semibold">Premium Quality</div>
                </div>
            </a>

            {{-- Center content --}}
            <div class="relative z-10 space-y-10">
                <div class="space-y-4">
                    <h2 class="font-display text-5xl font-semibold italic text-white leading-[1.1]">
                        Cantik, Elegan, <br><span class="text-[#C5A46B]">Sempurna.</span>
                    </h2>
                    <p class="text-white/60 text-lg leading-relaxed max-w-md">
                        Koleksi pin hijab premium yang dirancang untuk kenyamanan dan keindahan setiap hari.
                    </p>
                </div>

                <div class="space-y-4">
                    @foreach([
                        ['gem','Bahan premium & anti-karat'],
                        ['shield-check','Teknologi anti-sangkut terdepan'],
                        ['heart','Aman untuk semua jenis hijab'],
                        ['truck','Gratis ongkir seluruh Indonesia'],
                    ] as $item)
                    <div class="flex items-center gap-4 text-white/75">
                        <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/12 border border-[#C5A46B]/20 flex items-center justify-center shrink-0">
                            <i data-lucide="{{ $item[0] }}" class="w-4 h-4 text-[#C5A46B]"></i>
                        </div>
                        <span class="text-base font-medium">{{ $item[1] }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Product thumbnails --}}
                <div class="flex gap-3 pt-4">
                    @foreach(['brooch_elegant_1781882608428','chain_flower_1781882516065','pearl_bow_1781882576650'] as $img)
                    <div class="h-20 w-20 rounded-2xl overflow-hidden border border-white/10 bg-white/5">
                        <img src="{{ file_exists(public_path('images/'.$img.'.png')) ? asset('images/'.$img.'.png') : 'https://images.unsplash.com/photo-1535632066927-ab7c9ab60908?q=80&w=200' }}"
                             alt="Product" class="w-full h-full object-cover">
                    </div>
                    @endforeach
                    <div class="h-20 w-20 rounded-2xl border border-white/10 bg-white/5 flex items-center justify-center text-white/40 text-xs text-center font-medium leading-tight">
                        +50<br>Produk
                    </div>
                </div>
            </div>

            {{-- Bottom contact --}}
            <div class="relative z-10 flex items-center gap-4 text-white/35 text-sm">
                <i data-lucide="message-circle" class="w-4 h-4 text-[#C5A46B]/50"></i>
                <span>WA: 0822-6848-0864</span>
                <span class="text-[#C5A46B]/30">·</span>
                <span>@hijab_pin_house</span>
            </div>
        </div>

        {{-- ══ RIGHT PANEL — Auth Form ══ --}}
        <div class="flex flex-col items-center justify-center bg-[#FAF6F0] px-6 sm:px-12 py-16 min-h-screen lg:min-h-0">

            {{-- Mobile logo --}}
            <div class="lg:hidden mb-10 text-center">
                <a href="{{ route('shop.index') }}" class="flex flex-col items-center gap-3">
                    <img src="{{ asset('logo.jpeg') }}" alt="Logo" class="h-16 w-16 rounded-full border-2 border-[#C5A46B]/30 shadow-xl object-cover">
                    <div>
                        <div class="font-display text-3xl font-semibold italic text-[#1C1915]">Hijab Pin House</div>
                        <div class="text-[10px] uppercase tracking-widest text-[#C5A46B] font-semibold mt-0.5">Premium Quality</div>
                    </div>
                </a>
            </div>

            {{-- Form Card --}}
            <div class="w-full max-w-[440px] bg-white rounded-3xl shadow-2xl border border-gray-100 p-10 relative overflow-hidden">
                {{-- Gold top accent --}}
                <div class="absolute top-0 left-8 right-8 h-0.5 bg-gradient-to-r from-transparent via-[#C5A46B] to-transparent rounded-full"></div>

                {{ $slot }}
            </div>

            <p class="mt-8 text-sm text-[#6B5E52] text-center">
                &copy; {{ date('Y') }} Hijab Pin House Premium &nbsp;·&nbsp; NIB: 0406260106079
            </p>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            if (typeof lucide !== 'undefined') lucide.createIcons();
        });
    </script>
</body>
</html>
