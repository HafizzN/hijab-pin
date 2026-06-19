@extends('layouts.shop')

@section('title', 'Keranjang Belanja Anda')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-8">
    <h1 class="text-3xl font-bold font-serif-display text-[#2A2421] mb-8 flex items-center gap-2">
        <i data-lucide="shopping-cart" class="w-7 h-7 text-[#C5A880]"></i> Keranjang Belanja Anda
    </h1>

    @if(empty($cart))
        <!-- Empty Cart -->
        <div class="text-center py-20 bg-white rounded-3xl border border-gray-150 shadow-sm max-w-2xl mx-auto">
            <div class="p-4 bg-[#FAF6F0] rounded-full text-[#C5A880] w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="shopping-bag" class="w-8 h-8"></i>
            </div>
            <h3 class="font-bold text-xl text-[#2A2421]">Keranjang Anda Masih Kosong</h3>
            <p class="text-sm text-gray-500 mt-2 max-w-sm mx-auto">Anda belum menambahkan item ke keranjang. Jelajahi produk-produk premium kami sekarang.</p>
            <a href="{{ route('shop.index') }}" class="mt-8 inline-block bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-semibold px-8 py-3.5 rounded-full transition-colors shadow-lg hover:shadow-[#C5A880]/15">
                Jelajahi Produk
            </a>
        </div>
    @else
        <!-- Cart Grid -->
        <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
            
            <!-- Items Column -->
            <div class="lg:col-span-8 space-y-4">
                <div class="bg-white rounded-3xl border border-gray-150 p-6 shadow-sm overflow-hidden">
                    <div class="flow-root">
                        <ul class="-my-6 divide-y divide-gray-100">
                            @php $subtotal = 0; @endphp
                            @foreach($cart as $id => $item)
                                @php $subtotal += $item['price'] * $item['quantity']; @endphp
                                <li class="flex py-6 gap-4 sm:gap-6">
                                    <!-- Image -->
                                    <div class="h-24 w-24 flex-shrink-0 overflow-hidden rounded-2xl border border-gray-100 bg-[#FAF6F0]">
                                        <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                                    </div>

                                    <!-- Details -->
                                    <div class="flex flex-1 flex-col justify-between">
                                        <div class="flex flex-col sm:flex-row sm:justify-between gap-2">
                                            <div>
                                                <h3 class="font-bold text-sm sm:text-base font-display text-[#2A2421] hover:text-[#C5A880] transition-colors leading-tight">
                                                    <a href="{{ route('shop.show', $item['slug']) }}">{{ $item['name'] }}</a>
                                                </h3>
                                                <p class="text-xs font-semibold font-display text-[#C5A880] mt-1">Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                                            </div>
                                            
                                            <!-- Total per item -->
                                            <p class="text-sm font-bold font-display text-[#2A2421] self-start sm:self-auto sm:text-right">
                                                Subtotal: <span class="text-[#C5A880] font-display">Rp {{ number_format($item['price'] * $item['quantity'], 0, ',', '.') }}</span>
                                            </p>
                                        </div>

                                        <div class="flex items-center justify-between mt-4">
                                            <!-- Quantity form -->
                                            <form method="POST" action="{{ route('cart.update', $id) }}" class="flex items-center border border-gray-200 rounded-lg overflow-hidden bg-gray-50">
                                                @csrf
                                                <button type="submit" name="quantity" value="{{ $item['quantity'] - 1 }}" class="px-2.5 py-1 hover:bg-gray-100 transition-colors text-gray-500 font-extrabold text-sm">-</button>
                                                <span class="px-4 py-1 text-xs font-bold text-gray-700">{{ $item['quantity'] }}</span>
                                                <button type="submit" name="quantity" value="{{ $item['quantity'] + 1 }}" class="px-2.5 py-1 hover:bg-gray-100 transition-colors text-gray-500 font-extrabold text-sm">+</button>
                                            </form>

                                            <!-- Remove form -->
                                            <form method="POST" action="{{ route('cart.remove', $id) }}">
                                                @csrf
                                                <button type="submit" class="text-rose-500 hover:text-rose-700 text-xs font-semibold flex items-center gap-1 transition-colors">
                                                    <i data-lucide="trash-2" class="w-3.5 h-3.5"></i> Hapus
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>

            <!-- Summary Column -->
            <div class="lg:col-span-4 bg-white rounded-3xl border border-gray-150 p-6 shadow-sm space-y-6">
                <h3 class="font-bold text-lg font-serif-display text-[#2A2421]">Ringkasan Belanja</h3>
                
                <div class="space-y-3 text-xs">
                    <div class="flex justify-between text-gray-500">
                        <span>Subtotal Item</span>
                        <span class="font-bold text-[#2A2421]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    
                    @php
                        $shipping = $subtotal >= 150000 ? 0 : 15000;
                    @endphp
                    <div class="flex justify-between text-gray-500">
                        <span>Biaya Pengiriman</span>
                        @if($shipping == 0)
                            <span class="text-emerald-600 font-bold">Gratis</span>
                        @else
                            <span class="font-bold text-[#2A2421]">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    
                    @if($shipping > 0)
                        <div class="p-3 bg-amber-50 rounded-xl text-amber-700 text-[10px] leading-normal border border-amber-200">
                            Tambah belanja Rp {{ number_format(150000 - $subtotal, 0, ',', '.') }} lagi untuk menikmati **Gratis Ongkir**!
                        </div>
                    @endif

                    <hr class="my-2 border-gray-100">

                    <div class="flex justify-between text-base font-extrabold text-[#2A2421] pt-2">
                        <span>Total Pembayaran</span>
                        <span class="text-[#C5A880]">Rp {{ number_format($subtotal + $shipping, 0, ',', '.') }}</span>
                    </div>
                </div>

                <div class="pt-4">
                    <a href="{{ route('checkout.index') }}" class="w-full h-12 flex items-center justify-center gap-2 bg-[#2A2421] hover:bg-[#C5A880] text-white font-semibold text-sm rounded-full transition-colors shadow-lg hover:shadow-[#C5A880]/15">
                        Lanjut ke Checkout <i data-lucide="arrow-right" class="w-4 h-4"></i>
                    </a>
                    <a href="{{ route('shop.index') }}" class="w-full mt-3 block text-center text-xs font-semibold text-gray-400 hover:text-[#C5A880] transition-colors py-2">
                        &larr; Lanjutkan Belanja
                    </a>
                </div>
            </div>

        </div>
    @endif
</div>
@endsection
