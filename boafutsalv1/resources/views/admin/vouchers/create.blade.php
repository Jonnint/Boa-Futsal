@extends('layouts.admin')

@section('title', 'Buat Voucher Baru')

@section('content')
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.vouchers.index') }}"
           class="p-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 hover:text-white transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                Buat <span class="text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-pink-400">Voucher Baru</span>
            </h1>
            <p class="text-gray-400 text-sm mt-0.5">Isi detail voucher diskon di bawah ini</p>
        </div>
    </div>

    <form action="{{ route('admin.vouchers.store') }}" method="POST" id="voucherForm">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- LEFT COLUMN: Main Info -->
            <div class="xl:col-span-2 space-y-6">

                <!-- Basic Info Card -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-purple-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        Informasi Dasar
                    </h2>

                    <div class="space-y-5">
                        <!-- Kode Voucher -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Kode Voucher <span class="text-red-400">*</span></label>
                            <div class="relative">
                                <input type="text" name="code" id="code" value="{{ old('code') }}"
                                       class="w-full bg-white/5 border {{ $errors->has('code') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white font-mono font-bold text-lg placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-white/8 transition-all uppercase"
                                       placeholder="CONTOH25" maxlength="20"
                                       oninput="this.value = this.value.toUpperCase()">
                                <div class="absolute right-3 top-1/2 -translate-y-1/2">
                                    <button type="button" onclick="generateCode()"
                                            class="text-xs px-2.5 py-1 bg-purple-500/20 text-purple-400 rounded-lg font-bold hover:bg-purple-500/30 transition-all">
                                        Generate
                                    </button>
                                </div>
                            </div>
                            @error('code')
                                <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Voucher -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Nama Voucher <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="{{ old('name') }}"
                                   class="w-full bg-white/5 border {{ $errors->has('name') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-white/8 transition-all"
                                   placeholder="Contoh: Diskon Akhir Pekan">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Deskripsi <span class="text-gray-500 font-normal">(opsional)</span></label>
                            <textarea name="description" rows="3"
                                      class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 focus:bg-white/8 transition-all resize-none"
                                      placeholder="Deskripsi singkat voucher...">{{ old('description') }}</textarea>
                        </div>
                    </div>
                </div>

                <!-- Diskon Card -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-green-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        Pengaturan Diskon
                    </h2>

                    <div class="space-y-5">
                        <!-- Tipe Diskon -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-3">Tipe Diskon <span class="text-red-400">*</span></label>
                            <div class="grid grid-cols-2 gap-3">
                                <label class="discount-type-label cursor-pointer group">
                                    <input type="radio" name="type" value="percentage" class="sr-only peer"
                                           {{ old('type', 'percentage') === 'percentage' ? 'checked' : '' }}>
                                    <div class="peer-checked:border-blue-500/50 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 border border-white/10 rounded-xl p-4 flex flex-col items-center gap-2 transition-all hover:border-white/20 text-gray-400">
                                        <span class="text-2xl font-extrabold">%</span>
                                        <span class="text-xs font-bold uppercase tracking-wider">Persentase</span>
                                        <span class="text-[10px] text-gray-500">Contoh: 20% off</span>
                                    </div>
                                </label>
                                <label class="discount-type-label cursor-pointer group">
                                    <input type="radio" name="type" value="fixed" class="sr-only peer"
                                           {{ old('type') === 'fixed' ? 'checked' : '' }}>
                                    <div class="peer-checked:border-green-500/50 peer-checked:bg-green-500/10 peer-checked:text-green-400 border border-white/10 rounded-xl p-4 flex flex-col items-center gap-2 transition-all hover:border-white/20 text-gray-400">
                                        <span class="text-2xl font-extrabold">Rp</span>
                                        <span class="text-xs font-bold uppercase tracking-wider">Nominal</span>
                                        <span class="text-[10px] text-gray-500">Contoh: Rp 25.000</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Nilai Diskon -->
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Nilai Diskon <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <span id="discountPrefix" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm pointer-events-none">%</span>
                                    <input type="number" name="discount_value" value="{{ old('discount_value') }}"
                                           class="w-full bg-white/5 border {{ $errors->has('discount_value') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-all"
                                           placeholder="0" min="0" step="0.01">
                                </div>
                                @error('discount_value')
                                    <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Max Diskon (hanya untuk persentase) -->
                            <div id="maxDiscountField">
                                <label class="block text-sm font-bold text-gray-300 mb-2">Maks. Diskon <span class="text-gray-500 font-normal">(opsional)</span></label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold pointer-events-none">Rp</span>
                                    <input type="number" name="max_discount" value="{{ old('max_discount') }}"
                                           class="w-full bg-white/5 border border-white/10 rounded-xl pl-9 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-all"
                                           placeholder="0" min="0">
                                </div>
                                <p class="mt-1 text-xs text-gray-500">Batas maksimal nominal diskon</p>
                            </div>
                        </div>

                        <!-- Min Booking Amount -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Minimum Booking <span class="text-gray-500 font-normal">(opsional)</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold pointer-events-none">Rp</span>
                                <input type="number" name="min_booking_amount" value="{{ old('min_booking_amount') }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl pl-9 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-all"
                                       placeholder="0" min="0">
                            </div>
                            <p class="mt-1 text-xs text-gray-500">Voucher hanya berlaku jika total booking ≥ nilai ini</p>
                        </div>
                    </div>
                </div>

                <!-- Periode & Batas Penggunaan -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </span>
                        Periode & Batas Penggunaan
                    </h2>

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Valid From -->
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Mulai Berlaku <span class="text-red-400">*</span></label>
                                <input type="date" name="valid_from" value="{{ old('valid_from') }}"
                                       class="w-full bg-white/5 border {{ $errors->has('valid_from') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500/50 transition-all [color-scheme:dark]">
                                @error('valid_from')
                                    <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Valid Until -->
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Berlaku Sampai <span class="text-red-400">*</span></label>
                                <input type="date" name="valid_until" value="{{ old('valid_until') }}"
                                       class="w-full bg-white/5 border {{ $errors->has('valid_until') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white focus:outline-none focus:border-purple-500/50 transition-all [color-scheme:dark]">
                                @error('valid_until')
                                    <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Usage Limit -->
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Batas Total Penggunaan <span class="text-gray-500 font-normal">(opsional)</span></label>
                                <input type="number" name="usage_limit" value="{{ old('usage_limit') }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-all"
                                       placeholder="Tidak terbatas" min="1">
                                <p class="mt-1 text-xs text-gray-500">Kosongkan untuk tanpa batas</p>
                            </div>

                            <!-- Usage Per User -->
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Maks. per Pengguna</label>
                                <input type="number" name="usage_per_user" value="{{ old('usage_per_user', 1) }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-purple-500/50 transition-all"
                                       min="1">
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- RIGHT COLUMN: Settings & Preview -->
            <div class="space-y-6">

                <!-- Settings Card -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-yellow-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path><circle cx="12" cy="12" r="3"></circle></svg>
                        </span>
                        Pengaturan
                    </h2>

                    <div class="space-y-4">
                        <!-- Member Only Toggle -->
                        <div class="flex items-start justify-between gap-4 p-4 rounded-2xl bg-white/5 border border-white/10">
                            <div>
                                <p class="text-sm font-bold text-white">Khusus Member</p>
                                <p class="text-xs text-gray-500 mt-0.5">Voucher hanya bisa digunakan oleh member aktif</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer shrink-0 mt-0.5">
                                <input type="checkbox" name="is_member_only" id="is_member_only" class="sr-only peer"
                                       {{ old('is_member_only', true) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-white/10 peer-focus:ring-2 peer-focus:ring-purple-500/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-400 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-purple-500 peer-checked:after:bg-white"></div>
                            </label>
                        </div>

                        <!-- Applicable Days -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-3">Hari Berlaku <span class="text-gray-500 font-normal">(opsional)</span></label>
                            <div class="grid grid-cols-7 gap-1.5">
                                @php
                                    $days = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
                                    $oldDays = old('applicable_days', []);
                                @endphp
                                @foreach($days as $i => $day)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="applicable_days[]" value="{{ $i }}" class="sr-only peer"
                                           {{ in_array($i, $oldDays) ? 'checked' : '' }}>
                                    <div class="peer-checked:bg-purple-500/20 peer-checked:border-purple-500/50 peer-checked:text-purple-400 text-center py-2 rounded-lg border border-white/10 text-gray-500 text-[10px] font-bold hover:border-white/20 transition-all text-xs">
                                        {{ $day }}
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            <p class="mt-1.5 text-xs text-gray-500">Kosongkan untuk semua hari</p>
                        </div>
                    </div>
                </div>

                <!-- Preview Card -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-pink-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-pink-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </span>
                        Preview Voucher
                    </h2>

                    <!-- Voucher Card Preview -->
                    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-purple-600/30 via-pink-600/20 to-purple-600/10 border border-purple-500/30 p-5">
                        <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-purple-500/10 -translate-y-8 translate-x-8"></div>
                        <div class="absolute bottom-0 left-0 w-16 h-16 rounded-full bg-pink-500/10 translate-y-6 -translate-x-6"></div>

                        <div class="relative">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <p class="text-xs font-bold text-purple-300 uppercase tracking-widest mb-1">BOA FUTSAL</p>
                                    <p id="previewName" class="text-white font-extrabold text-base leading-tight">Nama Voucher</p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-purple-500/20 border border-purple-500/30 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-purple-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                            </div>

                            <div class="mb-4">
                                <p id="previewDiscount" class="text-3xl font-extrabold text-white">-</p>
                                <p class="text-purple-300 text-xs font-bold mt-0.5">DISKON</p>
                            </div>

                            <div class="border-t border-white/10 pt-3 flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-purple-300 font-bold mb-0.5">KODE</p>
                                    <p id="previewCode" class="text-base font-extrabold text-white font-mono tracking-widest">-</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-purple-300 font-bold mb-0.5">BERLAKU S/D</p>
                                    <p id="previewUntil" class="text-xs font-extrabold text-white">-</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-400 hover:to-pink-400 text-white font-extrabold text-base rounded-2xl transition-all duration-300 shadow-lg hover:shadow-purple-500/30 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Buat Voucher
                </button>

                <a href="{{ route('admin.vouchers.index') }}"
                   class="w-full py-3.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 hover:text-white font-bold text-sm rounded-2xl transition-all duration-300 flex items-center justify-center gap-2">
                    Batal
                </a>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    // Update discount prefix icon based on type selection
    const typeInputs = document.querySelectorAll('input[name="type"]');
    const prefix = document.getElementById('discountPrefix');
    const maxDiscountField = document.getElementById('maxDiscountField');

    typeInputs.forEach(input => {
        input.addEventListener('change', function () {
            if (this.value === 'percentage') {
                prefix.textContent = '%';
                maxDiscountField.style.opacity = '1';
                maxDiscountField.style.pointerEvents = 'auto';
            } else {
                prefix.textContent = 'Rp';
                maxDiscountField.style.opacity = '0.4';
                maxDiscountField.style.pointerEvents = 'none';
            }
            updatePreview();
        });
    });

    // Real-time Preview update
    function updatePreview() {
        const code = document.querySelector('input[name="code"]').value || '-';
        const name = document.querySelector('input[name="name"]').value || 'Nama Voucher';
        const type = document.querySelector('input[name="type"]:checked')?.value || 'percentage';
        const value = document.querySelector('input[name="discount_value"]').value;
        const validUntil = document.querySelector('input[name="valid_until"]').value;

        document.getElementById('previewCode').textContent = code || '-';
        document.getElementById('previewName').textContent = name;

        if (value) {
            document.getElementById('previewDiscount').textContent = type === 'percentage'
                ? `${value}% OFF`
                : `Rp ${parseInt(value).toLocaleString('id-ID')}`;
        } else {
            document.getElementById('previewDiscount').textContent = '-';
        }

        if (validUntil) {
            const d = new Date(validUntil);
            document.getElementById('previewUntil').textContent = d.toLocaleDateString('id-ID', {day:'2-digit', month:'short', year:'numeric'});
        } else {
            document.getElementById('previewUntil').textContent = '-';
        }
    }

    document.querySelectorAll('input[name="code"], input[name="name"], input[name="discount_value"], input[name="valid_until"]').forEach(el => {
        el.addEventListener('input', updatePreview);
    });
    typeInputs.forEach(el => el.addEventListener('change', updatePreview));

    // Generate random code
    function generateCode() {
        const chars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
        let result = 'BOA';
        for (let i = 0; i < 5; i++) {
            result += chars[Math.floor(Math.random() * chars.length)];
        }
        document.querySelector('input[name="code"]').value = result;
        updatePreview();
    }

    // Init
    updatePreview();
    const checkedType = document.querySelector('input[name="type"]:checked');
    if (checkedType?.value === 'fixed') {
        prefix.textContent = 'Rp';
        maxDiscountField.style.opacity = '0.4';
        maxDiscountField.style.pointerEvents = 'none';
    }
</script>
@endpush
