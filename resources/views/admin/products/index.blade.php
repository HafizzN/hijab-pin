@extends('layouts.admin')

@section('breadcrumbs')
<i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
<span class="text-gray-900 font-bold">Daftar Produk</span>
@endsection

@section('content')
<div class="space-y-6">
    
    <!-- Title Page Header -->
    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
        <div>
            <h1 class="text-2xl font-bold text-gray-900">Kelola Produk</h1>
            <p class="text-xs text-gray-500 mt-1">Daftar produk aksesoris hijab yang dijual di Hijab Pin House.</p>
        </div>
        <a href="{{ route('admin.products.create') }}" class="inline-flex items-center gap-2 bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-semibold px-5 py-3 rounded-full transition-colors shadow-sm self-start sm:self-auto">
            <i data-lucide="plus" class="w-4 h-4"></i> Tambah Produk Baru
        </a>
    </div>

    <!-- Products Table Card -->
    <div class="bg-white border border-gray-150 rounded-2xl shadow-sm overflow-hidden">
        @if($products->isEmpty())
            <div class="text-center py-20 text-gray-400 text-xs">
                <i data-lucide="package" class="w-12 h-12 text-gray-300 mx-auto mb-3"></i>
                Belum ada produk yang didaftarkan.
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse text-xs">
                    <thead>
                        <tr class="bg-gray-50 border-b border-gray-150 text-gray-500 uppercase tracking-wider font-semibold">
                            <th class="py-4 px-6">Produk</th>
                            <th class="py-4 px-6">Kategori</th>
                            <th class="py-4 px-6">Harga</th>
                            <th class="py-4 px-6">Stok</th>
                            <th class="py-4 px-6">Tipe</th>
                            <th class="py-4 px-6 text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100">
                        @foreach($products as $product)
                            <tr class="hover:bg-gray-50/50 transition-colors">
                                <!-- Product details -->
                                <td class="py-4 px-6 flex items-center gap-3">
                                    <img src="{{ $product->image_url }}" alt="{{ $product->name }}" class="h-12 w-12 rounded-lg object-cover bg-gray-50 border border-gray-100 shrink-0">
                                    <div class="min-w-0">
                                        <h4 class="font-bold text-gray-800 text-sm truncate leading-snug">{{ $product->name }}</h4>
                                        <p class="text-[10px] text-gray-400 mt-0.5 max-w-[200px] truncate">{{ $product->description }}</p>
                                    </div>
                                </td>

                                <!-- Category -->
                                <td class="py-4 px-6 font-semibold text-gray-700">
                                    {{ $product->category->name }}
                                </td>

                                <!-- Price -->
                                <td class="py-4 px-6 font-bold text-gray-900">
                                    Rp {{ number_format($product->price, 0, ',', '.') }}
                                </td>

                                <!-- Stock -->
                                <td class="py-4 px-6">
                                    @if($product->stock <= 0)
                                        <span class="inline-block px-2 py-0.5 rounded-md font-bold text-[9px] bg-rose-50 text-rose-700 border border-rose-200">
                                            Habis
                                        </span>
                                    @elseif($product->stock <= 5)
                                        <span class="inline-block px-2 py-0.5 rounded-md font-bold text-[9px] bg-amber-50 text-amber-700 border border-amber-200">
                                            Sisa {{ $product->stock }}
                                        </span>
                                    @else
                                        <span class="font-semibold text-gray-800">{{ $product->stock }} Pcs</span>
                                    @endif
                                </td>

                                <!-- Featured Status -->
                                <td class="py-4 px-6">
                                    @if($product->is_featured)
                                        <span class="inline-block px-2.5 py-0.5 rounded-md font-bold text-[9px] bg-[#C5A880]/15 text-[#2A2421] border border-[#C5A880]/20">
                                            Unggulan
                                        </span>
                                    @else
                                        <span class="text-gray-400 text-[10px] font-medium">-</span>
                                    @endif
                                </td>

                                <!-- Actions -->
                                <td class="py-4 px-6 text-center">
                                    <div class="flex items-center justify-center gap-2">
                                        <!-- Edit -->
                                        <a href="{{ route('admin.products.edit', $product->id) }}" class="p-2 hover:bg-gray-100 rounded-lg text-gray-500 hover:text-gray-900 transition-colors" title="Edit Produk">
                                            <i data-lucide="edit-3" class="w-4 h-4"></i>
                                        </a>

                                        <!-- Delete -->
                                        <form method="POST" action="{{ route('admin.products.destroy', $product->id) }}" onsubmit="return confirm('Apakah Anda yakin ingin menghapus produk ini?');" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="p-2 hover:bg-rose-50 rounded-lg text-rose-500 hover:text-rose-700 transition-colors" title="Hapus Produk">
                                                <i data-lucide="trash-2" class="w-4 h-4"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination footer -->
            @if($products->hasPages())
                <div class="px-6 py-4 bg-gray-50 border-t border-gray-150">
                    {{ $products->links() }}
                </div>
            @endif
        @endif
    </div>

</div>
@endsection
