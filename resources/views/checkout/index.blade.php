@extends('layouts.shop')

@section('title', 'Proses Checkout')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-8">
    <h1 class="text-3xl font-bold font-playfair italic text-[#2A2421] mb-8 flex items-center gap-2">
        <i data-lucide="credit-card" class="w-7 h-7 text-[#C5A880]"></i> Form Pembayaran / Checkout
    </h1>

    <form method="POST" action="{{ route('checkout.store') }}" class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        @csrf
        
        <!-- Shipping Details Form Column -->
        <div class="lg:col-span-8 bg-white rounded-3xl border border-gray-150 p-6 sm:p-8 shadow-sm space-y-6">
            <h3 class="font-bold text-lg font-playfair italic text-[#2A2421] border-b border-gray-100 pb-3">
                Informasi Pengiriman
            </h3>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Recipient Name -->
                <div class="space-y-1.5">
                    <label for="recipient_name" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Nama Penerima</label>
                    <input type="text" id="recipient_name" name="recipient_name" 
                           value="{{ old('recipient_name', auth()->user()->name) }}" required
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none">
                    @error('recipient_name') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Recipient Phone -->
                <div class="space-y-1.5">
                    <label for="recipient_phone" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Nomor HP / Whatsapp</label>
                    <input type="text" id="recipient_phone" name="recipient_phone" 
                           value="{{ old('recipient_phone', auth()->user()->phone) }}" required placeholder="Contoh: 081234567890"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none">
                    @error('recipient_phone') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Shipping Address -->
            <div class="space-y-1.5">
                <label for="shipping_address" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Alamat Lengkap Pengiriman</label>
                <textarea id="shipping_address" name="shipping_address" rows="4" required placeholder="Tuliskan jalan, nomor rumah, RT/RW, kecamatan, kota, dan kode pos..."
                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none leading-relaxed">{{ old('shipping_address', auth()->user()->address) }}</textarea>
                @error('shipping_address') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <!-- Payment Method Selection -->
            <div class="space-y-1.5">
                <label class="text-xs font-bold uppercase text-gray-500 tracking-wider">Metode Pembayaran</label>
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <!-- COD option -->
                    <label class="border-2 border-gray-200 rounded-xl p-4 flex items-center gap-3 cursor-pointer hover:border-[#C5A880]/50 transition-colors select-none">
                        <input type="radio" name="payment_method" value="COD" checked class="text-[#2A2421] focus:ring-0">
                        <div class="text-left">
                            <p class="font-bold text-xs text-[#2A2421] flex items-center gap-1.5">
                                <i data-lucide="wallet" class="w-4 h-4 text-[#C5A880]"></i> Cash on Delivery (COD)
                            </p>
                            <p class="text-[10px] text-gray-500 mt-0.5">Bayar tunai di tempat saat barang tiba.</p>
                        </div>
                    </label>

                    <!-- Bank Transfer option -->
                    <label class="border-2 border-gray-200 rounded-xl p-4 flex items-center gap-3 cursor-pointer hover:border-[#C5A880]/50 transition-colors select-none">
                        <input type="radio" name="payment_method" value="Bank Transfer" class="text-[#2A2421] focus:ring-0">
                        <div class="text-left">
                            <p class="font-bold text-xs text-[#2A2421] flex items-center gap-1.5">
                                <i data-lucide="landmark" class="w-4 h-4 text-[#C5A880]"></i> Transfer Bank (Manual)
                            </p>
                            <p class="text-[10px] text-gray-500 mt-0.5">Kirim bukti transfer ke admin setelah checkout.</p>
                        </div>
                    </label>
                </div>
                @error('payment_method') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <!-- Notes -->
            <div class="space-y-1.5">
                <label for="notes" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Catatan Tambahan (Opsional)</label>
                <textarea id="notes" name="notes" rows="2" placeholder="Catatan warna cadangan, patokan alamat, dll..."
                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none leading-relaxed">{{ old('notes') }}</textarea>
                @error('notes') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
            </div>
        </div>

        <!-- Summary & Confirm Column -->
        <div class="lg:col-span-4 bg-white rounded-3xl border border-gray-150 p-6 shadow-sm space-y-6">
            <h3 class="font-bold text-lg font-playfair italic text-[#2A2421]">Detail Pesanan</h3>
            
            <div class="divide-y divide-gray-100 max-h-60 overflow-y-auto pr-1">
                @php $subtotal = 0; @endphp
                @foreach($cart as $id => $item)
                    @php $subtotal += $item['price'] * $item['quantity']; @endphp
                    <div class="flex py-3 gap-3">
                        <div class="h-12 w-12 rounded-lg overflow-hidden border border-gray-100 bg-[#FAF6F0] shrink-0">
                            <img src="{{ $item['image_url'] }}" alt="{{ $item['name'] }}" class="h-full w-full object-cover">
                        </div>
                        <div class="flex-1 min-w-0">
                            <h4 class="text-xs font-semibold text-[#2A2421] truncate leading-tight">{{ $item['name'] }}</h4>
                            <p class="text-[10px] text-gray-500 mt-0.5">{{ $item['quantity'] }} x Rp {{ number_format($item['price'], 0, ',', '.') }}</p>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="border-t border-gray-100 pt-4 space-y-3 text-xs">
                <div class="flex justify-between text-gray-500">
                    <span>Subtotal Produk</span>
                    <span class="font-bold text-[#2A2421]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                </div>
                
                @php
                    $shipping = $subtotal >= 150000 ? 0 : 15000;
                @endphp
                <div class="flex justify-between text-gray-500">
                    <span>Ongkos Kirim</span>
                    @if($shipping == 0)
                        <span class="text-emerald-600 font-bold">Gratis</span>
                    @else
                        <span class="font-bold text-[#2A2421]">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                    @endif
                </div>

                <hr class="border-gray-100 my-1">

                <div class="flex justify-between text-base font-extrabold text-[#2A2421] pt-2">
                    <span>Total Tagihan</span>
                    <span class="text-[#C5A880]">Rp {{ number_format($subtotal + $shipping, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="pt-4 border-t border-gray-100">
                <button type="submit" class="w-full h-12 flex items-center justify-center gap-2 bg-[#2A2421] hover:bg-[#C5A880] text-white font-semibold text-sm rounded-full transition-colors shadow-lg hover:shadow-[#C5A880]/15">
                    <i data-lucide="check-square" class="w-4.5 h-4.5"></i> Konfirmasi & Buat Pesanan
                </button>
                <p class="text-[10px] text-center text-gray-400 mt-3 leading-normal">
                    Dengan membuat pesanan, Anda menyetujui syarat layanan dan ketentuan pengiriman dari toko kami.
                </p>
            </div>
        </div>

    </form>
</div>
@endsection
