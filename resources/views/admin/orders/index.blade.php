@extends('layouts.admin')

@section('breadcrumbs')
<i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
<span class="text-gray-900 font-bold">Kelola Pesanan</span>
@endsection

@section('content')
<div class="space-y-6">
    
    <!-- Title Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Manajemen Pesanan</h1>
        <p class="text-xs text-gray-500 mt-1">Daftar transaksi masuk dan kelola status pengiriman pesanan pelanggan.</p>
    </div>

    <!-- Status Filter Tabs -->
    <div class="flex flex-wrap gap-2 text-xs">
        <a href="{{ route('admin.orders.index') }}" 
           class="px-4 py-2 rounded-full font-medium transition-all {{ !request('status') ? 'bg-[#2A2421] text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-650 hover:bg-gray-50' }}">
            Semua Pesanan
        </a>
        @php
            $statuses = ['pending', 'processing', 'shipped', 'completed', 'cancelled'];
            $statusLabels = [
                'pending' => 'Pending',
                'processing' => 'Diproses',
                'shipped' => 'Dikirim',
                'completed' => 'Selesai',
                'cancelled' => 'Batal',
            ];
        @endphp
        @foreach($statuses as $stat)
            <a href="{{ route('admin.orders.index') }}?status={{ $stat }}" 
               class="px-4 py-2 rounded-full font-medium transition-all {{ request('status') === $stat ? 'bg-[#2A2421] text-white shadow-sm' : 'bg-white border border-gray-200 text-gray-650 hover:bg-gray-50' }}">
                {{ $statusLabels[$stat] }}
            </a>
        @endforeach
    </div>

    <!-- Orders Table Card -->
    <div class="bg-white border border-gray-150 rounded-2xl shadow-sm overflow-hidden">
        @if($orders->isEmpty())
            <div class="text-center py-20 text-gray-400 text-xs">
                <i data-lucide="shopping-bag" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                Tidak ada pesanan dengan status ini.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-150 text-gray-500 uppercase tracking-wider font-semibold">
                            <th class="py-4 px-6">Nomor Order</th>
                            <th class="py-4 px-6">Tanggal Masuk</th>
                            <th class="py-4 px-6">Penerima & Alamat</th>
                            <th class="py-4 px-6">Total Pembayaran</th>
                            <th class="py-4 px-6">Metode</th>
                            <th class="py-4 px-6">Ubah Status</th>
                            <th class="py-4 px-6 text-center">Detail</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($orders as $order)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <!-- Order Code -->
                                <td class="py-4 px-6 font-bold text-[#2A2421]">
                                    {{ $order->order_number }}
                                </td>

                                <!-- Date -->
                                <td class="py-4 px-6 text-gray-500">
                                    {{ $order->created_at->format('d M Y, H:i') }} WIB
                                </td>

                                <!-- Recipient Details -->
                                <td class="py-4 px-6 max-w-xs">
                                    <div class="font-bold text-gray-800">{{ $order->recipient_name }}</div>
                                    <div class="text-[10px] text-gray-400 mt-0.5">{{ $order->recipient_phone }}</div>
                                    <p class="text-[10px] text-gray-500 mt-1 truncate" title="{{ $order->shipping_address }}">
                                        {{ $order->shipping_address }}
                                    </p>
                                </td>

                                <!-- Amount -->
                                <td class="py-4 px-6 font-bold text-[#C5A880]">
                                    Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                </td>

                                <!-- Payment method -->
                                <td class="py-4 px-6 font-semibold text-gray-650">
                                    {{ $order->payment_method }}
                                </td>

                                <!-- Status Dropdown changer -->
                                <td class="py-4 px-6">
                                    <form method="POST" action="{{ route('admin.orders.status', $order->id) }}" class="inline-block">
                                        @csrf
                                        <select name="status" onchange="this.form.submit()" 
                                                class="rounded-xl border border-gray-200 bg-white text-[11px] font-bold px-3 py-1.5 focus:border-[#C5A880] focus:ring-0 outline-none cursor-pointer">
                                            <option value="pending" {{ $order->status === 'pending' ? 'selected' : '' }}>Pending</option>
                                            <option value="processing" {{ $order->status === 'processing' ? 'selected' : '' }}>Diproses</option>
                                            <option value="shipped" {{ $order->status === 'shipped' ? 'selected' : '' }}>Dikirim</option>
                                            <option value="completed" {{ $order->status === 'completed' ? 'selected' : '' }}>Selesai</option>
                                            <option value="cancelled" {{ $order->status === 'cancelled' ? 'selected' : '' }}>Batal</option>
                                        </select>
                                    </form>
                                </td>

                                <!-- Detail trigger -->
                                <td class="py-4 px-6 text-center">
                                    <a href="{{ route('orders.show', $order->id) }}" class="p-2 hover:bg-gray-100 rounded-lg text-gray-500 hover:text-gray-900 inline-block transition-colors" title="Buka Detail">
                                        <i data-lucide="eye" class="w-4.5 h-4.5"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination footer -->
            @if($orders->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-150">
                    {{ $orders->links() }}
                </div>
            @endif
        @endif
    </div>

</div>
@endsection
