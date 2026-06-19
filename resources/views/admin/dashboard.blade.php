@extends('layouts.admin')

@section('breadcrumbs')
<i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
<span class="text-gray-900 font-bold">Ringkasan</span>
@endsection

@section('content')
<div class="space-y-8">
    
    <!-- Title Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Dashboard Ringkasan</h1>
        <p class="text-xs text-gray-500 mt-1">Pantau performa penjualan dan stok inventaris toko Hijab Pin House Anda.</p>
    </div>

    <!-- Metrics Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
        
        <!-- Revenue Card -->
        <div class="bg-white rounded-2xl border border-gray-150 p-6 shadow-sm flex items-center gap-5">
            <div class="p-4 bg-emerald-50 text-emerald-600 rounded-xl">
                <i data-lucide="wallet" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Total Pendapatan</p>
                <p class="text-xl font-bold text-gray-900 mt-1">Rp {{ number_format($totalRevenue, 0, ',', '.') }}</p>
            </div>
        </div>

        <!-- Orders Card -->
        <div class="bg-white rounded-2xl border border-gray-150 p-6 shadow-sm flex items-center gap-5">
            <div class="p-4 bg-blue-50 text-blue-600 rounded-xl">
                <i data-lucide="shopping-bag" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Total Pesanan</p>
                <p class="text-xl font-bold text-gray-900 mt-1">{{ $ordersCount }} Pesanan</p>
            </div>
        </div>

        <!-- Customers Card -->
        <div class="bg-white rounded-2xl border border-gray-150 p-6 shadow-sm flex items-center gap-5">
            <div class="p-4 bg-purple-50 text-purple-600 rounded-xl">
                <i data-lucide="users" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Total Pelanggan</p>
                <p class="text-xl font-bold text-gray-900 mt-1">{{ $customersCount }} Akun</p>
            </div>
        </div>

        <!-- Low Stock Card -->
        <div class="bg-white rounded-2xl border border-gray-150 p-6 shadow-sm flex items-center gap-5">
            <div class="p-4 bg-rose-50 text-rose-600 rounded-xl">
                <i data-lucide="alert-triangle" class="w-6 h-6"></i>
            </div>
            <div>
                <p class="text-xs text-gray-400 font-medium">Stok Rendah / Habis</p>
                <p class="text-xl font-bold text-gray-900 mt-1">{{ $lowStockProducts->count() }} Produk</p>
            </div>
        </div>

    </div>

    <!-- Recent Orders & Inventory Status split -->
    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        
        <!-- Left Side: Recent Orders Table -->
        <div class="lg:col-span-8 bg-white border border-gray-150 rounded-2xl shadow-sm overflow-hidden flex flex-col justify-between">
            <div>
                <div class="px-6 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h3 class="font-bold text-sm text-gray-900 flex items-center gap-2">
                        <i data-lucide="clock" class="w-4 h-4 text-[#C5A880]"></i> Pesanan Terbaru
                    </h3>
                    <a href="{{ route('admin.orders.index') }}" class="text-xs font-bold text-[#C5A880] hover:text-[#2A2421] transition-colors">
                        Lihat Semua Pesanan &rarr;
                    </a>
                </div>

                @if($recentOrders->isEmpty())
                    <div class="text-center py-10 text-gray-500 text-xs">
                        Belum ada pesanan masuk.
                    </div>
                @else
                    <div class="overflow-x-auto">
                        <table class="w-full text-left border-collapse text-xs">
                            <thead>
                                <tr class="bg-gray-50 border-b border-gray-150 text-gray-500 uppercase tracking-wider font-semibold">
                                    <th class="py-3 px-6">Nomor Order</th>
                                    <th class="py-3 px-6">Pelanggan</th>
                                    <th class="py-3 px-6">Total</th>
                                    <th class="py-3 px-6">Status</th>
                                    <th class="py-3 px-6 text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100">
                                @foreach($recentOrders as $order)
                                    <tr class="hover:bg-gray-50/50">
                                        <td class="py-4 px-6 font-bold text-[#2A2421]">
                                            {{ $order->order_number }}
                                        </td>
                                        <td class="py-4 px-6">
                                            <p class="font-semibold text-gray-800">{{ $order->recipient_name }}</p>
                                            <p class="text-[10px] text-gray-400 mt-0.5">{{ $order->created_at->format('d/m/Y H:i') }}</p>
                                        </td>
                                        <td class="py-4 px-6 font-bold text-[#C5A880]">
                                            Rp {{ number_format($order->total_amount, 0, ',', '.') }}
                                        </td>
                                        <td class="py-4 px-6">
                                            @php
                                                $badges = [
                                                    'pending' => 'bg-amber-50 text-amber-700 border-amber-200',
                                                    'processing' => 'bg-blue-50 text-blue-700 border-blue-200',
                                                    'shipped' => 'bg-purple-50 text-purple-700 border-purple-200',
                                                    'completed' => 'bg-emerald-50 text-emerald-700 border-emerald-200',
                                                    'cancelled' => 'bg-rose-50 text-rose-700 border-rose-200',
                                                ];
                                            @endphp
                                            <span class="px-2 py-0.5 rounded-full font-bold border {{ $badges[$order->status] ?? 'bg-gray-50' }}">
                                                {{ $order->status }}
                                            </span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <a href="{{ route('admin.orders.index') }}?status={{ $order->status }}" class="text-[#C5A880] hover:underline font-semibold">
                                                Kelola
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif
            </div>
        </div>

        <!-- Right Side: Low Stock Products alert list -->
        <div class="lg:col-span-4 bg-white border border-gray-150 rounded-2xl shadow-sm overflow-hidden flex flex-col">
            <div class="px-6 py-5 border-b border-gray-100">
                <h3 class="font-bold text-sm text-gray-900 flex items-center gap-2">
                    <i data-lucide="alert-triangle" class="w-4 h-4 text-rose-500"></i> Peringatan Stok Rendah
                </h3>
            </div>

            <div class="flex-grow p-4 overflow-y-auto max-h-[300px]">
                @if($lowStockProducts->isEmpty())
                    <div class="flex flex-col items-center justify-center py-12 text-center text-gray-400 text-xs">
                        <i data-lucide="smile" class="w-8 h-8 text-[#C5A880] mb-2"></i>
                        Semua stok produk mencukupi!
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($lowStockProducts as $prod)
                            <div class="flex items-center gap-3 justify-between p-2.5 rounded-xl hover:bg-gray-50 transition-all border border-gray-100">
                                <div class="flex items-center gap-3 min-w-0">
                                    <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="h-10 w-10 rounded-lg object-cover bg-gray-50 border border-gray-100 shrink-0">
                                    <div class="min-w-0">
                                        <h4 class="text-xs font-bold text-gray-800 truncate leading-snug">{{ $prod->name }}</h4>
                                        <p class="text-[10px] text-gray-400 mt-0.5">{{ $prod->category->name }}</p>
                                    </div>
                                </div>
                                
                                <div class="text-right shrink-0">
                                    <span class="inline-block px-2.5 py-0.5 rounded-md font-bold text-[10px] border {{ $prod->stock == 0 ? 'bg-rose-50 text-rose-700 border-rose-200' : 'bg-amber-50 text-amber-700 border-amber-200' }}">
                                        {{ $prod->stock == 0 ? 'Habis' : 'Sisa ' . $prod->stock }}
                                    </span>
                                    <a href="{{ route('admin.products.edit', $prod->id) }}" class="block text-[10px] text-[#C5A880] hover:underline font-semibold mt-1">
                                        Edit Stok
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>

    </div>

</div>
@endsection
