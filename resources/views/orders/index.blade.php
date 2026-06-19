@extends('layouts.shop')

@section('title', 'Riwayat Pesanan Saya')

@section('content')
<div class="max-w-7xl mx-auto py-12 px-4 sm:px-8">
    <h1 class="text-3xl font-bold font-playfair italic text-[#2A2421] mb-8 flex items-center gap-2">
        <i data-lucide="shopping-bag" class="w-7 h-7 text-[#C5A880]"></i> Riwayat Pesanan Saya
    </h1>

    @if($orders->isEmpty())
        <div class="text-center py-20 bg-white rounded-3xl border border-gray-150 shadow-sm max-w-xl mx-auto">
            <div class="p-4 bg-[#FAF6F0] rounded-full text-gray-400 w-16 h-16 flex items-center justify-center mx-auto mb-4">
                <i data-lucide="clock" class="w-8 h-8"></i>
            </div>
            <h3 class="font-bold text-xl text-[#2A2421]">Belum Ada Pesanan</h3>
            <p class="text-sm text-gray-500 mt-2 max-w-sm mx-auto">Anda belum pernah melakukan pemesanan apapun. Mulai temukan produk favorit Anda sekarang!</p>
            <a href="{{ route('shop.index') }}" class="mt-8 inline-block bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-semibold px-8 py-3.5 rounded-full transition-colors shadow-lg hover:shadow-[#C5A880]/15">
                Mulai Belanja
            </a>
        </div>
    @else
        <div class="bg-white rounded-3xl border border-gray-150 shadow-sm overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-sm">
                    <thead>
                        <tr class="bg-[#FAF6F0] border-b border-gray-150 text-xs font-bold uppercase tracking-wider text-gray-500">
                            <th class="py-4 px-6">Nomor Pesanan</th>
                            <th class="py-4 px-6">Tanggal</th>
                            <th class="py-4 px-6">Penerima</th>
                            <th class="py-4 px-6">Total Pembayaran</th>
                            <th class="py-4 px-6">Status</th>
                            <th class="py-4 px-6 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <tr class="hover:bg-[#FAF6F0]/50 transition-colors">
                                <td class="py-5 px-6 font-bold text-[#2A2421]">
                                    {{ $order->order_number }}
                                </td>
                                <td class="py-5 px-6 text-gray-500 text-xs">
                                    {{ $order->created_at->format('d M Y, H:i') }}
                                </td>
                                <td class="py-5 px-6">
                                    <div class="text-xs font-semibold text-[#2A2421]">{{ $order->recipient_name }}</div>
                                    <div class="text-[10px] text-gray-400 mt-0.5">{{ $order->recipient_phone }}</div>
                                </td>
                                <td class="py-5 px-6 font-bold text-[#C5A880]">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>
                                <td class="py-5 px-6">
                                    @php
                                        $badgeColors = [
                                            'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                            'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
                                            'shipped' => 'bg-purple-50 text-purple-700 border-purple-200',
                                            'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                            'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
                                        ];
                                        $statusLabels = [
                                            'pending' => 'Menunggu Pembayaran',
                                            'processing' => 'Diproses',
                                            'shipped' => 'Dikirim',
                                            'completed' => 'Selesai',
                                            'cancelled' => 'Dibatalkan',
                                        ];
                                    @endphp
                                    <span class="inline-flex px-3 py-1 rounded-full text-xs font-bold border {{ $badgeColors[$order->status] ?? 'bg-gray-50' }}">
                                        {{ $statusLabels[$order->status] ?? $order->status }}
                                    </span>
                                </td>
                                <td class="py-5 px-6 text-right">
                                    <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center gap-1 bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-semibold px-4 py-2 rounded-full transition-colors shadow-sm">
                                        Detail Pesanan <i data-lucide="eye" class="w-3.5 h-3.5"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            @if($orders->hasPages())
                <div class="px-6 py-4 bg-[#FAF6F0] border-t border-gray-150">
                    {{ $orders->links() }}
                </div>
            @endif
        </div>
    @endif
</div>
@endsection
