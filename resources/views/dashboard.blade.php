@extends('layouts.shop')

@section('title', 'Dashboard Saya')

@section('content')
@php
    $hour = (int) date('H');
    if ($hour >= 5 && $hour < 11) $greeting = 'Pagi';
    elseif ($hour >= 11 && $hour < 15) $greeting = 'Siang';
    elseif ($hour >= 15 && $hour < 18) $greeting = 'Sore';
    else $greeting = 'Malam';
@endphp

<div class="bg-[#FAF6F0] min-h-screen py-10 px-4 sm:px-8">
<div class="max-w-7xl mx-auto space-y-10">

{{-- ══ Welcome Banner ══ --}}
<div class="relative overflow-hidden rounded-3xl min-h-[240px] flex items-center bg-[#1C1915] reveal">
    <div class="absolute top-0 right-0 w-72 h-72 rounded-full bg-[#C5A46B] opacity-10 blur-3xl"></div>
    <div class="absolute -bottom-20 -left-10 w-64 h-64 rounded-full bg-[#E8D5B0] opacity-8 blur-3xl"></div>
    <div class="absolute top-6 right-24 h-3 w-3 rounded-full border-2 border-[#C5A46B]/40"></div>
    <div class="absolute top-12 right-36 h-2 w-2 rounded-full bg-[#C5A46B]/25"></div>
    <div class="absolute bottom-8 right-16 h-4 w-4 rounded-full border border-[#C5A46B]/20"></div>

    <div class="relative z-10 w-full px-8 sm:px-12 py-10 flex flex-col sm:flex-row items-start sm:items-center justify-between gap-8">
        <div class="flex items-center gap-6">
            <div class="relative shrink-0">
                <div class="h-20 w-20 rounded-2xl bg-gradient-to-br from-[#C5A46B] to-amber-300 text-[#1C1915] font-display text-3xl font-bold flex items-center justify-center shadow-xl">
                    {{ strtoupper(substr($user->name, 0, 1)) }}
                </div>
                <div class="absolute -bottom-1.5 -right-1.5 h-6 w-6 bg-emerald-400 rounded-full border-2 border-[#1C1915] flex items-center justify-center">
                    <i data-lucide="check" class="w-3 h-3 text-white"></i>
                </div>
            </div>
            <div class="space-y-2">
                <div class="inline-flex items-center gap-2 px-3 py-1 rounded-full bg-[#C5A46B]/15 border border-[#C5A46B]/25 text-[#C5A46B] text-xs font-semibold tracking-widest uppercase">
                    <span class="h-1.5 w-1.5 rounded-full bg-[#C5A46B] animate-pulse"></span>
                    Selamat {{ $greeting }}
                </div>
                <h1 class="font-display text-3xl sm:text-4xl font-semibold italic text-white leading-none">
                    {{ $user->name }}
                </h1>
                <p class="text-white/50 text-base max-w-sm leading-relaxed">
                    Selamat datang kembali di <strong class="text-white/80">Hijab Pin House</strong>.
                </p>
            </div>
        </div>

        <div class="flex flex-col sm:flex-row gap-3 shrink-0">
            <a href="{{ route('shop.index') }}"
               class="inline-flex items-center gap-2.5 bg-[#C5A46B] hover:bg-white hover:text-[#1C1915] text-white font-semibold px-7 py-3.5 rounded-2xl transition-all duration-300 shadow-lg text-sm btn-ring whitespace-nowrap">
                <i data-lucide="store" class="w-4 h-4"></i>
                Mulai Belanja
            </a>
            <a href="{{ route('orders.index') }}"
               class="inline-flex items-center gap-2.5 bg-white/10 hover:bg-white/20 border border-white/20 text-white font-semibold px-7 py-3.5 rounded-2xl transition-all text-sm whitespace-nowrap">
                <i data-lucide="package" class="w-4 h-4"></i>
                Pesanan Saya
            </a>
        </div>
    </div>
</div>

{{-- ══ Stats Cards ══ --}}
<div class="grid grid-cols-1 sm:grid-cols-3 gap-6 reveal">

    <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-start justify-between mb-5">
            <div class="h-14 w-14 rounded-2xl bg-[#C5A46B]/12 flex items-center justify-center group-hover:bg-[#C5A46B] transition-colors duration-300">
                <i data-lucide="shopping-bag" class="w-6 h-6 text-[#C5A46B] group-hover:text-white transition-colors"></i>
            </div>
            <span class="text-[#C5A46B] text-xs font-bold uppercase tracking-widest">Total</span>
        </div>
        <div class="font-display text-4xl font-semibold italic text-[#1C1915]">{{ $totalOrders }}</div>
        <div class="text-[#6B5E52] text-sm font-medium mt-1">Total Pesanan</div>
        <div class="mt-4 h-1 rounded-full bg-gradient-to-r from-[#C5A46B] to-amber-200 w-3/4 group-hover:w-full transition-all duration-500"></div>
    </div>

    <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-start justify-between mb-5">
            <div class="h-14 w-14 rounded-2xl bg-amber-50 flex items-center justify-center group-hover:bg-amber-500 transition-colors duration-300">
                <i data-lucide="clock" class="w-6 h-6 text-amber-500 group-hover:text-white transition-colors"></i>
            </div>
            <span class="text-amber-500 text-xs font-bold uppercase tracking-widest">Aktif</span>
        </div>
        <div class="font-display text-4xl font-semibold italic text-[#1C1915]">{{ $activeOrders }}</div>
        <div class="text-[#6B5E52] text-sm font-medium mt-1">Sedang Diproses</div>
        <div class="mt-4 h-1 rounded-full bg-gradient-to-r from-amber-400 to-orange-200 w-1/2 group-hover:w-full transition-all duration-500"></div>
    </div>

    <div class="bg-white rounded-3xl p-7 border border-gray-100 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group">
        <div class="flex items-start justify-between mb-5">
            <div class="h-14 w-14 rounded-2xl bg-emerald-50 flex items-center justify-center group-hover:bg-emerald-500 transition-colors duration-300">
                <i data-lucide="wallet" class="w-6 h-6 text-emerald-500 group-hover:text-white transition-colors"></i>
            </div>
            <span class="text-emerald-600 text-xs font-bold uppercase tracking-widest">Pengeluaran</span>
        </div>
        <div class="font-display text-3xl font-semibold italic text-[#1C1915]">Rp {{ number_format($totalSpent, 0, ',', '.') }}</div>
        <div class="text-[#6B5E52] text-sm font-medium mt-1">Total Belanja</div>
        <div class="mt-4 h-1 rounded-full bg-gradient-to-r from-emerald-400 to-teal-200 w-2/3 group-hover:w-full transition-all duration-500"></div>
    </div>
</div>

{{-- ══ Orders + Account Info ══ --}}
<div class="grid grid-cols-1 lg:grid-cols-12 gap-8 reveal">

    <div class="lg:col-span-8 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden">
        <div class="px-8 py-6 border-b border-gray-100 flex items-center justify-between bg-[#FAF6F0]/60">
            <h3 class="font-display text-xl font-semibold italic text-[#1C1915] flex items-center gap-3">
                <i data-lucide="history" class="w-5 h-5 text-[#C5A46B]"></i>
                Pesanan Terakhir
            </h3>
            @if(!$recentOrders->isEmpty())
            <a href="{{ route('orders.index') }}" class="text-sm font-semibold text-[#C5A46B] hover:text-[#1C1915] transition-colors flex items-center gap-1">
                Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
            </a>
            @endif
        </div>

        @if($recentOrders->isEmpty())
            <div class="text-center py-24 px-8">
                <div class="h-20 w-20 rounded-full bg-gray-50 flex items-center justify-center mx-auto mb-6">
                    <i data-lucide="shopping-cart" class="w-9 h-9 text-gray-200"></i>
                </div>
                <h4 class="font-display text-xl font-semibold italic text-[#1C1915]">Belum Ada Pesanan</h4>
                <p class="text-[#6B5E52] text-base mt-2 max-w-xs mx-auto leading-relaxed">Temukan koleksi aksesoris premium dan mulai berbelanja hari ini!</p>
                <a href="{{ route('shop.index') }}" class="inline-flex items-center gap-2 mt-6 bg-[#1C1915] hover:bg-[#C5A46B] text-white px-6 py-3 rounded-xl font-semibold text-sm transition-all btn-ring">
                    <i data-lucide="store" class="w-4 h-4"></i> Belanja Sekarang
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-100 text-[#6B5E52] text-xs uppercase tracking-widest font-semibold">
                            <th class="py-4 px-7">No. Order</th>
                            <th class="py-4 px-7">Tanggal</th>
                            <th class="py-4 px-7">Status</th>
                            <th class="py-4 px-7">Total</th>
                            <th class="py-4 px-7 text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-50">
                        @foreach($recentOrders as $order)
                            @php
                                $statusCfg = [
                                    'pending'    => ['bg-amber-50 text-amber-700 border-amber-200','Menunggu'],
                                    'processing' => ['bg-blue-50 text-blue-700 border-blue-200','Diproses'],
                                    'shipped'    => ['bg-purple-50 text-purple-700 border-purple-200','Dikirim'],
                                    'completed'  => ['bg-emerald-50 text-emerald-700 border-emerald-200','Selesai'],
                                    'cancelled'  => ['bg-rose-50 text-rose-700 border-rose-200','Dibatalkan'],
                                ];
                                $cfg = $statusCfg[$order->status] ?? ['bg-gray-50 text-gray-600 border-gray-200', $order->status];
                            @endphp
                            <tr class="hover:bg-[#FAF6F0] transition-colors">
                                <td class="py-5 px-7 font-bold text-sm text-[#1C1915]">{{ $order->order_number }}</td>
                                <td class="py-5 px-7 text-sm text-[#6B5E52]">{{ $order->created_at->format('d/m/Y') }}</td>
                                <td class="py-5 px-7">
                                    <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $cfg[0] }}">{{ $cfg[1] }}</span>
                                </td>
                                <td class="py-5 px-7 font-display text-base font-semibold italic text-[#C5A46B]">Rp {{ number_format($order->total_amount, 0, ',', '.') }}</td>
                                <td class="py-5 px-7 text-right">
                                    <a href="{{ route('orders.show', $order->id) }}" class="inline-flex items-center gap-1.5 text-sm font-semibold text-[#C5A46B] hover:text-[#1C1915] transition-colors">
                                        Detail <i data-lucide="chevron-right" class="w-4 h-4"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <div class="lg:col-span-4 bg-white rounded-3xl border border-gray-100 shadow-sm overflow-hidden flex flex-col">
        <div class="px-7 py-6 border-b border-gray-100 bg-[#FAF6F0]/60 flex items-center gap-3">
            <i data-lucide="user-circle-2" class="w-5 h-5 text-[#C5A46B]"></i>
            <h3 class="font-display text-xl font-semibold italic text-[#1C1915]">Profil Saya</h3>
        </div>

        <div class="p-7 space-y-6 flex-grow">
            @foreach([
                ['Nama Lengkap', $user->name, 'user'],
                ['Email', $user->email, 'mail'],
                ['No. HP', $user->phone ?? null, 'phone'],
            ] as $f)
            <div>
                <span class="block text-[10px] font-bold uppercase tracking-widest text-[#6B5E52]/60 mb-1.5">{{ $f[0] }}</span>
                <div class="flex items-center gap-2.5">
                    <i data-lucide="{{ $f[2] }}" class="w-4 h-4 text-[#C5A46B] shrink-0"></i>
                    @if($f[1])
                        <span class="text-sm font-medium text-[#1C1915]">{{ $f[1] }}</span>
                    @else
                        <span class="text-sm italic text-gray-400">Belum ditambahkan</span>
                    @endif
                </div>
            </div>
            @endforeach

            <div>
                <span class="block text-[10px] font-bold uppercase tracking-widest text-[#6B5E52]/60 mb-2">Alamat Kirim</span>
                @if($user->address)
                    <div class="bg-[#FAF6F0] border border-gray-100 rounded-2xl p-4 flex items-start gap-3">
                        <i data-lucide="map-pin" class="w-4 h-4 text-[#C5A46B] mt-0.5 shrink-0"></i>
                        <p class="text-sm text-[#6B5E52] leading-relaxed">{{ $user->address }}</p>
                    </div>
                @else
                    <div class="bg-amber-50 border border-amber-100 rounded-2xl p-4 flex items-center gap-3 text-amber-700 text-sm">
                        <i data-lucide="alert-circle" class="w-4 h-4 shrink-0"></i>
                        Alamat belum diisi. Lengkapi profil Anda.
                    </div>
                @endif
            </div>
        </div>

        <div class="p-7 pt-0">
            <a href="{{ route('profile.edit') }}"
               class="flex items-center justify-center gap-2.5 w-full bg-[#1C1915] hover:bg-[#C5A46B] text-white font-semibold py-3.5 px-5 rounded-2xl transition-all duration-300 text-sm btn-ring">
                <i data-lucide="edit-3" class="w-4 h-4"></i>
                Edit Profil & Alamat
            </a>
        </div>
    </div>
</div>

{{-- ══ Featured Products ══ --}}
<div class="bg-white rounded-3xl border border-gray-100 shadow-sm p-8 reveal">
    <div class="flex flex-col sm:flex-row justify-between items-start sm:items-center gap-4 mb-8">
        <div class="space-y-1.5">
            <span class="section-eyebrow block">Pilihan Terbaik</span>
            <h3 class="font-display text-2xl font-semibold italic text-[#1C1915] flex items-center gap-3">
                <i data-lucide="sparkles" class="w-6 h-6 text-[#C5A46B]"></i>
                Rekomendasi Eksklusif
            </h3>
        </div>
        <a href="{{ route('shop.index') }}" class="text-sm font-semibold text-[#C5A46B] hover:text-[#1C1915] transition-colors flex items-center gap-1 shrink-0">
            Lihat Semua <i data-lucide="arrow-right" class="w-4 h-4"></i>
        </a>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-3 gap-6">
        @foreach($featuredProducts as $i => $prod)
            <div class="group border border-gray-100 rounded-2xl overflow-hidden hover:shadow-xl hover:-translate-y-1.5 transition-all duration-300 bg-[#FAF6F0]/40 flex flex-col" style="transition-delay: {{ $i * 80 }}ms">
                <div class="relative overflow-hidden aspect-[4/3] bg-gray-50">
                    <img src="{{ $prod->image_url }}" alt="{{ $prod->name }}" class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110">
                    <div class="absolute inset-0 bg-gradient-to-t from-[#1C1915]/40 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-400"></div>
                    <div class="absolute top-3 left-3 bg-[#1C1915]/75 backdrop-blur-sm text-white text-[10px] font-bold px-3 py-1 rounded-full uppercase tracking-wider">
                        {{ $prod->category->name }}
                    </div>
                </div>
                <div class="p-5 flex flex-col gap-3 flex-grow">
                    <div class="space-y-1 flex-grow">
                        <h4 class="font-display text-lg font-semibold italic text-[#1C1915] group-hover:text-[#C5A46B] transition-colors line-clamp-1">{{ $prod->name }}</h4>
                        <p class="text-sm text-[#6B5E52] line-clamp-2 leading-relaxed">{{ $prod->description }}</p>
                    </div>
                    <div class="flex justify-between items-center pt-3 border-t border-gray-100 mt-auto">
                        <span class="font-display text-xl font-semibold italic text-[#1C1915]">Rp {{ number_format($prod->price, 0, ',', '.') }}</span>
                        <a href="{{ route('shop.show', $prod->slug) }}"
                           class="h-10 w-10 flex items-center justify-center rounded-2xl bg-[#1C1915] hover:bg-[#C5A46B] text-white transition-all duration-300 hover:scale-110 shadow-md">
                            <i data-lucide="eye" class="w-4 h-4"></i>
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

</div>
</div>
@endsection
