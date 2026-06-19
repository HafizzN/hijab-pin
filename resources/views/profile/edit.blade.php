@extends('layouts.shop')

@section('title', 'Pengaturan Profil')

@section('content')
<div class="max-w-4xl mx-auto py-12 px-4 sm:px-8">
    
    <!-- Back Button & Page Header -->
    <div class="mb-8">
        <a href="{{ route('dashboard') }}" class="inline-flex items-center gap-1.5 text-xs text-gray-400 hover:text-[#C5A880] transition-colors font-bold mb-4">
            <i data-lucide="arrow-left" class="w-3.5 h-3.5"></i> Kembali ke Dashboard
        </a>
        <h1 class="text-3xl font-bold font-playfair italic text-[#2A2421]">Pengaturan Akun</h1>
        <p class="text-xs text-gray-500 mt-1">Kelola data profil, alamat pengiriman default, dan keamanan akun Anda.</p>
    </div>

    <!-- Forms Container -->
    <div class="space-y-8">
        
        <!-- Update Profile Details -->
        <div class="p-6 sm:p-8 bg-white border border-gray-150 rounded-3xl shadow-sm">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <!-- Change Password -->
        <div class="p-6 sm:p-8 bg-white border border-gray-150 rounded-3xl shadow-sm">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <!-- Delete User Account (Optionally styled, wrapped elegantly) -->
        <div class="p-6 sm:p-8 bg-white border border-red-150 rounded-3xl shadow-sm">
            <div class="max-w-2xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>

    </div>

</div>
@endsection
