@extends('layouts.shop')

@section('title', $product->name)

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-8">
    
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-gray-500 mb-8">
        <a href="{{ route('shop.index') }}" class="hover:text-[#C5A880] transition-colors flex items-center gap-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i> Beranda
        </a>
        <i data-lucide="chevron-right" class="w-3 h-3 text-gray-300"></i>
        <a href="{{ route('shop.index') }}?category={{ $product->category->slug }}" class="hover:text-[#C5A880] transition-colors">
            {{ $product->category->name }}
        </a>
        <i data-lucide="chevron-right" class="w-3 h-3 text-gray-300"></i>
        <span class="text-[#2A2421] font-semibold truncate">{{ $product->name }}</span>
    </nav>

    <!-- Product Grid detail -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-12 bg-white rounded-3xl border border-gray-150 p-6 sm:p-10 shadow-sm mb-16">
        
        <!-- Image Area -->
        <div class="lg:col-span-6 flex flex-col gap-4">
            <div class="aspect-square w-full rounded-2xl overflow-hidden border border-gray-100 bg-[#FAF6F0] relative">
                <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="w-full h-full object-cover">
                @if($product->is_featured)
                    <span class="absolute top-4 left-4 bg-[#2A2421] text-[#FAF6F0] text-xs font-bold px-3 py-1 rounded-md uppercase tracking-wider border border-[#C5A880]/20 shadow-md">
                        Pilihan Premium
                    </span>
                @endif
            </div>
        </div>

        <!-- Info Area -->
        <div class="lg:col-span-6 flex flex-col justify-between space-y-6">
            <div class="space-y-4">
                <span class="inline-block text-xs font-bold uppercase tracking-widest text-[#C5A880] bg-[#C5A880]/10 px-3.5 py-1 rounded-full">
                    {{ $product->category->name }}
                </span>
                
                <h1 class="text-3xl sm:text-4xl font-bold font-playfair italic text-[#2A2421] tracking-tight leading-tight">
                    {{ $product->name }}
                </h1>

                <!-- Price Tag -->
                <div class="flex items-center gap-4">
                    <span class="text-2xl sm:text-3xl font-extrabold text-[#2A2421]">
                        Rp {{ number_format($product->price, 0, ',', '.') }}
                    </span>
                    
                    @if($product->stock > 0)
                        <span class="px-3 py-1 bg-emerald-50 text-emerald-700 text-xs font-bold rounded-full border border-emerald-200 flex items-center gap-1.5">
                            <span class="h-2 w-2 rounded-full bg-emerald-500 animate-ping"></span> Ready Stok ({{ $product->stock }} Pcs)
                        </span>
                    @else
                        <span class="px-3 py-1 bg-rose-50 text-rose-700 text-xs font-bold rounded-full border border-rose-200">
                            Stok Habis
                        </span>
                    @endif
                </div>

                <hr class="border-gray-100">

                <div class="space-y-2">
                    <h3 class="text-xs font-bold uppercase text-[#2A2421] tracking-wider">Deskripsi Produk:</h3>
                    <p class="text-sm text-gray-600 leading-relaxed">
                        {{ $product->description }}
                    </p>
                </div>

                <!-- Product Features list -->
                <div class="bg-[#FAF6F0] rounded-2xl border border-[#C5A880]/10 p-5 space-y-3">
                    <h4 class="text-xs font-bold uppercase text-[#2A2421] tracking-wide flex items-center gap-1.5">
                        <i data-lucide="shield-check" class="w-4 h-4 text-[#C5A880]"></i> Jaminan Produk Hijab Pin House:
                    </h4>
                    <ul class="text-xs text-gray-500 space-y-2 list-disc pl-4">
                        <li>Jarum dengan teknologi <strong>snag-free</strong> (tidak merusak kain jilbab premium).</li>
                        <li>Logam paduan berkualitas tinggi dilapisi emas 14k asli/perak rhodium (tahan karat).</li>
                        <li>Desain eksklusif dan dikemas rapi dengan kotak mewah.</li>
                    </ul>
                </div>
            </div>

            <!-- Form Action -->
            <div class="pt-6 border-t border-gray-100">
                @if($product->stock > 0)
                    <form method="POST" action="{{ route('cart.add', $product->id) }}" class="flex flex-col sm:flex-row gap-4 items-stretch sm:items-center">
                        @csrf
                        
                        <!-- Quantity Box -->
                        <div class="flex items-center border border-gray-200 rounded-full overflow-hidden bg-gray-50 h-12 w-32 self-start sm:self-auto">
                            <button type="button" onclick="decrementQty()" class="px-4 py-2 hover:bg-gray-150 transition-colors text-gray-500 font-extrabold focus:outline-none">-</button>
                            <input type="number" id="qty-input" name="quantity" value="1" min="1" max="{{ $product->stock }}" class="w-full text-center bg-transparent border-0 text-xs font-semibold focus:ring-0 focus:outline-none text-[#2A2421]">
                            <button type="button" onclick="incrementQty({{ $product->stock }})" class="px-4 py-2 hover:bg-gray-150 transition-colors text-gray-500 font-extrabold focus:outline-none">+</button>
                        </div>

                        <!-- Add to Cart CTA -->
                        <button type="submit" class="flex-grow flex items-center justify-center gap-2 bg-[#2A2421] hover:bg-[#C5A880] text-white font-semibold text-sm px-8 py-3.5 rounded-full transition-colors shadow-lg hover:shadow-[#C5A880]/15 h-12">
                            <i data-lucide="shopping-cart" class="w-4.5 h-4.5"></i> Masukkan ke Keranjang
                        </button>
                    </form>
                @else
                    <button disabled class="w-full bg-gray-150 text-gray-400 font-semibold py-3.5 rounded-full cursor-not-allowed flex items-center justify-center gap-2">
                        <i data-lucide="slash" class="w-5 h-5"></i> Stok Tidak Tersedia
                    </button>
                @endif
            </div>

        </div>
    </div>

    <!-- Related Products -->
    @if(!$relatedProducts->isEmpty())
        <div class="space-y-6">
            <h2 class="text-2xl font-bold font-playfair italic text-[#2A2421] flex items-center gap-2">
                <i data-lucide="sparkles" class="w-5 h-5 text-[#C5A880]"></i> Produk Serupa Yang Anda Sukai
            </h2>
            
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-8">
                @foreach($relatedProducts as $relProduct)
                    <div class="bg-white rounded-2xl border border-gray-150 p-4 transition-all duration-300 hover:shadow-xl hover:shadow-[#C5A880]/5 hover:-translate-y-1 group flex flex-col justify-between">
                        <div>
                            <div class="aspect-square w-full rounded-xl overflow-hidden bg-gray-50 relative">
                                <img src="{{ $relProduct->image_url }}" alt="{{ $relProduct->name }}" class="w-full h-full object-cover">
                                @if($relProduct->stock <= 0)
                                    <div class="absolute inset-0 bg-black/40 flex items-center justify-center">
                                        <span class="bg-rose-600 text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase">Habis</span>
                                    </div>
                                @endif
                            </div>
                            <div class="mt-4">
                                <span class="text-[9px] uppercase font-bold text-[#C5A880]">{{ $relProduct->category->name }}</span>
                                <h3 class="font-bold text-xs text-[#2A2421] mt-1 truncate hover:text-[#C5A880] transition-colors leading-tight">
                                    <a href="{{ route('shop.show', $relProduct->slug) }}">{{ $relProduct->name }}</a>
                                </h3>
                                <p class="text-[#2A2421] font-bold text-xs mt-1">
                                    Rp {{ number_format($relProduct->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>
                        <div class="mt-4 pt-3 border-t border-gray-100 flex items-center justify-end">
                            <a href="{{ route('shop.show', $relProduct->slug) }}" class="text-xs font-semibold text-[#C5A880] hover:text-[#2A2421] transition-colors flex items-center gap-1">
                                Detail <i data-lucide="chevron-right" class="w-3.5 h-3.5"></i>
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>

<!-- Quantity script controls -->
<script>
    function incrementQty(maxStock) {
        var input = document.getElementById('qty-input');
        var val = parseInt(input.value);
        if (val < maxStock) {
            input.value = val + 1;
        }
    }

    function decrementQty() {
        var input = document.getElementById('qty-input');
        var val = parseInt(input.value);
        if (val > 1) {
            input.value = val - 1;
        }
    }
</script>
@endsection
