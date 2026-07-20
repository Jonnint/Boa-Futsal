@extends('layouts.admin')

@section('title', 'Kirim Notifikasi Baru')

@section('content')
<div class="mb-6 md:mb-8 flex items-center gap-4">
    <a href="{{ route('admin.notifications.index') }}" class="p-2 bg-white/5 hover:bg-white/10 border border-white/10 rounded-xl transition-colors">
        <svg class="w-6 h-6 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
    </a>
    <div>
        <h1 class="text-3xl font-extrabold text-white tracking-tight">Kirim Notifikasi Baru</h1>
        <p class="text-gray-400 text-sm mt-1">Buat pemberitahuan baru untuk member.</p>
    </div>
</div>

<div class="bg-white/5 border border-white/10 rounded-[1.5rem] overflow-hidden max-w-4xl">
    <form action="{{ route('admin.notifications.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
        @csrf

        <!-- Penerima -->
        <div>
            <label class="block text-sm font-bold text-gray-300 mb-2">Tujuan Pengiriman <span class="text-red-500">*</span></label>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                <label class="relative flex cursor-pointer rounded-xl border border-white/10 bg-black/40 p-4 shadow-sm focus:outline-none hover:border-green-500/50 has-[:checked]:border-green-500 has-[:checked]:bg-green-500/10 transition-all">
                    <input type="radio" name="broadcast_type" value="all" class="sr-only" checked onchange="toggleUserSelect(this.value)">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-purple-500/20 text-purple-400 flex items-center justify-center border border-purple-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-white">Semua Member</p>
                            <p class="text-xs text-gray-400">Kirim ke seluruh member aktif</p>
                        </div>
                    </div>
                </label>
                <label class="relative flex cursor-pointer rounded-xl border border-white/10 bg-black/40 p-4 shadow-sm focus:outline-none hover:border-blue-500/50 has-[:checked]:border-blue-500 has-[:checked]:bg-blue-500/10 transition-all">
                    <input type="radio" name="broadcast_type" value="specific" class="sr-only" onchange="toggleUserSelect(this.value)">
                    <div class="flex items-center gap-3">
                        <div class="w-10 h-10 rounded-lg bg-blue-500/20 text-blue-400 flex items-center justify-center border border-blue-500/30">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path></svg>
                        </div>
                        <div>
                            <p class="font-bold text-white">Member Spesifik</p>
                            <p class="text-xs text-gray-400">Pilih satu member penerima</p>
                        </div>
                    </div>
                </label>
            </div>
            @error('broadcast_type')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div id="userSelectWrapper" class="hidden">
            <label for="user_id" class="block text-sm font-bold text-gray-300 mb-2">Pilih Member <span class="text-red-500">*</span></label>
            <select name="user_id" id="user_id" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-all">
                <option value="">-- Pilih Member --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id_user }}" {{ old('user_id') == $user->id_user ? 'selected' : '' }}>
                        {{ $user->name }} ({{ $user->email }})
                    </option>
                @endforeach
            </select>
            @error('user_id')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Tipe Notifikasi -->
            <div>
                <label for="type" class="block text-sm font-bold text-gray-300 mb-2">Tipe Notifikasi <span class="text-red-500">*</span></label>
                <select name="type" id="type" required class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-all">
                    <option value="info" {{ old('type') == 'info' ? 'selected' : '' }}>Informasi Umum</option>
                    <option value="promo" {{ old('type') == 'promo' ? 'selected' : '' }}>Promo & Diskon</option>
                    <option value="warning" {{ old('type') == 'warning' ? 'selected' : '' }}>Peringatan</option>
                </select>
                @error('type')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
            
            <!-- Terkait Voucher -->
            <div>
                <label for="voucher_id" class="block text-sm font-bold text-gray-300 mb-2">Terkait Voucher (Opsional)</label>
                <select name="voucher_id" id="voucher_id" class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-all">
                    <option value="">-- Tidak Terkait Voucher --</option>
                    @foreach($vouchers as $voucher)
                        <option value="{{ $voucher->id }}" {{ old('voucher_id') == $voucher->id ? 'selected' : '' }}>
                            {{ $voucher->name }} ({{ $voucher->code }})
                        </option>
                    @endforeach
                </select>
                @error('voucher_id')
                    <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
                @enderror
            </div>
        </div>

        <!-- Judul -->
        <div>
            <label for="title" class="block text-sm font-bold text-gray-300 mb-2">Judul Notifikasi <span class="text-red-500">*</span></label>
            <input type="text" name="title" id="title" value="{{ old('title') }}" required placeholder="Contoh: Promo Spesial Akhir Pekan!"
                class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-all">
            @error('title')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Pesan -->
        <div>
            <label for="message" class="block text-sm font-bold text-gray-300 mb-2">Isi Pesan <span class="text-red-500">*</span></label>
            <textarea name="message" id="message" rows="4" required placeholder="Tuliskan pesan lengkap untuk member..."
                class="w-full bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-all resize-y">{{ old('message') }}</textarea>
            @error('message')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Masa Berlaku -->
        <div>
            <label for="expires_at" class="block text-sm font-bold text-gray-300 mb-2">Batas Waktu Tampil (Opsional)</label>
            <input type="datetime-local" name="expires_at" id="expires_at" value="{{ old('expires_at') }}"
                class="w-full md:w-1/2 bg-black/50 border border-white/10 rounded-xl px-4 py-3 text-white focus:outline-none focus:border-green-500 focus:ring-1 focus:ring-green-500 transition-all"
                style="color-scheme: dark;">
            <p class="mt-2 text-xs text-gray-500">Kosongkan jika notifikasi berlaku selamanya (hingga dihapus otomatis).</p>
            @error('expires_at')
                <p class="mt-2 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit -->
        <div class="pt-4 border-t border-white/10">
            <button type="submit" class="w-full md:w-auto px-8 py-3 bg-green-500 hover:bg-green-400 text-black font-extrabold rounded-xl transition-all shadow-[0_0_20px_rgba(74,222,128,0.3)] hover:shadow-[0_0_30px_rgba(74,222,128,0.5)] flex items-center justify-center gap-2">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path></svg>
                Kirim Notifikasi
            </button>
        </div>
    </form>
</div>
@endsection

@push('scripts')
<script>
    function toggleUserSelect(val) {
        const wrapper = document.getElementById('userSelectWrapper');
        if (val === 'specific') {
            wrapper.classList.remove('hidden');
        } else {
            wrapper.classList.add('hidden');
        }
    }

    // Initialize state on load
    document.addEventListener('DOMContentLoaded', () => {
        const checked = document.querySelector('input[name="broadcast_type"]:checked');
        if (checked) {
            toggleUserSelect(checked.value);
        }
    });
</script>
@endpush
