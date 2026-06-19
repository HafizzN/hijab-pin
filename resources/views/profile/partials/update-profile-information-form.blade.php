<section class="space-y-6">
    <header>
        <h2 class="text-base font-bold text-[#2A2421]">
            Informasi Profil & Alamat
        </h2>
        <p class="text-xs text-gray-500 mt-1">
            Ubah nama, email, nomor telepon, dan alamat pengiriman default yang akan otomatis digunakan saat checkout.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <!-- Name -->
        <div>
            <label for="name" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Nama Lengkap</label>
            <input id="name" 
                   name="name" 
                   type="text" 
                   value="{{ old('name', $user->name) }}" 
                   required 
                   autofocus 
                   autocomplete="name" 
                   class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            @if ($errors->has('name'))
                <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->first('name') }}</p>
            @endif
        </div>

        <!-- Email -->
        <div>
            <label for="email" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Alamat Email</label>
            <input id="email" 
                   name="email" 
                   type="email" 
                   value="{{ old('email', $user->email) }}" 
                   required 
                   autocomplete="username" 
                   class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            @if ($errors->has('email'))
                <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->first('email') }}</p>
            @endif

            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && ! $user->hasVerifiedEmail())
                <div class="mt-2 text-xs text-amber-800">
                    <span>Email Anda belum diverifikasi.</span>
                    <button form="send-verification" class="underline text-gray-600 hover:text-gray-900 focus:outline-none">
                        Klik di sini untuk mengirim ulang verifikasi email.
                    </button>
                    @if (session('status') === 'verification-link-sent')
                        <p class="mt-1 text-xs font-semibold text-emerald-600">
                            Link verifikasi baru telah dikirim ke email Anda.
                        </p>
                    @endif
                </div>
            @endif
        </div>

        <!-- Phone -->
        <div>
            <label for="phone" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Nomor Telepon</label>
            <input id="phone" 
                   name="phone" 
                   type="text" 
                   value="{{ old('phone', $user->phone) }}" 
                   placeholder="Contoh: 08123456789"
                   class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">
            @if ($errors->has('phone'))
                <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->first('phone') }}</p>
            @endif
        </div>

        <!-- Address -->
        <div>
            <label for="address" class="block text-[10px] font-bold uppercase tracking-widest text-gray-400 mb-1.5">Alamat Pengiriman Default</label>
            <textarea id="address" 
                      name="address" 
                      rows="3" 
                      placeholder="Masukkan alamat pengiriman lengkap Anda..."
                      class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm">{{ old('address', $user->address) }}</textarea>
            @if ($errors->has('address'))
                <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->first('address') }}</p>
            @endif
        </div>

        <!-- Actions -->
        <div class="flex items-center gap-4 pt-2">
            <button type="submit" class="bg-[#2A2421] hover:bg-[#C5A880] text-white text-xs font-bold uppercase tracking-wider py-3 px-6 rounded-xl transition-all shadow-sm cursor-pointer">
                Simpan Perubahan
            </button>

            @if (session('status') === 'profile-updated')
                <p x-data="{ show: true }"
                   x-show="show"
                   x-transition
                   x-init="setTimeout(() => show = false, 3000)"
                   class="text-xs text-emerald-600 font-bold flex items-center gap-1">
                    <i data-lucide="check" class="w-3.5 h-3.5"></i> Profil berhasil diperbarui.
                </p>
            @endif
        </div>
    </form>
</section>
