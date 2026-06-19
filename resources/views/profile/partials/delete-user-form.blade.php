<section class="space-y-6">
    <header>
        <h2 class="text-base font-bold text-rose-700 flex items-center gap-2">
            <i data-lucide="alert-triangle" class="w-5 h-5"></i> Hapus Akun
        </h2>
        <p class="text-xs text-gray-500 mt-1">
            Setelah akun Anda dihapus, semua data dan pesanan Anda akan dihapus secara permanen. Tindakan ini tidak dapat dibatalkan.
        </p>
    </header>

    <button
        x-data=""
        x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')"
        class="bg-rose-50 hover:bg-rose-100 text-rose-700 text-xs font-bold uppercase tracking-wider py-3 px-6 rounded-xl border border-rose-200 transition-all cursor-pointer"
    >
        Hapus Akun Saya
    </button>

    <x-modal name="confirm-user-deletion" :show="$errors->userDeletion->isNotEmpty()" focusable>
        <form method="post" action="{{ route('profile.destroy') }}" class="p-6 space-y-4">
            @csrf
            @method('delete')

            <h2 class="text-lg font-bold font-playfair italic text-[#2A2421]">
                Apakah Anda yakin ingin menghapus akun Anda?
            </h2>

            <p class="text-xs text-gray-500 leading-relaxed">
                Setelah akun Anda dihapus, semua data dan pesanan Anda akan dihapus secara permanen. Silakan masukkan kata sandi Anda untuk mengonfirmasi tindakan ini.
            </p>

            <div class="mt-4">
                <label for="delete_password" class="sr-only">Kata Sandi</label>

                <input
                    id="delete_password"
                    name="password"
                    type="password"
                    placeholder="Masukkan Kata Sandi Anda"
                    class="block w-full px-4 py-3 rounded-xl border border-gray-250 bg-gray-50/50 text-xs text-gray-800 focus:border-[#C5A880] focus:bg-white focus:outline-none focus:ring-1 focus:ring-[#C5A880]/30 transition-all shadow-sm"
                />

                @if ($errors->userDeletion->has('password'))
                    <p class="mt-1 text-xs text-rose-600 font-semibold">{{ $errors->userDeletion->first('password') }}</p>
                @endif
            </div>

            <div class="mt-6 flex justify-end gap-3">
                <button 
                    type="button" 
                    x-on:click="$dispatch('close')"
                    class="bg-white hover:bg-gray-150 border border-gray-200 text-gray-700 text-xs font-bold uppercase tracking-wider py-3 px-5 rounded-xl transition-all cursor-pointer"
                >
                    Batal
                </button>

                <button 
                    type="submit" 
                    class="bg-rose-600 hover:bg-rose-700 text-white text-xs font-bold uppercase tracking-wider py-3 px-5 rounded-xl transition-all shadow-sm cursor-pointer"
                >
                    Hapus Akun
                </button>
            </div>
        </form>
    </x-modal>
</section>
