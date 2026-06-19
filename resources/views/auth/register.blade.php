<x-guest-layout>
    <div class="mb-8 space-y-1.5">
        <h2 class="font-display text-3xl font-semibold text-[#1C1915] tracking-wide">Daftar Akun Baru</h2>
        <p class="text-[#6B5E52] text-base">Daftar gratis dan mulai berbelanja koleksi eksklusif kami.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        {{-- Name --}}
        <div class="space-y-1.5">
            <label for="name" class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]">Nama Lengkap</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
                    <i data-lucide="user" class="w-4 h-4 text-[#6B5E52]/60"></i>
                </div>
                <input id="name" type="text" name="name" value="{{ old('name') }}"
                       required autofocus autocomplete="name"
                       placeholder="Nama lengkap Anda"
                       class="form-input pl-12">
            </div>
            @error('name')
                <p class="flex items-center gap-1.5 text-rose-600 text-xs mt-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
            @enderror
        </div>

        {{-- Email --}}
        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]">Alamat Email</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 text-[#6B5E52]/60"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       required autocomplete="username"
                       placeholder="nama@email.com"
                       class="form-input pl-12">
            </div>
            @error('email')
                <p class="flex items-center gap-1.5 text-rose-600 text-xs mt-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="space-y-1.5">
            <label for="password" class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]">Kata Sandi</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
                    <i data-lucide="lock" class="w-4 h-4 text-[#6B5E52]/60"></i>
                </div>
                <input id="password" type="password" name="password"
                       required autocomplete="new-password"
                       placeholder="Minimal 8 karakter"
                       class="form-input pl-12">
            </div>
            @error('password')
                <p class="flex items-center gap-1.5 text-rose-600 text-xs mt-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
            @enderror
        </div>

        {{-- Confirm Password --}}
        <div class="space-y-1.5">
            <label for="password_confirmation" class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]">Konfirmasi Kata Sandi</label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
                    <i data-lucide="lock-keyhole" class="w-4 h-4 text-[#6B5E52]/60"></i>
                </div>
                <input id="password_confirmation" type="password" name="password_confirmation"
                       required autocomplete="new-password"
                       placeholder="Ulangi kata sandi"
                       class="form-input pl-12">
            </div>
            @error('password_confirmation')
                <p class="flex items-center gap-1.5 text-rose-600 text-xs mt-1"><i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}</p>
            @enderror
        </div>

        {{-- Terms --}}
        <p class="text-xs text-[#6B5E52] leading-relaxed">
            Dengan mendaftar, Anda menyetujui
            <a href="#" class="text-[#C5A46B] hover:underline font-medium">Syarat & Ketentuan</a>
            serta
            <a href="#" class="text-[#C5A46B] hover:underline font-medium">Kebijakan Privasi</a>
            kami.
        </p>

        {{-- Submit --}}
        <button type="submit"
                class="btn-shimmer w-full bg-[#1C1915] hover:bg-[#C5A46B] text-white font-semibold py-4 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl text-base flex items-center justify-center gap-2.5 group btn-ring mt-2">
            <span>Daftar Sekarang</span>
            <i data-lucide="user-plus" class="w-5 h-5 transition-transform group-hover:scale-110"></i>
        </button>
    </form>

    <div class="mt-7 pt-6 border-t border-gray-100 text-center">
        <p class="text-sm text-[#6B5E52]">
            Sudah punya akun?
            <a href="{{ route('login') }}" class="font-bold text-[#C5A46B] hover:text-[#1C1915] transition-colors ml-1">
                Masuk Disini →
            </a>
        </p>
    </div>
</x-guest-layout>
