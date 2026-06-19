<section class="space-y-6">
    <header>
        <h2 class="text-base font-bold text-[#2A2421]">
            Perbarui Kata Sandi
        </h2>
        <p class="text-xs text-gray-500 mt-1">
            Pastikan akun Anda menggunakan kata sandi yang panjang dan acak agar tetap aman.
        </p>
    </header>

    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <!-- Current Password -->
        <div>
            <label for="update_password_current_password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Kata Sandi Sekarang</label>
            <input id="update_password_current_password" 
                   name="current_password" 
                   type="password" 
                   autocomplete="current-password" 
                   placeholder="••••••••"
                   class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            @if ($errors->updatePassword->has('current_password'))
                <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->updatePassword->first('current_password') }}</p>
            @endif
        </div>

        <!-- New Password -->
        <div>
            <label for="update_password_password" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Kata Sandi Baru</label>
            <input id="update_password_password" 
                   name="password" 
                   type="password" 
                   autocomplete="new-password" 
                   placeholder="Minimal 8 karakter"
                   class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            @if ($errors->updatePassword->has('password'))
                <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->updatePassword->first('password') }}</p>
            @endif
        </div>

        <!-- Confirm Password -->
        <div>
            <label for="update_password_password_confirmation" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Konfirmasi Kata Sandi Baru</label>
            <input id="update_password_password_confirmation" 
                   name="password_confirmation" 
                   type="password" 
                   autocomplete="new-password" 
                   placeholder="Ulangi kata sandi baru"
                   class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            @if ($errors->updatePassword->has('password_confirmation'))
                <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->updatePassword->first('password_confirmation') }}</p>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-bold uppercase tracking-wider py-3 px-6 rounded-xl transition-all shadow-sm cursor-pointer">
                Perbarui Kata Sandi
            </button>

            @if (session('status') === 'password-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 3000)"
                   class="text-xs text-emerald-600 font-bold flex items-center gap-1">
                    <i data-lucide="check" class="w-3.5 h-3.5"></i> Kata sandi berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
