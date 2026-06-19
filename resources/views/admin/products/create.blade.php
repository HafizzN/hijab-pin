@extends('layouts.admin')

@section('breadcrumbs')
<i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
<a href="{{ route('admin.products.index') }}" class="hover:text-gray-700">Daftar Produk</a>
<i data-lucide="chevron-right" class="w-3.5 h-3.5 text-gray-300"></i>
<span class="text-gray-900 font-bold">Tambah Produk</span>
@endsection

@section('content')
<div class="max-w-3xl mx-auto space-y-6">
    
    <!-- Title Page Header -->
    <div>
        <h1 class="text-2xl font-bold text-gray-900">Tambah Produk Baru</h1>
        <p class="text-xs text-gray-500 mt-1">Masukkan rincian data produk aksesoris hijab baru di bawah ini.</p>
    </div>

    <!-- Product Create Form Card -->
    <div class="bg-white border border-gray-150 rounded-2xl shadow-sm p-6 sm:p-8">
        <form method="POST" action="{{ route('admin.products.store') }}" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <!-- Name -->
                <div class="space-y-1.5 col-span-1 sm:col-span-2">
                    <label for="name" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Nama Produk</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}" required placeholder="Contoh: HP Royal Brooch"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none">
                    @error('name') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Category -->
                <div class="space-y-1.5">
                    <label for="category_id" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Kategori</label>
                    <select id="category_id" name="category_id" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none cursor-pointer">
                        <option value="">Pilih Kategori</option>
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                        @endforeach
                    </select>
                    @error('category_id') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Price -->
                <div class="space-y-1.5">
                    <label for="price" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Harga (Rp)</label>
                    <input type="number" id="price" name="price" value="{{ old('price') }}" required min="0" placeholder="Contoh: 45000"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none">
                    @error('price') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Stock -->
                <div class="space-y-1.5">
                    <label for="stock" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Jumlah Stok</label>
                    <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" required min="0" placeholder="Contoh: 25"
                           class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none">
                    @error('stock') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>

                <!-- Image Upload -->
                <div class="space-y-1.5">
                    <label for="image" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Foto Produk</label>
                    <input type="file" id="image" name="image" accept="image/*"
                           class="w-full px-4 py-2.5 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none">
                    <p class="text-[10px] text-gray-400 mt-0.5">Format: JPG, PNG, WEBP. Maksimal 2MB. Jika kosong, akan menggunakan gambar default.</p>
                    @error('image') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-1.5">
                <label for="description" class="text-xs font-bold uppercase text-gray-500 tracking-wider">Deskripsi Lengkap</label>
                <textarea id="description" name="description" rows="5" required placeholder="Tuliskan rincian bahan, ukuran, dan fitur keunggulan produk..."
                          class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:border-[#C5A880] focus:ring-0 text-sm bg-gray-50 outline-none leading-relaxed">{{ old('description') }}</textarea>
                @error('description') <span class="text-xs text-rose-600 font-semibold">{{ $message }}</span> @enderror
            </div>

            <!-- Featured Toggles -->
            <div class="flex items-center gap-2">
                <input type="checkbox" id="is_featured" name="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }}
                       class="rounded text-[#2A2421] focus:ring-0 cursor-pointer">
                <label for="is_featured" class="text-xs font-bold uppercase text-gray-500 tracking-wider cursor-pointer select-none">
                    Tampilkan sebagai Produk Unggulan (Featured)
                </label>
            </div>

            <!-- Submit CTA -->
            <div class="pt-6 border-t border-gray-100 flex items-center justify-end gap-3">
                <a href="{{ route('admin.products.index') }}" class="px-5 py-3 rounded-full border border-gray-200 text-xs font-semibold text-gray-500 hover:bg-gray-50 transition-colors">
                    Kembali
                </a>
                <button type="submit" class="bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-semibold px-6 py-3 rounded-full transition-colors shadow-sm">
                    Simpan Produk
                </button>
            </div>
        </form>
    </div>

</div>
@endsection
