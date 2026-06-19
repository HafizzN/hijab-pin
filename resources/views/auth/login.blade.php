<x-guest-layout>
    <div class="mb-8 space-y-1.5">
        <h2 class="font-display text-3xl font-semibold text-[#1C1915] tracking-wide">Selamat Datang</h2>
        <p class="text-[#6B5E52] text-base">Masuk untuk melanjutkan belanja Anda.</p>
    </div>

    @if (session('status'))
        <div class="mb-6 flex items-center gap-3 bg-emerald-50 border border-emerald-100 text-emerald-700 text-sm p-4 rounded-2xl">
            <i data-lucide="check-circle" class="w-4 h-4 shrink-0 text-emerald-500"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        {{-- Email --}}
        <div class="space-y-1.5">
            <label for="email" class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]">
                Alamat Email
            </label>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
                    <i data-lucide="mail" class="w-4 h-4 text-[#6B5E52]/60"></i>
                </div>
                <input id="email" type="email" name="email" value="{{ old('email') }}"
                       required autofocus autocomplete="username"
                       placeholder="nama@email.com"
                       class="form-input pl-12">
            </div>
            @error('email')
                <p class="flex items-center gap-1.5 text-rose-600 text-xs mt-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Password --}}
        <div class="space-y-1.5">
            <div class="flex justify-between items-center">
                <label for="password" class="block text-xs font-bold uppercase tracking-widest text-[#6B5E52]">
                    Kata Sandi
                </label>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-xs font-semibold text-[#C5A46B] hover:text-[#1C1915] transition-colors">
                        Lupa Sandi?
                    </a>
                @endif
            </div>
            <div class="relative">
                <div class="pointer-events-none absolute inset-y-0 left-4 flex items-center">
                    <i data-lucide="lock" class="w-4 h-4 text-[#6B5E52]/60"></i>
                </div>
                <input id="password" type="password" name="password"
                       required autocomplete="current-password"
                       placeholder="••••••••"
                       class="form-input pl-12">
            </div>
            @error('password')
                <p class="flex items-center gap-1.5 text-rose-600 text-xs mt-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i> {{ $message }}
                </p>
            @enderror
        </div>

        {{-- Remember --}}
        <div class="flex items-center gap-3">
            <input id="remember_me" type="checkbox" name="remember"
                   class="h-4 w-4 rounded-lg border-gray-300 text-[#C5A46B] focus:ring-[#C5A46B]/30 cursor-pointer">
            <label for="remember_me" class="text-sm text-[#6B5E52] cursor-pointer select-none">Ingat saya di perangkat ini</label>
        </div>

        {{-- Submit --}}
        <button type="submit"
                class="btn-shimmer w-full bg-[#1C1915] hover:bg-[#C5A46B] text-white font-semibold py-4 rounded-2xl transition-all duration-300 shadow-lg hover:shadow-xl text-base flex items-center justify-center gap-2.5 group btn-ring">
            <span>Masuk Sekarang</span>
            <i data-lucide="arrow-right" class="w-5 h-5 transition-transform group-hover:translate-x-1"></i>
        </button>
    </form>

    <div class="mt-8 pt-7 border-t border-gray-100 text-center">
        <p class="text-sm text-[#6B5E52]">
            Belum punya akun?
            <a href="{{ route('register') }}" class="font-bold text-[#C5A46B] hover:text-[#1C1915] transition-colors ml-1">
                Daftar Gratis →
            </a>
        </p>
    </div>
</x-guest-layout>
