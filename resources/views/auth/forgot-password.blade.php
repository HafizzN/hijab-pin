<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-xl font-bold text-[#2A2421] font-playfair italic">Lupa Kata Sandi?</h2>
        <p class="text-xs text-gray-500 mt-1">
            Masukkan alamat email Anda, dan kami akan mengirimkan link untuk mengatur ulang kata sandi Anda.
        </p>
    </div>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 bg-emerald-50 border border-emerald-100 text-emerald-800 text-xs p-3.5 rounded-xl flex items-center gap-2 font-medium">
            <i data-lucide="check-circle" class="w-4 h-4 text-emerald-500 shrink-0"></i>
            <span>{{ session('status') }}</span>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}" class="space-y-5">
        @csrf

        <!-- Email Address -->
        <div>
            <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Alamat Email</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i data-lucide="mail" class="w-4 h-4"></i>
                </span>
                <input id="email" 
                       type="email" 
                       name="email" 
                       value="{{ old('email') }}" 
                       required 
                       autofocus 
                       placeholder="nama@email.com"
                       class="block w-full pl-10 pr-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 placeholder-gray-400 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            </div>
            @if ($errors->has('email'))
                <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span>{{ $errors->first('email') }}</span>
                </p>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-2">
            <button type="submit" class="w-full bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-bold uppercase tracking-wider py-3.5 px-6 rounded-xl transition-all shadow-md hover:shadow-[#C5A880]/15 flex items-center justify-center gap-2 cursor-pointer">
                <span>Kirim Link Atur Ulang</span>
                <i data-lucide="send" class="w-4 h-4"></i>
            </button>
        </div>
    </form>

    <!-- Back to Login -->
    <div class="mt-6 pt-5 border-t border-gray-100 text-center text-xs text-gray-500">
        Kembali ke 
        <a href="{{ route('login') }}" class="font-bold text-[#C5A880] hover:text-[#2A2421] transition-colors">
            Halaman Masuk
        </a>
    </div>
</x-guest-layout>
