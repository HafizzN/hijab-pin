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

            <h1 class="hero-title text-4xl sm:text-5xl lg:text-6xl text-white">
                Kerapihan <br>dalam Setiap <br><span class="text-[#C5A46B]">Sentuhan.</span>
            </h1>

            <p class="text-white/65 text-base leading-relaxed max-w-lg">
                Sederhana, elegan, dan dirancang dengan penuh kepedulian untuk menjaga keindahan hijab Anda sepanjang hari.
            </p>

            <div class="flex flex-wrap gap-4">
                <a href="#katalog" class="inline-flex items-center gap-2.5 bg-[#C5A46B] hover:bg-white text-white hover:text-[#1C1915] font-semibold px-8 py-4 rounded-2xl transition-all duration-300 shadow-xl hover:shadow-2xl hover:scale-[1.02] text-base btn-ring">
                    <i data-lucide="store" class="w-5 h-5"></i>
                    Mulai Belanja
                </a>
                <a href="https://wa.me/6283821102186" target="_blank" class="inline-flex items-center gap-2.5 border-2 border-white/20 hover:border-white/50 text-white font-semibold px-8 py-4 rounded-2xl transition-all duration-300 text-base hover:bg-white/5">
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
                            <h3 class="font-display text-xl font-semibold text-white hover:text-[#C5A46B] transition-colors">
                                <a href="{{ route('shop.show', $heroProduct->slug) }}">{{ $heroProduct->name }}</a>
                            </h3>
                            <p class="text-white/55 text-sm leading-relaxed line-clamp-2">{{ $heroProduct->description }}</p>
                        </div>
                        <div class="flex items-center justify-between pt-2 border-t border-white/10">
                            <span class="font-display text-2xl font-semibold text-[#C5A46B]">Rp {{ number_format($heroProduct->price, 0, ',', '.') }}</span>
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
            <span class="section-eyebrow block mb-4">Komitmen Kami</span>
            <h2 class="section-heading">Dedikasi untuk Kenyamanan Anda</h2>
            <p class="section-subtext mt-4">Kami percaya bahwa detail kecil menentukan kenyamanan. Setiap aksesori dirancang dengan presisi untuk menjaga kerapihan hijab tanpa merusak kain.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            @foreach([
                ['shield-check','Ujung Jarum Halus','Ujung peniti dirancang halus dan presisi, membantu meminimalkan gesekan serta menjaga serat kain hijab Anda tetap rapi.','bg-amber-50'],
                ['gem','Material Pilihan','Diproduksi menggunakan bahan logam berkualitas yang tahan korosi, memberikan daya tahan optimal untuk penggunaan harian.','bg-sky-50'],
                ['heart','Presisi & Ergonomis','Bentuk yang proporsional dan ringan, memastikan pin tetap kokoh terpasang tanpa membebani atau mengganggu pergerakan.','bg-rose-50'],
            ] as $i => $f)
            <div class="reveal group p-8 rounded-3xl border border-gray-100 {{ $f[3] }} hover:shadow-xl hover:shadow-[#C5A46B]/10 transition-all duration-400 text-center space-y-5 hover:-translate-y-2" style="transition-delay: {{ $i * 80 }}ms">
                <div class="mx-auto h-16 w-16 rounded-2xl bg-[#1C1915] flex items-center justify-center group-hover:bg-[#C5A46B] transition-colors duration-300 shadow-lg">
                    <i data-lucide="{{ $f[0] }}" class="w-7 h-7 text-[#C5A46B] group-hover:text-white transition-colors"></i>
                </div>
                <h3 class="font-display text-lg font-semibold text-[#1C1915] tracking-wider">{{ $f[1] }}</h3>
                <p class="text-[#6B5E52] text-sm leading-relaxed">{{ $f[2] }}</p>
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
            <h2 class="font-display text-3xl sm:text-4xl font-semibold text-[#1C1915] flex items-center gap-3 tracking-wide">
                <i data-lucide="sparkles" class="w-6 h-6 text-[#C5A46B]"></i>
                Koleksi Pilihan
            </h2>
            <p class="section-subtext">Jelajahi kurasi pin dan bros terbaik yang dirancang untuk memperindah penampilan Anda.</p>
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
            <h3 class="font-display text-2xl font-semibold text-[#1C1915]">Produk Tidak Ditemukan</h3>
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
                            <h3 class="font-display text-lg font-semibold text-[#1C1915] line-clamp-1 group-hover:text-[#C5A46B] transition-colors leading-snug">
                                <a href="{{ route('shop.show', $product->slug) }}">{{ $product->name }}</a>
                            </h3>
                            <p class="text-[#6B5E52] text-sm line-clamp-2 leading-relaxed">{{ $product->description }}</p>
                        </div>

                        <div class="flex items-center justify-between pt-3 border-t border-gray-100">
                            <span class="font-display text-xl font-semibold text-[#1C1915]">
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

{{-- ══ TENTANG & IDENTITAS USAHA ══ --}}
<section id="tentang" class="bg-white py-28 px-5 sm:px-8 border-t border-gray-100 relative overflow-hidden">
    {{-- Decorative Background Blobs --}}
    <div class="blob w-[300px] h-[300px] bg-[#C5A46B]/5 top-10 left-10" style="opacity:.6"></div>
    <div class="blob w-[400px] h-[400px] bg-[#E8D5B0]/5 bottom-10 right-10" style="opacity:.6"></div>

    <div class="max-w-7xl mx-auto grid grid-cols-1 lg:grid-cols-12 gap-16 items-start relative z-10">
        
        <!-- Kiri: Tentang Usaha & Image Mockup (col-span-7) -->
        <div class="lg:col-span-7 space-y-10 reveal">
            <div class="space-y-4">
                <span class="section-eyebrow block">Kisah Kami</span>
                <h2 class="font-display text-3xl sm:text-4xl font-semibold text-[#1C1915] leading-tight tracking-wide">
                    Harmoni Estetika <br>dan Kualitas
                </h2>
                <div class="space-y-5 text-[#6B5E52] text-sm leading-relaxed">
                    <p>
                        Di <strong class="text-[#1C1915]">Hijab Pin House</strong>, kami believe bahwa penampilan yang rapi adalah cerminan dari rasa percaya diri Anda. Berawal dari pencarian aksesori yang aman bagi kain hijab, kami berkomitmen untuk menghadirkan pilihan pin dan bros yang anggun dengan mengutamakan kualitas material.
                    </p>
                    <p>
                        Setiap koleksi dirancang untuk menemani aktivitas harian maupun momen spesial Anda, menghadirkan sentuhan elegan yang bersahaja dalam setiap detailnya.
                    </p>
                </div>
            </div>

            <!-- Features Cards Grid -->
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                <div class="p-6 rounded-2xl bg-[#FAF6F0] border border-[#E8D5B0]/20 flex gap-4 items-start hover:shadow-md transition-all duration-300">
                    <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                        <i data-lucide="sparkles" class="w-5 h-5 text-[#C5A46B]"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-sm font-semibold text-[#1C1915] tracking-wider">Filosofi Nama</h4>
                        <p class="text-xs text-[#6B5E52] mt-1.5 leading-relaxed">Representasi dari wadah kurasi aksesori hijab terbaik yang menjadi andalan untuk penampilan yang rapi dan elegan.</p>
                    </div>
                </div>
                <div class="p-6 rounded-2xl bg-[#FAF6F0] border border-[#E8D5B0]/20 flex gap-4 items-start hover:shadow-md transition-all duration-300">
                    <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                        <i data-lucide="heart" class="w-5 h-5 text-[#C5A46B]"></i>
                    </div>
                    <div>
                        <h4 class="font-display text-sm font-semibold text-[#1C1915] tracking-wider">Visi Estetika</h4>
                        <p class="text-xs text-[#6B5E52] mt-1.5 leading-relaxed">Menghadirkan keselarasan antara keindahan visual dan kenyamanan pemakaian dalam setiap helai hijab Anda.</p>
                    </div>
                </div>
            </div>

            <!-- Showcase Image Frame -->
            <div class="relative rounded-3xl overflow-hidden shadow-2xl border border-gray-100 group">
                <div class="absolute inset-0 bg-[#1C1915]/20 group-hover:bg-transparent transition-colors duration-500 z-10"></div>
                <img src="{{ asset('images/hijab_pin_collection_showcase.png') }}" 
                     alt="Hijab Pin Collection Showcase" 
                     class="w-full h-64 object-cover transform group-hover:scale-105 transition-transform duration-700">
                <div class="absolute bottom-6 left-6 z-20 bg-white/90 backdrop-blur-md px-5 py-3 rounded-2xl border border-white/20 shadow-lg">
                    <p class="text-xs text-[#C5A46B] font-bold uppercase tracking-wider">Premium Series</p>
                    <p class="text-sm font-semibold text-[#1C1915] mt-0.5">Koleksi Bros & Pin Eksklusif</p>
                </div>
            </div>
        </div>
        
        <!-- Kanan: Identitas Usaha Card (col-span-5) -->
        <div class="lg:col-span-5 reveal">
            <div class="bg-gradient-to-br from-[#FAF6F0] to-[#F3ECE0] rounded-3xl p-8 border border-[#E8D5B0]/40 shadow-xl relative overflow-hidden">
                {{-- Decorative pattern overlay --}}
                <div class="absolute top-0 right-0 w-24 h-24 bg-[#C5A46B]/5 rounded-bl-full pointer-events-none"></div>
                
                <div class="text-center mb-8">
                    <h3 class="font-display text-3xl font-semibold text-[#1C1915]">Identitas Resmi</h3>
                    <p class="text-xs text-[#6B5E52] mt-1 tracking-widest uppercase">Hijab Pin House Profile</p>
                    <div class="h-0.5 w-16 bg-[#C5A46B]/40 mx-auto mt-4"></div>
                </div>

                <div class="space-y-4">
                    @foreach([
                        ['building-2', 'Nama Usaha', 'Hijab Pin House', null],
                        ['user', 'Nama Pengelola', 'Meri Purnama Sari', null],
                        ['award', 'Nomor Induk Berusaha (NIB)', '0406260106079', null],
                        ['phone', 'WhatsApp Resmi', '0838-2110-2186', 'https://wa.me/6283821102186'],
                        ['mail', 'Email Resmi', 'hijabpinhouse@gmail.com', 'mailto:hijabpinhouse@gmail.com'],
                        ['instagram', 'Instagram', '@hijab_pin_house', 'https://instagram.com/hijab_pin_house'],
                        ['facebook', 'Facebook', 'hijabpinhouse', 'https://facebook.com/hijabpinhouse'],
                        ['tiktok', 'TikTok', 'hijabpinhouse_', 'https://www.tiktok.com/@hijabpinhouse_'],
                        ['map-pin', 'Alamat Utama', 'Perumahan Taman Anugerah, Blok G7, Balai Gadang, Kec. Koto Tangah, Kota Padang, Sumatera Barat', null]
                    ] as $item)
                        <div class="flex gap-4 p-3 rounded-2xl hover:bg-white/50 transition-all duration-300 group/row">
                            <div class="h-10 w-10 rounded-xl bg-white shadow-sm border border-[#E8D5B0]/30 flex items-center justify-center shrink-0 group-hover/row:bg-[#C5A46B] transition-colors duration-300">
                                <?php if($item[0] === 'building-2'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><path d="M6 22V4a2 2 0 0 1 2-2h8a2 2 0 0 1 2 2v18Z"/><path d="M6 12H4a2 2 0 0 0-2 2v6a2 2 0 0 0 2 2h2Z"/><path d="M18 9h2a2 2 0 0 1 2 2v9a2 2 0 0 1-2 2h-2Z"/><path d="M10 6h4"/><path d="M10 10h4"/><path d="M10 14h4"/><path d="M10 18h4"/></svg>
                                <?php elseif($item[0] === 'user'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
                                <?php elseif($item[0] === 'award'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><circle cx="12" cy="8" r="7"/><path d="M8.21 13.89 7 23l5-3 5 3-1.21-9.12"/></svg>
                                <?php elseif($item[0] === 'phone'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/></svg>
                                <?php elseif($item[0] === 'mail'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                                <?php elseif($item[0] === 'instagram'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                                <?php elseif($item[0] === 'facebook'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                                <?php elseif($item[0] === 'tiktok'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                                <?php elseif($item[0] === 'map-pin'): ?>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"><path d="M20 10c0 6-8 12-8 12s-8-6-8-12a8 8 0 0 1 16 0Z"/><circle cx="12" cy="10" r="3"/></svg>
                                <?php else: ?>
                                    <i data-lucide="{{ $item[0] }}" class="w-4 h-4 text-[#C5A46B] group-hover/row:text-white transition-colors"></i>
                                <?php endif; ?>
                            </div>
                            <div class="flex-1 min-w-0">
                                <span class="block text-[10px] uppercase tracking-wider text-[#6B5E52] font-semibold">{{ $item[1] }}</span>
                                @if($item[3])
                                    <a href="{{ $item[3] }}" target="_blank" class="block text-sm font-bold text-[#1C1915] hover:text-[#C5A46B] transition-colors mt-0.5 truncate">{{ $item[2] }}</a>
                                @else
                                    <span class="block text-sm font-bold text-[#1C1915] mt-0.5 leading-snug">{{ $item[2] }}</span>
                                @endif
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

    </div>
</section>

{{-- ══ POLICY USAHA ══ --}}
<section id="policy" class="bg-[#FAF6F0] py-24 px-5 sm:px-8 border-t border-gray-150/30">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
            <span class="section-eyebrow block mb-4">Aturan Layanan</span>
            <h2 class="section-heading">Kenyamanan Transaksi Anda</h2>
            <p class="section-subtext mt-4">Demi menjaga kepercayaan pelanggan, kami menerapkan kebijakan layanan yang transparan dan profesional.</p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="reveal p-8 rounded-3xl border border-gray-100 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 space-y-4">
                <div class="h-12 w-12 rounded-2xl bg-[#C5A46B]/10 flex items-center justify-center">
                    <i data-lucide="clipboard-list" class="w-6 h-6 text-[#C5A46B]"></i>
                </div>
                <h3 class="font-display text-lg font-semibold text-[#1C1915] tracking-wider">Kemudahan Pemesanan</h3>
                <p class="text-[#6B5E52] text-sm leading-relaxed">
                    Pilih produk favorit Anda melalui katalog website atau pesan secara langsung via WhatsApp untuk respons cepat dari tim kami.
                </p>
            </div>
            
            <div class="reveal p-8 rounded-3xl border border-gray-100 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 space-y-4" style="transition-delay: 80ms">
                <div class="h-12 w-12 rounded-2xl bg-amber-50 flex items-center justify-center">
                    <i data-lucide="refresh-cw" class="w-6 h-6 text-amber-500"></i>
                </div>
                <h3 class="font-display text-lg font-semibold text-[#1C1915] tracking-wider">Garansi Kualitas</h3>
                <p class="text-[#6B5E52] text-sm leading-relaxed">
                    Jika produk yang Anda terima mengalami kerusakan produksi, kami menyediakan layanan retur dengan menyertakan dokumentasi video unboxing.
                </p>
            </div>

            <div class="reveal p-8 rounded-3xl border border-gray-100 bg-white shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 space-y-4" style="transition-delay: 160ms">
                <div class="h-12 w-12 rounded-2xl bg-rose-50 flex items-center justify-center">
                    <i data-lucide="heart-handshake" class="w-6 h-6 text-rose-500"></i>
                </div>
                <h3 class="font-display text-lg font-semibold text-[#1C1915] tracking-wider">Layanan Pelanggan</h3>
                <p class="text-[#6B5E52] text-sm leading-relaxed">
                    Tim admin kami siap membantu memberikan solusi ramah dan responsif terkait pertanyaan produk dan pengiriman Anda.
                </p>
            </div>
        </div>
    </div>
</section>

{{-- ══ LOKASI & KONTAK ══ --}}
<section id="kontak" class="bg-white py-24 px-5 sm:px-8 border-t border-gray-150/30">
    <div class="max-w-7xl mx-auto">
        <div class="text-center max-w-2xl mx-auto mb-16 reveal">
            <span class="section-eyebrow block mb-4">Hubungi Kami</span>
            <h2 class="section-heading">Mari Terhubung Lebih Dekat</h2>
            <p class="section-subtext mt-4">Pintu komunikasi kami selalu terbuka untuk pertanyaan, kerja sama, maupun pemesanan khusus.</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 items-stretch">
            <!-- Kiri: Kontak Usaha -->
            <div class="lg:col-span-5 reveal flex flex-col justify-between gap-6">
                <div class="bg-[#FAF6F0] rounded-3xl p-8 border border-[#E8D5B0]/30 shadow-sm space-y-5 flex-grow">
                    <h3 class="font-display text-2xl font-semibold text-[#1C1915] mb-4">Kontak Usaha</h3>
                    
                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#C5A46B]"><path d="M21 11.5a8.38 8.38 0 0 1-.9 3.8 8.5 8.5 0 0 1-7.6 4.7 8.38 8.38 0 0 1-3.8-.9L3 21l1.9-5.7a8.38 8.38 0 0 1-.9-3.8 8.5 8.5 0 0 1 4.7-7.6 8.38 8.38 0 0 1 3.8-.9h.5a8.48 8.48 0 0 1 8 8v.5z"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]/60 mb-0.5">WhatsApp</span>
                            <a href="https://wa.me/6283821102186" target="_blank" class="text-base font-semibold text-[#1C1915] hover:text-[#C5A46B] transition-colors">0838-2110-2186</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#C5A46B]"><rect width="20" height="16" x="2" y="4" rx="2"/><path d="m22 7-8.97 5.7a1.94 1.94 0 0 1-2.06 0L2 7"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]/60 mb-0.5">Email</span>
                            <a href="mailto:hijabpinhouse@gmail.com" class="text-base font-semibold text-[#1C1915] hover:text-[#C5A46B] transition-colors">hijabpinhouse@gmail.com</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#C5A46B]"><rect width="20" height="20" x="2" y="2" rx="5" ry="5"/><path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"/><line x1="17.5" x2="17.51" y1="6.5" y2="6.5"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]/60 mb-0.5">Instagram</span>
                            <a href="https://instagram.com/hijab_pin_house" target="_blank" class="text-base font-semibold text-[#1C1915] hover:text-[#C5A46B] transition-colors">@hijab_pin_house</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#C5A46B]"><path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]/60 mb-0.5">Facebook</span>
                            <a href="https://facebook.com/hijabpinhouse" target="_blank" class="text-base font-semibold text-[#1C1915] hover:text-[#C5A46B] transition-colors">hijabpinhouse</a>
                        </div>
                    </div>

                    <div class="flex items-start gap-4">
                        <div class="h-10 w-10 rounded-xl bg-[#C5A46B]/10 flex items-center justify-center shrink-0">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="w-5 h-5 text-[#C5A46B]"><path d="M9 12a4 4 0 1 0 4 4V4a5 5 0 0 0 5 5"/></svg>
                        </div>
                        <div>
                            <span class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]/60 mb-0.5">TikTok</span>
                            <a href="https://www.tiktok.com/@hijabpinhouse_" target="_blank" class="text-base font-semibold text-[#1C1915] hover:text-[#C5A46B] transition-colors">@hijabpinhouse_</a>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Kanan: Alamat Offline & Maps -->
            <div class="lg:col-span-7 reveal flex flex-col gap-6">
                <div class="bg-[#FAF6F0] rounded-3xl p-8 border border-[#E8D5B0]/30 shadow-sm flex flex-col h-full gap-6">
                    <div class="space-y-2">
                        <h3 class="font-display text-2xl font-semibold text-[#1C1915]">Alamat Offline</h3>
                        <p class="text-[#6B5E52] text-sm leading-relaxed flex items-start gap-2">
                            <i data-lucide="map-pin" class="w-4 h-4 text-[#C5A46B] mt-0.5 shrink-0"></i>
                            <span>Perumahan Taman Anugerah, Blok G7, Balai Gadang, Kec. Koto Tangah, Kota Padang, Sumatera Barat.</span>
                        </p>
                    </div>
                    
                    <!-- Embedded Google Maps -->
                    <div class="flex-grow aspect-video lg:aspect-auto min-h-[250px] rounded-2xl overflow-hidden border border-[#E8D5B0]/40 bg-white shadow-inner">
                        <iframe 
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.3789467683935!2d100.38048227496515!3d-0.850438999141443!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2fd2be0ab3317769%3A0xe5a3637f9ef82c2c!2sPerumahan%20Taman%20Anugerah!5e0!3m2!1sid!2sid!4v1718873000000!5m2!1sid!2sid" 
                            width="100%" 
                            height="100%" 
                            style="border:0;" 
                            allowfullscreen="" 
                            loading="lazy" 
                            referrerpolicy="no-referrer-when-downgrade">
                        </iframe>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

{{-- ══ CTA BAND ══ --}}
<section class="bg-[#1C1915] py-24 px-5 sm:px-8 relative overflow-hidden">
    <div class="blob w-80 h-80 bg-[#C5A46B] top-0 left-1/2 -translate-x-1/2" style="opacity:.12"></div>
    <div class="max-w-4xl mx-auto text-center relative z-10 space-y-8 reveal">
        <span class="section-eyebrow block">Koleksi Eksklusif</span>
        <h2 class="font-display text-3xl sm:text-4xl font-semibold text-white tracking-wide">Lengkapi Keanggunan Penampilan Anda</h2>
        <p class="text-white/60 text-base leading-relaxed max-w-xl mx-auto">Pilih koleksi terbaik untuk kenyamanan aktivitas Anda atau konsultasikan pemesanan langsung bersama admin kami.</p>
        <div class="flex flex-wrap justify-center gap-4">
            <a href="https://wa.me/6283821102186" target="_blank"
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
