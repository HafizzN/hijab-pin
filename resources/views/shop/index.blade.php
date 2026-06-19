@extends('layouts.shop')

@section('title', 'Koleksi Pin Hijab Premium')

@section('content')

{{-- ══ HERO ══ --}}
<section class="relative min-h-[90vh] flex items-center overflow-hidden bg-[#1C1915]">

    {{-- Blobs --}}
    <div class="blob w-[600px] h-[600px] bg-[#C5A46B] -top-40 -right-20" style="opacity:.12"></div>
    <div class="blob w-[400px] h-[400px] bg-[#E8D5B0] bottom-0 -left-20" style="opacity:.08"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-5 sm:px-8 py-28 w-full grid grid-cols-1 lg:grid-cols-2 gap-16 items-center">

        {{-- Left: Text --}}
        <div class="space-y-8">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full border border-[#C5A46B]/30 bg-[#C5A46B]/10 text-[#C5A46B] text-xs font-semibold tracking-widest uppercase">
                <span class="h-1.5 w-1.5 rounded-full bg-[#C5A46B] animate-pulse"></span>
                Koleksi Baru: HP Royal Pearl Series
            </div>

            <h1 class="font-display text-5xl sm:text-6xl lg:text-7xl font-semibold italic text-white leading-[1.05] tracking-tight">
                Sempurnakan <br>Keanggunan <br><span class="text-[#C5A46B]">Hijab Anda.</span>
            </h1>

            <p class="text-white/65 text-lg leading-relaxed max-w-lg">
                Setiap pin & bros dari <strong class="text-white font-semibold">Hijab Pin House</strong> dirancang menggunakan teknologi kawat halus tanpa sangkutan dan bahan premium yang tidak mudah pudar.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="#katalog" class="inline-flex items-center gap-2.5 bg-[#C5A46B] hover:bg-white text-white hover:text-[#1C1915] font-semibold px-8 py-4 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-[1.02] text-base btn-ring">
                    <i data-lucide="store" class="w-5 h-5"></i>
                    Mulai Belanja
                </a>
                <a href="https://wa.me/6282268480864" target="_blank" class="inline-flex items-center gap-2.5 border-2 border-white/20 hover:border-white/50 text-white font-semibold px-8 py-4 rounded-2xl transition-all duration-300 text-base hover:bg-white/5">
                    <i data-lucide="message-circle" class="w-5 h-5"></i>
                    Pesan via WA
                </a>
            </div>

            {{-- Trust badges --}}
            <div class="flex flex-wrap gap-6 pt-4 border-t border-white/10">
                @foreach([['shield-check','Aman untuk Hijab'],['gem','Bahan Premium'],['star','Ribuan Pembeli'],['truck','Gratis Ongkir']] as $badge)
                <div class="flex items-center gap-2 text-white/60 text-sm">
                    <i data-lucide="{{ $badge[0] }}" class="w-4 h-4 text-[#C5A46B]"></i>
                    <span>{{ $badge[1] }}</span>
                </div>
                @endforeach
            </div>
        </div>

        {{-- Right: Featured card --}}
        <div class="flex justify-center lg:justify-end">
            @if($featuredProducts->isNotEmpty())
                @php $heroProduct = $featuredProducts->first(); @endphp
                <div class="relative w-full max-w-sm">
                    <div class="absolute inset-0 rounded-3xl bg-gradient-to-br from-[#C5A46B]/30 to-transparent blur-2xl scale-110"></div>
                    <div class="relative bg-white/8 backdrop-blur-xl border border-white/12 rounded-3xl p-6 space-y-5 group hover:border-[#C5A46B]/30 transition-colors duration-500">
                        <a href="{{ route('shop.show', $heroProduct->slug) }}" class="block aspect-square rounded-2xl overflow-hidden relative bg-white/5">
                            <img src="{{ $heroProduct->image_url }}"
                                 alt="{{ $heroProduct->name }}"
                                 class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105">
                            <div class="absolute top-4 right-4 bg-amber-500 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                                Terlaris
                            </div>
                        </a>
                        <div class="space-y-1.5">
                            <p class="text-[#C5A46B] text-xs uppercase tracking-widest font-semibold">{{ $heroProduct->category->name }}</p>
                            <h3 class="font-display text-xl font-semibold italic text-white hover:text-[#C5A46B] transition-colors">
                                <a href="{{ route('shop.show', $heroProduct->slug) }}">{{ $heroProduct->name }}</a>
                            </h3>
                            <p class="text-white/55 text-sm leading-relaxed line-clamp-2">{{ $heroProduct->description }}</p>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-white/10">
                            <span class="font-display text-2xl font-semibold italic text-[#C5A46B]">Rp {{ number_format($heroProduct->price, 0, ',', '.') }}</span>
                            <form method="POST" action="{{ route('cart.add', $heroProduct->id) }}">
                                @csrf
                                <button type="submit" class="flex items-center gap-2 bg-[#C5A46B] hover:bg-white hover:text-[#1C1915] text-white text-sm font-semibold px-5 py-2.5 rounded-xl transition-all btn-ring">
                                    <i data-lucide="plus" class="w-4 h-4"></i> Tambah
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    {{-- Scroll indicator --}}
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 flex flex-col items-center gap-2 text-white/30 text-xs">
        <span class="tracking-widest uppercase">Scroll</span>
        <div class="h-10 w-px bg-gradient-to-b from-white/30 to-transparent animate-pulse"></div>
    </div>
</section>

{{-- ══ KEUNGGULAN ══ --}}
<section id="keunggulan" class="bg-white py-24 px-5 sm:px-8">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
            <span class="section-eyebrow block mb-4">Mengapa Hijab Pin House?</span>
            <h2 class="section-heading">Kualitas yang Tak Perlu Diragukan</h2>
            <p class="section-subtext mt-4">Kami memahami bahwa kain hijab Anda berharga. Setiap aksesoris kami dibuat dengan standar kualitas tertinggi.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['shield-check','Teknologi Anti-Sangkut','Ujung jarum diasah super halus dengan lapisan mulus, memastikan serat kain hijab tidak akan tertarik atau robek.','bg-amber-50'],
                ['gem','Bahan Tahan Karat','Dilapisi emas 14k asli atau perak rhodium, warna pin tidak pudar walau terkena keringat atau udara lembap.','bg-sky-50'],
                ['heart','Aman & Nyaman','Dirancang agar nyaman sepanjang hari, tanpa mengganggu hijab maupun menyakiti penggunanya.','bg-rose-50'],
            ] as $i => $f)
            <div class="reveal group p-8 rounded-3xl border border-gray-100 {{ $f[3] }} hover:shadow-xl hover:shadow-[#C5A46B]/10 transition-all duration-400 text-center space-y-5 hover:-translate-y-2" style="transition-delay: {{ $i * 80 }}ms">
                <div class="mx-auto h-16 w-16 rounded-2xl bg-[#1C1915] flex items-center justify-center group-hover:bg-[#C5A46B] transition-colors duration-300 shadow-lg">
                    <i data-lucide="{{ $f[0] }}" class="w-7 h-7 text-[#C5A46B] group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="font-display text-2xl font-semibold italic text-[#1C1915]">{{ $f[1] }}</h3>
                <p class="text-[#6B5E52] text-base leading-relaxed">{{ $f[2] }}</p>
            </div>
            @endforeach
        </div>
    </div>
</section>

{{-- ══ KATALOG ══ --}}
<section id="katalog" class="max-w-7xl mx-auto py-24 px-5 sm:px-8">

    {{-- Header + Search --}}
    <div class="flex flex-col lg:flex-row lg:items-end justify-between gap-8 mb-12 reveal">
        <div class="space-y-2">
            <span class="section-eyebrow block">Koleksi Eksklusif</span>
            <h2 class="font-display text-4xl sm:text-5xl font-semibold italic text-[#1C1915] flex items-center gap-3">
                <i data-lucide="sparkles" class="w-7 h-7 text-[#C5A46B]"></i>
                Semua Produk Kami
            </h2>
            <p class="section-subtext">Temukan pilihan pin & bros terbaik untuk kesempurnaan hijab Anda.</p>
        </div>

        <form method="GET" action="{{ route('shop.index') }}#katalog" class="flex items-center gap-3 w-full lg:max-w-sm">
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('sort')) <input type="hidden" name="sort" value="{{ request('sort') }}"> @endif
            <div class="relative flex-1">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Cari peniti, bros..."
                       class="form-input pl-11">
                <i data-lucide="search" class="w-4 h-4 text-[#6B5E52] absolute left-4 top-1/2 -translate-y-1/2"></i>
            </div>
            <button type="submit" class="bg-[#1C1915] hover:bg-[#C5A46B] text-white px-6 py-3.5 rounded-2xl text-sm font-semibold transition-all duration-300 shadow-md btn-ring">
                Cari
            </button>
        </form>
    </div>

    {{-- Filters --}}
    <div class="flex flex-wrap items-center justify-between gap-5 border-b border-gray-100 pb-8 mb-10 reveal">
        <div class="flex flex-wrap gap-2.5">
            <a href="{{ route('shop.index') }}#katalog"
               class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 {{ !request('category') ? 'bg-[#1C1915] text-white shadow-md' : 'bg-white border border-gray-200 text-[#6B5E52] hover:border-[#C5A46B] hover:text-[#1C1915]' }}">
                Semua
            </a>
            @foreach($categories as $cat)
            <a href="{{ route('shop.index') }}?category={{ $cat->slug }}#katalog"
               class="px-5 py-2.5 rounded-full text-sm font-semibold transition-all duration-200 {{ request('category') === $cat->slug ? 'bg-[#1C1915] text-white shadow-md' : 'bg-white border border-gray-200 text-[#6B5E52] hover:border-[#C5A46B] hover:text-[#1C1915]' }}">
                {{ $cat->name }}
            </a>
            @endforeach
        </div>

        <form method="GET" action="{{ route('shop.index') }}#katalog" class="flex items-center gap-3">
            @if(request('category')) <input type="hidden" name="category" value="{{ request('category') }}"> @endif
            @if(request('search')) <input type="hidden" name="search" value="{{ request('search') }}"> @endif
            <span class="text-sm text-[#6B5E52] font-medium">Urutkan:</span>
            <select name="sort" onchange="this.form.submit()"
                    class="rounded-xl border border-gray-200 bg-white text-sm font-medium px-4 py-2.5 text-[#1C1915] focus:border-[#C5A46B] focus:outline-none cursor-pointer transition-colors">
                <option value="latest" {{ request('sort','latest') === 'latest' ? 'selected' : '' }}>Terbaru</option>
                <option value="price_low" {{ request('sort') === 'price_low' ? 'selected' : '' }}>Harga Terendah</option>
                <option value="price_high" {{ request('sort') === 'price_high' ? 'selected' : '' }}>Harga Tertinggi</option>
            </select>
        </form>
    </div>

    {{-- Active filters --}}
    @if(request('search') || request('category'))
    <div class="flex flex-wrap items-center gap-3 mb-8 text-sm">
        <span class="text-[#6B5E52] font-medium">Filter aktif:</span>
        @if(request('category'))
            <span class="inline-flex items-center gap-2 bg-[#C5A46B]/12 text-[#1C1915] px-4 py-1.5 rounded-full font-semibold border border-[#C5A46B]/20">
                {{ $categories->firstWhere('slug', request('category'))->name ?? request('category') }}
                <a href="{{ route('shop.index', array_merge(request()->except('category'))) }}#katalog" class="hover:text-rose-600 font-bold ml-1">×</a>
            </span>
        @endif
        @if(request('search'))
            <span class="inline-flex items-center gap-2 bg-[#C5A46B]/12 text-[#1C1915] px-4 py-1.5 rounded-full font-semibold border border-[#C5A46B]/20">
                "{{ request('search') }}"
                <a href="{{ route('shop.index', array_merge(request()->except('search'))) }}#katalog" class="hover:text-rose-600 font-bold ml-1">×</a>
            </span>
        @endif
        <a href="{{ route('shop.index') }}#katalog" class="text-[#C5A46B] hover:underline font-semibold">Reset</a>
    </div>
    @endif

    {{-- Products Grid --}}
    @if($products->isEmpty())
        <div class="text-center py-28 bg-white rounded-3xl border border-gray-100 reveal">
            <div class="h-20 w-20 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-6">
                <i data-lucide="search-x" class="w-9 h-9 text-gray-300"></i>
            </div>
            <h3 class="font-display text-2xl font-semibold italic text-[#1C1915]">Produk Tidak Ditemukan</h3>
            <p class="text-[#6B5E52] text-base mt-2 max-w-sm mx-auto">Coba kata kunci atau kategori lain.</p>
            <a href="{{ route('shop.index') }}#katalog" class="inline-flex items-center gap-2 mt-6 bg-[#1C1915] hover:bg-[#C5A46B] text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all btn-ring">
                <i data-lucide="refresh-ccw" class="w-4 h-4"></i> Lihat Semua Produk
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-7">
            @foreach($products as $i => $product)
                <div class="reveal card-glow bg-white rounded-3xl border border-gray-100 overflow-hidden group flex flex-col" style="transition-delay: {{ ($i % 4) * 60 }}ms">
                    {{-- Image --}}
                    <a href="{{ route('shop.show', $product->slug) }}" class="block aspect-square overflow-hidden bg-gray-50 relative">
                        <img src="{{ $product->image_url }}" alt="{{ $product->name }}"
                             class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">

                        {{-- Hover overlay --}}
                        <div class="absolute inset-0 bg-gradient-to-t from-[#1C1915]/50 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400 flex items-end p-5">
                            <span class="text-white text-sm font-semibold">Lihat Detail →</span>
                        </div>

                        @if($product->is_featured)
                            <div class="absolute top-3 left-3 bg-[#1C1915] text-[#C5A46B] text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider border border-[#C5A46B]/20">
                                Unggulan
                            </div>
                        @endif

                        @if($product->stock <= 0)
                            <div class="absolute inset-0 bg-black/40 backdrop-blur-[2px] flex items-center justify-center">
                                <span class="bg-rose-600 text-white text-sm font-bold px-5 py-2 rounded-full uppercase tracking-wider">Habis</span>
                            </div>
                        @elseif($product->stock <= 5)
                            <div class="absolute top-3 right-3 bg-amber-100 text-amber-800 text-[10px] font-bold px-3 py-1 rounded-full border border-amber-200">
                                Sisa {{ $product->stock }}
                            </div>
                        @endif
                    </a>

                    {{-- Info --}}
                    <div class="p-5 flex-grow flex flex-col justify-between gap-4">
                        <div class="space-y-1.5">
                            <span class="text-[10px] uppercase font-bold tracking-widest text-[#C5A46B]">{{ $product->category->name }}</span>
                            <h3 class="font-display text-lg font-semibold italic text-[#1C1915] line-clamp-1 group-hover:text-[#C5A46B] transition-colors leading-snug">
                                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-[#6B5E52] text-sm line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="font-display text-xl font-semibold italic text-[#1C1915]">
                                Rp {{ number_format($product->price, 0, ',', '.') }}
                            </span>
                            @if($product->stock > 0)
                                <form method="POST" action="{{ route('cart.add', $product->id) }}">
                                    @csrf
                                    <button type="submit"
                                            class="h-10 w-10 flex items-center justify-center bg-[#1C1915] hover:bg-[#C5A46B] text-white rounded-2xl transition-all duration-300 hover:scale-110 shadow-md btn-ring"
                                            title="Tambah ke Keranjang">
                                        <i data-lucide="plus" class="w-4 h-4"></i>
                                    </button>
                                </form>
                            @else
                                <button disabled class="h-10 w-10 flex items-center justify-center bg-gray-100 text-gray-400 rounded-2xl cursor-not-allowed">
                                    <i data-lucide="x" class="w-4 h-4"></i>
                                </button>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-16">
            {{ $products->links() }}
        </div>
    @endif
</section>

{{-- ══ CTA BAND ══ --}}
<section class="bg-[#1C1915] py-24 px-5 sm:px-8 relative overflow-hidden">
    <div class="blob w-80 h-80 bg-[#C5A46B] top-0 left-1/2 -translate-x-1/2" style="opacity:.12"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10 space-y-8 reveal">
        <span class="section-eyebrow block">Yuk, segera pesan!</span>
        <h2 class="font-display text-4xl sm:text-5xl font-semibold italic text-white">Siap Sempurnakan Hijab Anda?</h2>
        <p class="text-white/60 text-lg leading-relaxed max-w-xl mx-auto">Hubungi kami langsung via WhatsApp atau mulai belanja di toko online kami. Pengiriman ke seluruh Indonesia.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6282268480864" target="_blank"
               class="inline-flex items-center gap-3 bg-[#25D366] hover:bg-[#1ebe5c] text-white font-semibold px-8 py-4 rounded-2xl text-base transition-all shadow-xl hover:scale-[1.02] btn-ring">
                <i data-lucide="message-circle" class="w-5 h-5"></i>
                Chat WhatsApp
            </a>
            <a href="#katalog"
               class="inline-flex items-center gap-3 bg-[#C5A46B] hover:bg-white hover:text-[#1C1915] text-white font-semibold px-8 py-4 rounded-2xl text-base transition-all shadow-xl hover:scale-[1.02] btn-ring">
                <i data-lucide="store" class="w-5 h-5"></i>
                Lihat Katalog
            </a>
        </div>
    </div>
</section>

@endsection
