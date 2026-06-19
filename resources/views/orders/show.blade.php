@extends('layouts.shop')

@section('title', 'Detail Pesanan #' . $order->order_number)

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-8">
    
    <!-- Breadcrumbs -->
    <nav class="flex items-center gap-2 text-xs text-gray-500 mb-8">
        <a href="{{ route('shop.index') }}" class="hover:text-[#C5A880] transition-colors flex items-center gap-1">
            <i data-lucide="home" class="w-3.5 h-3.5"></i> Beranda
        </a>
        <i data-lucide="chevron-right" class="w-3 h-3 text-gray-300"></i>
        <a href="{{ route('orders.index') }}" class="hover:text-[#C5A880] transition-colors">Pesanan Saya</a>
        <i data-lucide="chevron-right" class="w-3 h-3 text-gray-300"></i>
        <span class="text-[#2A2421] font-semibold">Pesanan #{{ $order->order_number }}</span>
    </nav>

    <!-- Header Section -->
    <div class="flex flex-col md:flex-row md:items-center justify-between gap-6 mb-8 bg-white border border-gray-150 p-6 rounded-3xl shadow-sm">
        <div>
            <h1 class="text-2xl font-bold font-playfair italic text-[#2A2421] flex items-center gap-2">
                Detail Pesanan #{{ $order->order_number }}
            </h1>
            <p class="text-xs text-gray-500 mt-1">Dibuat pada {{ $order->created_at->format('d M Y, H:i') }} WIB</p>
        </div>

        @php
            $statusLabels = [
                'pending' => 'Menunggu Pembayaran',
                'processing' => 'Diproses',
                'shipped' => 'Dikirim',
                'completed' => 'Selesai',
                'cancelled' => 'Dibatalkan',
            ];
            $statusColors = [
                'pending' => 'bg-amber-500 text-white',
                'processing' => 'bg-blue-500 text-white',
                'shipped' => 'bg-purple-500 text-white',
                'completed' => 'bg-emerald-500 text-white',
                'cancelled' => 'bg-rose-500 text-white',
            ];
        @endphp
        <span class="px-5 py-2.5 rounded-full text-xs font-bold uppercase tracking-wider {{ $statusColors[$order->status] ?? 'bg-gray-500 text-white' }} self-start md:self-auto shadow-sm">
            {{ $statusLabels[$order->status] ?? $order->status }}
        </span>
    </div>

    <!-- Stepper Tracker -->
    @if($order->status !== 'cancelled')
        <div class="bg-white border border-gray-150 p-6 sm:p-8 rounded-3xl shadow-sm mb-10 overflow-x-auto">
            <div class="min-w-[600px] flex items-center justify-between relative">
                <!-- Line background -->
                <div class="absolute top-1/2 left-12 right-12 h-1 bg-gray-100 -translate-y-1/2 z-0"></div>
                
                <!-- Line active progress -->
                @php
                    $steps = ['pending', 'processing', 'shipped', 'completed'];
                    $currentStepIdx = array_search($order->status, $steps);
                    $lineWidth = ($currentStepIdx / 3) * 100;
                @endphp
                <div class="absolute top-1/2 left-12 right-12 h-1 bg-[#C5A880] -translate-y-1/2 z-0 transition-all duration-700" style="width: calc({{ $lineWidth }}% - 24px);"></div>

                <!-- Step 1: Placed -->
                <div class="flex flex-col items-center text-center relative z-10 w-28">
                    <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-xs shadow-md {{ $currentStepIdx >= 0 ? 'bg-[#C5A880] text-white' : 'bg-gray-100 text-gray-400' }}">
                        <i data-lucide="file-text" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-bold text-[#2A2421] mt-3">Dibuat</span>
                    <span class="text-[9px] text-gray-400 mt-0.5">{{ $order->created_at->format('d M') }}</span>
                </div>

                <!-- Step 2: Processing -->
                <div class="flex flex-col items-center text-center relative z-10 w-28">
                    <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-xs shadow-md {{ $currentStepIdx >= 1 ? 'bg-[#C5A880] text-white' : 'bg-gray-100 text-gray-400' }}">
                        <i data-lucide="loader" class="w-4 h-4 {{ $order->status === 'processing' ? 'animate-spin' : '' }}"></i>
                    </div>
                    <span class="text-xs font-bold text-[#2A2421] mt-3">Diproses</span>
                    <span class="text-[9px] text-gray-400 mt-0.5">Admin menyiapkan</span>
                </div>

                <!-- Step 3: Shipped -->
                <div class="flex flex-col items-center text-center relative z-10 w-28">
                    <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-xs shadow-md {{ $currentStepIdx >= 2 ? 'bg-[#C5A880] text-white' : 'bg-gray-100 text-gray-400' }}">
                        <i data-lucide="truck" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-bold text-[#2A2421] mt-3">Dikirim</span>
                    <span class="text-[9px] text-gray-400 mt-0.5">Sedang di kurir</span>
                </div>

                <!-- Step 4: Completed -->
                <div class="flex flex-col items-center text-center relative z-10 w-28">
                    <div class="h-10 w-10 rounded-full flex items-center justify-center font-bold text-xs shadow-md {{ $currentStepIdx >= 3 ? 'bg-[#C5A880] text-white' : 'bg-gray-100 text-gray-400' }}">
                        <i data-lucide="check" class="w-4 h-4"></i>
                    </div>
                    <span class="text-xs font-bold text-[#2A2421] mt-3">Selesai</span>
                    <span class="text-[9px] text-gray-400 mt-0.5">Pesanan diterima</span>
                </div>
            </div>
        </div>
    @endif

    <!-- Split details layout -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-10 items-start">
        
        <!-- Left Side: Items & Cost Breakdown -->
        <div class="lg:col-span-8 space-y-6">
            <!-- Items Card -->
            <div class="bg-white border border-gray-150 p-6 rounded-3xl shadow-sm space-y-4">
                <h3 class="font-bold text-base font-playfair italic text-[#2A2421] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <i data-lucide="package" class="w-5 h-5 text-[#C5A880]"></i> Rincian Produk
                </h3>

                <div class="divide-y divide-gray-100">
                    @foreach($order->items as $item)
                        <div class="flex py-4 gap-4 items-center">
                            <div class="h-16 w-16 rounded-xl overflow-hidden bg-[#FAF6F0] border border-gray-100 shrink-0">
                                <img src="{{ $item->product->image_url }}" alt="{{ $item->product->name }}" class="h-full w-full object-cover">
                            </div>
                            
                            <div class="flex-grow min-w-0">
                                <h4 class="text-xs sm:text-sm font-bold text-[#2A2421] truncate hover:text-[#C5A880] transition-colors leading-snug">
                                    <a href="{{ route('shop.show', $item->product->slug) }}">{{ $item->product->name }}</a>
                                </h4>
                                <p class="text-[10px] text-gray-500 mt-0.5">{{ $item->quantity }} Pcs x Rp {{ number_format($item->price, 0, ',', '.') }}</p>
                            </div>
                            
                            <div class="text-xs sm:text-sm font-extrabold text-[#2A2421] text-right">
                                Rp {{ number_format($item->price * $item->quantity, 0, ',', '.') }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Cost summary -->
                <div class="border-t border-gray-100 pt-4 space-y-2.5 text-xs text-right">
                    @php
                        $subtotal = $order->items->sum(function($item) {
                            return $item->price * $item->quantity;
                        });
                        $shipping = $order->total_amount - $subtotal;
                    @endphp
                    <div class="flex justify-between sm:justify-end gap-10 text-gray-500">
                        <span>Subtotal Produk:</span>
                        <span class="font-semibold text-[#2A2421]">Rp {{ number_format($subtotal, 0, ',', '.') }}</span>
                    </div>
                    <div class="flex justify-between sm:justify-end gap-10 text-gray-500">
                        <span>Ongkos Kirim:</span>
                        @if($shipping == 0)
                            <span class="text-emerald-600 font-bold">Gratis</span>
                        @else
                            <span class="font-semibold text-[#2A2421]">Rp {{ number_format($shipping, 0, ',', '.') }}</span>
                        @endif
                    </div>
                    <div class="flex justify-between sm:justify-end gap-10 text-base font-extrabold text-[#2A2421] pt-2 border-t border-gray-50">
                        <span>Total Pembayaran:</span>
                        <span class="text-[#C5A880]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                    </div>
                </div>
            </div>

            <!-- Payment Instruction box -->
            @if($order->status === 'pending' && $order->payment_method === 'Bank Transfer')
                <div class="bg-amber-50 border border-amber-200 rounded-3xl p-6 space-y-4">
                    <h4 class="font-bold text-sm text-amber-800 flex items-center gap-1.5">
                        <i data-lucide="info" class="w-5 h-5"></i> Instruksi Pembayaran Transfer Bank
                    </h4>
                    <p class="text-xs text-amber-700 leading-relaxed">
                        Silakan lakukan pembayaran secara manual ke rekening resmi **Hijab Pin House** di bawah ini:
                    </p>
                    <div class="bg-white rounded-2xl p-4 border border-amber-100 space-y-3 text-xs">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Bank:</span>
                            <span class="font-bold text-[#2A2421]">BCA (Bank Central Asia)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Nomor Rekening:</span>
                            <span class="font-mono font-bold text-base text-[#2A2421] select-all">8605 1234 56</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-gray-500">Atas Nama:</span>
                            <span class="font-bold text-[#2A2421]">HIJAB PIN HOUSE PT</span>
                        </div>
                        <div class="flex justify-between items-center pt-2 border-t border-gray-100">
                            <span class="text-gray-500">Jumlah Transfer:</span>
                            <span class="font-extrabold text-[#C5A880] text-sm">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</span>
                        </div>
                    </div>
                    <p class="text-xs text-amber-700 leading-relaxed">
                        Setelah melakukan transfer, silakan konfirmasi pembayaran Anda dengan mengirimkan bukti transfer ke Customer Service kami via Whatsapp di **+62 812-3456-7890** dengan menyertakan Nomor Pesanan **{{ $order->order_number }}**.
                    </p>
                </div>
            @endif
        </div>

        <!-- Right Side: Recipient & Courier info -->
        <div class="lg:col-span-4 space-y-6">
            <!-- Delivery Info Card -->
            <div class="bg-white border border-gray-150 p-6 rounded-3xl shadow-sm space-y-4">
                <h3 class="font-bold text-base font-playfair italic text-[#2A2421] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-5 h-5 text-[#C5A880]"></i> Informasi Pengiriman
                </h3>

                <div class="space-y-3 text-xs">
                    <div>
                        <span class="text-gray-400 block mb-0.5">Penerima:</span>
                        <span class="font-bold text-[#2A2421]">{{ $order->recipient_name }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block mb-0.5">Telepon:</span>
                        <span class="font-semibold text-[#2A2421]">{{ $order->recipient_phone }}</span>
                    </div>
                    <div>
                        <span class="text-gray-400 block mb-0.5">Alamat Lengkap:</span>
                        <p class="text-gray-600 leading-relaxed">{{ $order->shipping_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Billing Details Card -->
            <div class="bg-white border border-gray-150 p-6 rounded-3xl shadow-sm space-y-4">
                <h3 class="font-bold text-base font-playfair italic text-[#2A2421] border-b border-gray-100 pb-3 flex items-center gap-2">
                    <i data-lucide="credit-card" class="w-5 h-5 text-[#C5A880]"></i> Rincian Pembayaran
                </h3>

                <div class="space-y-3 text-xs">
                    <div class="flex justify-between">
                        <span class="text-gray-400">Metode:</span>
                        <span class="font-bold text-[#2A2421]">{{ $order->payment_method }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-gray-400">Status Pembayaran:</span>
                        @if($order->status === 'pending')
                            <span class="text-amber-600 font-bold flex items-center gap-1"><span class="h-1.5 w-1.5 bg-amber-500 rounded-full"></span> Belum Bayar</span>
                        @elseif($order->status === 'cancelled')
                            <span class="text-rose-600 font-bold">Batal</span>
                        @else
                            <span class="text-emerald-600 font-bold flex items-center gap-1"><span class="h-1.5 w-1.5 bg-emerald-500 rounded-full"></span> Lunas</span>
                        @endif
                    </div>
                    @if($order->notes)
                        <div class="pt-2 border-t border-gray-100">
                            <span class="text-gray-400 block mb-0.5">Catatan Pesanan:</span>
                            <p class="text-gray-600 italic bg-gray-50 p-2.5 rounded-lg border border-gray-100 leading-normal">{{ $order->notes }}</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Back to History Button -->
            <a href="{{ route('orders.index') }}" class="w-full h-12 flex items-center justify-center gap-2 bg-[#FAF6F0] hover:bg-[#C5A880] hover:text-white border border-[#C5A880]/30 text-[#2A2421] font-semibold text-xs rounded-full transition-colors">
                <i data-lucide="arrow-left" class="w-4 h-4"></i> Kembali Ke Riwayat Pesanan
            </a>
        </div>

    </div>
</div>
@endsection
