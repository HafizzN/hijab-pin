<x-guest-layout>
    <div class="mb-6">
        <h2 class="text-xl font-bold text-[#2A2421] font-playfair italic">Atur Ulang Kata Sandi</h2>
        <p class="text-xs text-gray-500 mt-1">Silakan masukkan email Anda dan tentukan kata sandi baru.</p>
    </div>

    <form method="POST" action="{{ route('password.store') }}" class="space-y-4">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

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
                       value="{{ old('email', $request->email) }}" 
                       required 
                       autofocus 
                       autocomplete="username" 
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

        <!-- Password -->
        <div>
            <label for="password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Kata Sandi Baru</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i data-lucide="lock" class="w-4 h-4"></i>
                </span>
                <input id="password" 
                       type="password" 
                       name="password" 
                       required 
                       autocomplete="new-password" 
                       placeholder="Minimal 8 karakter"
                       class="block w-full pl-10 pr-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 placeholder-gray-400 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            </div>
            @if ($errors->has('password'))
                <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span>{{ $errors->first('password') }}</span>
                </p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="password_confirmation" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Konfirmasi Kata Sandi Baru</label>
            <div class="relative">
                <span class="absolute inset-y-0 left-0 pl-3.5 flex items-center pointer-events-none text-gray-400">
                    <i data-lucide="lock-keyhole" class="w-4 h-4"></i>
                </span>
                <input id="password_confirmation" 
                       type="password" 
                       name="password_confirmation" 
                       required 
                       autocomplete="new-password" 
                       placeholder="Ulangi kata sandi baru"
                       class="block w-full pl-10 pr-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 placeholder-gray-400 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            </div>
            @if ($errors->has('password_confirmation'))
                <p class="mt-1.5 text-xs text-rose-600 font-medium flex items-center gap-1">
                    <i data-lucide="alert-circle" class="w-3.5 h-3.5"></i>
                    <span>{{ $errors->first('password_confirmation') }}</span>
                </p>
            @endif
        </div>

        <!-- Submit Button -->
        <div class="pt-3">
            <button type="submit" class="w-full bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-bold uppercase tracking-wider py-3.5 px-6 rounded-xl transition-all shadow-md hover:shadow-[#C5A880]/15 flex items-center justify-center gap-2 cursor-pointer">
                <span>Atur Ulang Kata Sandi</span>
                <i data-lucide="key" class="w-4 h-4"></i>
            </button>
        </div>
    </form>
</x-guest-layout>
