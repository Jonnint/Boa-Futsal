@extends('layouts.admin')

@section('title', 'Edit Voucher - ' . $voucher->code)

@section('content')
    <!-- Header -->
    <div class="flex items-center gap-4 mb-8">
        <a href="{{ route('admin.vouchers.index') }}"
           class="p-2.5 rounded-xl bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 hover:text-white transition-all">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
        </a>
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                Edit <span class="text-transparent bg-clip-text bg-gradient-to-r from-blue-400 to-cyan-400">Voucher</span>
            </h1>
            <div class="flex items-center gap-2 mt-0.5">
                <span class="font-mono font-bold text-sm text-gray-300">{{ $voucher->code }}</span>
                @if($voucher->is_active)
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-green-500/10 border border-green-500/20 text-green-400 rounded-full text-[10px] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span> Aktif
                    </span>
                @else
                    <span class="inline-flex items-center gap-1 px-2 py-0.5 bg-gray-500/10 border border-gray-500/20 text-gray-400 rounded-full text-[10px] font-bold">
                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span> Nonaktif
                    </span>
                @endif
            </div>
        </div>

        <!-- Quick toggle right side -->
        <div class="ml-auto">
            <form action="{{ route('admin.vouchers.toggle', $voucher) }}" method="POST">
                @csrf
                <button type="submit"
                        class="{{ $voucher->is_active ? 'bg-yellow-500/10 border-yellow-500/20 text-yellow-400 hover:bg-yellow-500/20' : 'bg-green-500/10 border-green-500/20 text-green-400 hover:bg-green-500/20' }} px-4 py-2.5 border rounded-xl font-bold text-sm transition-all flex items-center gap-2">
                    @if($voucher->is_active)
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                        Nonaktifkan
                    @else
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        Aktifkan
                    @endif
                </button>
            </form>
        </div>
    </div>

    <!-- Validation Errors -->
    @if($errors->any())
        <div class="mb-6 p-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 text-sm">
            <p class="font-bold mb-2 flex items-center gap-2">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                Terdapat kesalahan input:
            </p>
            <ul class="list-disc list-inside space-y-1">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- Usage Stats Banner -->
    @if($voucher->usages_count > 0)
    <div class="mb-6 p-4 rounded-2xl bg-blue-500/10 border border-blue-500/20 flex items-center gap-3 text-sm">
        <svg class="w-5 h-5 text-blue-400 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="text-blue-300">
            Voucher ini telah digunakan <strong>{{ $voucher->usages_count }} kali</strong>.
            Perubahan pada diskon & tipe akan mempengaruhi kalkulasi yang baru saja dibuat.
        </span>
    </div>
    @endif

    <form action="{{ route('admin.vouchers.update', $voucher) }}" method="POST" id="voucherForm">
        @csrf
        @method('PUT')

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- LEFT COLUMN: Main Info -->
            <div class="xl:col-span-2 space-y-6">

                <!-- Basic Info Card -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-blue-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                        </span>
                        Informasi Dasar
                    </h2>

                    <div class="space-y-5">
                        <!-- Kode Voucher -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Kode Voucher <span class="text-red-400">*</span></label>
                            <input type="text" name="code" value="{{ old('code', $voucher->code) }}"
                                   class="w-full bg-white/5 border {{ $errors->has('code') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white font-mono font-bold text-lg placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/8 transition-all uppercase"
                                   maxlength="20" oninput="this.value = this.value.toUpperCase()">
                            @error('code')
                                <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Nama Voucher -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Nama Voucher <span class="text-red-400">*</span></label>
                            <input type="text" name="name" value="{{ old('name', $voucher->name) }}"
                                   class="w-full bg-white/5 border {{ $errors->has('name') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/8 transition-all">
                            @error('name')
                                <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Deskripsi -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Deskripsi <span class="text-gray-500 font-normal">(opsional)</span></label>
                            <textarea name="description" rows="3"
                                      class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 focus:bg-white/8 transition-all resize-none">{{ old('description', $voucher->description) }}</textarea>
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
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="percentage" class="sr-only peer"
                                           {{ old('type', $voucher->type) === 'percentage' ? 'checked' : '' }}>
                                    <div class="peer-checked:border-blue-500/50 peer-checked:bg-blue-500/10 peer-checked:text-blue-400 border border-white/10 rounded-xl p-4 flex flex-col items-center gap-2 transition-all hover:border-white/20 text-gray-400">
                                        <span class="text-2xl font-extrabold">%</span>
                                        <span class="text-xs font-bold uppercase tracking-wider">Persentase</span>
                                    </div>
                                </label>
                                <label class="cursor-pointer">
                                    <input type="radio" name="type" value="fixed" class="sr-only peer"
                                           {{ old('type', $voucher->type) === 'fixed' ? 'checked' : '' }}>
                                    <div class="peer-checked:border-green-500/50 peer-checked:bg-green-500/10 peer-checked:text-green-400 border border-white/10 rounded-xl p-4 flex flex-col items-center gap-2 transition-all hover:border-white/20 text-gray-400">
                                        <span class="text-2xl font-extrabold">Rp</span>
                                        <span class="text-xs font-bold uppercase tracking-wider">Nominal</span>
                                    </div>
                                </label>
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <!-- Nilai Diskon -->
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Nilai Diskon <span class="text-red-400">*</span></label>
                                <div class="relative">
                                    <span id="discountPrefix" class="absolute left-4 top-1/2 -translate-y-1/2 text-gray-400 font-bold text-sm pointer-events-none">{{ $voucher->type === 'percentage' ? '%' : 'Rp' }}</span>
                                    <input type="number" name="discount_value" value="{{ old('discount_value', $voucher->discount_value) }}"
                                           class="w-full bg-white/5 border {{ $errors->has('discount_value') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl pl-8 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-all"
                                           placeholder="0" min="0" step="0.01">
                                </div>
                                @error('discount_value')
                                    <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>

                            <!-- Max Diskon -->
                            <div id="maxDiscountField" style="{{ old('type', $voucher->type) === 'fixed' ? 'opacity:0.4; pointer-events:none;' : '' }}">
                                <label class="block text-sm font-bold text-gray-300 mb-2">Maks. Diskon <span class="text-gray-500 font-normal">(opsional)</span></label>
                                <div class="relative">
                                    <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold pointer-events-none">Rp</span>
                                    <input type="number" name="max_discount" value="{{ old('max_discount', $voucher->max_discount) }}"
                                           class="w-full bg-white/5 border border-white/10 rounded-xl pl-9 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-all"
                                           placeholder="0" min="0">
                                </div>
                            </div>
                        </div>

                        <!-- Min Booking Amount -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">Minimum Booking <span class="text-gray-500 font-normal">(opsional)</span></label>
                            <div class="relative">
                                <span class="absolute left-3 top-1/2 -translate-y-1/2 text-gray-400 text-xs font-bold pointer-events-none">Rp</span>
                                <input type="number" name="min_booking_amount" value="{{ old('min_booking_amount', $voucher->min_booking_amount) }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl pl-9 pr-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-all"
                                       placeholder="0" min="0">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Periode & Batas -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-cyan-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        </span>
                        Periode & Batas Penggunaan
                    </h2>

                    <div class="space-y-5">
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Mulai Berlaku <span class="text-red-400">*</span></label>
                                <input type="date" name="valid_from" value="{{ old('valid_from', $voucher->valid_from->format('Y-m-d')) }}"
                                       class="w-full bg-white/5 border {{ $errors->has('valid_from') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500/50 transition-all [color-scheme:dark]">
                                @error('valid_from')
                                    <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Berlaku Sampai <span class="text-red-400">*</span></label>
                                <input type="date" name="valid_until" value="{{ old('valid_until', $voucher->valid_until->format('Y-m-d')) }}"
                                       class="w-full bg-white/5 border {{ $errors->has('valid_until') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white focus:outline-none focus:border-blue-500/50 transition-all [color-scheme:dark]">
                                @error('valid_until')
                                    <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Batas Total Penggunaan <span class="text-gray-500 font-normal">(opsional)</span></label>
                                <input type="number" name="usage_limit" value="{{ old('usage_limit', $voucher->usage_limit) }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-all"
                                       placeholder="Tidak terbatas" min="1">
                            </div>
                            <div>
                                <label class="block text-sm font-bold text-gray-300 mb-2">Maks. per Pengguna</label>
                                <input type="number" name="usage_per_user" value="{{ old('usage_per_user', $voucher->usage_per_user) }}"
                                       class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-blue-500/50 transition-all"
                                       min="1">
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Usage History -->
                @if($voucher->usages_count > 0)
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-orange-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-orange-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                        </span>
                        Riwayat Penggunaan
                        <span class="ml-auto text-sm font-bold text-orange-400 bg-orange-500/10 border border-orange-500/20 px-3 py-1 rounded-full">{{ $voucher->usages_count }}x digunakan</span>
                    </h2>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="pb-3 text-xs font-bold text-gray-400 uppercase">Pengguna</th>
                                    <th class="pb-3 text-xs font-bold text-gray-400 uppercase hidden sm:table-cell">Booking</th>
                                    <th class="pb-3 text-xs font-bold text-gray-400 uppercase">Diskon</th>
                                    <th class="pb-3 text-xs font-bold text-gray-400 uppercase text-right">Tanggal</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @foreach($voucher->usages()->with(['user','booking'])->latest('used_at')->take(5)->get() as $usage)
                                <tr class="hover:bg-white/5 transition-colors">
                                    <td class="py-3 text-sm text-white font-medium">
                                        {{ $usage->user?->name ?? 'Guest' }}
                                    </td>
                                    <td class="py-3 text-xs text-gray-400 hidden sm:table-cell">
                                        #{{ $usage->booking_id }}
                                    </td>
                                    <td class="py-3 text-sm font-bold text-green-400">
                                        -Rp {{ number_format($usage->discount_amount, 0, ',', '.') }}
                                    </td>
                                    <td class="py-3 text-xs text-gray-400 text-right whitespace-nowrap">
                                        {{ $usage->used_at?->format('d M Y') ?? '-' }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @if($voucher->usages_count > 5)
                            <p class="text-xs text-gray-500 mt-3 text-center">Menampilkan 5 dari {{ $voucher->usages_count }} penggunaan</p>
                        @endif
                    </div>
                </div>
                @endif
            </div>

            <!-- RIGHT COLUMN -->
            <div class="space-y-6">

                <!-- Settings -->
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
                                <p class="text-xs text-gray-500 mt-0.5">Hanya member aktif yang bisa memakai voucher ini</p>
                            </div>
                            <label class="relative inline-flex items-center cursor-pointer shrink-0 mt-0.5">
                                <input type="checkbox" name="is_member_only" class="sr-only peer"
                                       {{ old('is_member_only', $voucher->is_member_only) ? 'checked' : '' }}>
                                <div class="w-11 h-6 bg-white/10 peer-focus:ring-2 peer-focus:ring-blue-500/30 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-gray-400 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-blue-500 peer-checked:after:bg-white"></div>
                            </label>
                        </div>

                        <!-- Applicable Days -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-3">Hari Berlaku <span class="text-gray-500 font-normal">(opsional)</span></label>
                            <div class="grid grid-cols-7 gap-1.5">
                                @php
                                    $days = ['Min','Sen','Sel','Rab','Kam','Jum','Sab'];
                                    $savedDays = old('applicable_days', $voucher->applicable_days ?? []);
                                @endphp
                                @foreach($days as $i => $day)
                                <label class="cursor-pointer">
                                    <input type="checkbox" name="applicable_days[]" value="{{ $i }}" class="sr-only peer"
                                           {{ in_array($i, $savedDays) ? 'checked' : '' }}>
                                    <div class="peer-checked:bg-blue-500/20 peer-checked:border-blue-500/50 peer-checked:text-blue-400 text-center py-2 rounded-lg border border-white/10 text-gray-500 text-[10px] font-bold hover:border-white/20 transition-all">
                                        {{ $day }}
                                    </div>
                                </label>
                                @endforeach
                            </div>
                            <p class="mt-1.5 text-xs text-gray-500">Kosongkan untuk semua hari</p>
                        </div>
                    </div>
                </div>

                <!-- Live Preview -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-4 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-cyan-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-cyan-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path></svg>
                        </span>
                        Preview Voucher
                    </h2>

                    <div class="relative overflow-hidden rounded-2xl bg-gradient-to-br from-blue-600/30 via-cyan-600/20 to-blue-600/10 border border-blue-500/30 p-5">
                        <div class="absolute top-0 right-0 w-24 h-24 rounded-full bg-blue-500/10 -translate-y-8 translate-x-8"></div>
                        <div class="absolute bottom-0 left-0 w-16 h-16 rounded-full bg-cyan-500/10 translate-y-6 -translate-x-6"></div>
                        <div class="relative">
                            <div class="flex items-start justify-between mb-4">
                                <div>
                                    <p class="text-xs font-bold text-blue-300 uppercase tracking-widest mb-1">BOA FUTSAL</p>
                                    <p id="previewName" class="text-white font-extrabold text-base leading-tight">{{ $voucher->name }}</p>
                                </div>
                                <div class="w-10 h-10 rounded-xl bg-blue-500/20 border border-blue-500/30 flex items-center justify-center">
                                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                </div>
                            </div>
                            <div class="mb-4">
                                <p id="previewDiscount" class="text-3xl font-extrabold text-white">
                                    @if($voucher->type === 'percentage')
                                        {{ $voucher->discount_value }}% OFF
                                    @else
                                        Rp {{ number_format($voucher->discount_value, 0, ',', '.') }}
                                    @endif
                                </p>
                                <p class="text-blue-300 text-xs font-bold mt-0.5">DISKON</p>
                            </div>
                            <div class="border-t border-white/10 pt-3 flex items-center justify-between">
                                <div>
                                    <p class="text-xs text-blue-300 font-bold mb-0.5">KODE</p>
                                    <p id="previewCode" class="text-base font-extrabold text-white font-mono tracking-widest">{{ $voucher->code }}</p>
                                </div>
                                <div class="text-right">
                                    <p class="text-xs text-blue-300 font-bold mb-0.5">BERLAKU S/D</p>
                                    <p id="previewUntil" class="text-xs font-extrabold text-white">{{ $voucher->valid_until->format('d M Y') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Actions -->
                <button type="submit"
                        class="w-full py-4 bg-gradient-to-r from-blue-500 to-cyan-500 hover:from-blue-400 hover:to-cyan-400 text-white font-extrabold text-base rounded-2xl transition-all duration-300 shadow-lg hover:shadow-blue-500/30 hover:-translate-y-0.5 flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                    Simpan Perubahan
                </button>

                <a href="{{ route('admin.vouchers.index') }}"
                   class="w-full py-3.5 bg-white/5 hover:bg-white/10 border border-white/10 text-gray-400 hover:text-white font-bold text-sm rounded-2xl transition-all duration-300 flex items-center justify-center gap-2 mt-3">
                    Batal
                </a>

                <!-- Danger Zone -->
                <div class="p-4 rounded-2xl border border-red-500/20 bg-red-500/5">
                    <p class="text-xs font-bold text-red-400 mb-3 uppercase tracking-wider">⚠ Danger Zone</p>
                    <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST"
                          onsubmit="return confirm('Hapus voucher {{ $voucher->code }} secara permanen? Riwayat penggunaan juga akan terhapus.')">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="w-full py-2.5 bg-red-500/10 hover:bg-red-500/20 border border-red-500/30 text-red-400 font-bold text-sm rounded-xl transition-all flex items-center justify-center gap-2">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus Voucher Ini
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </form>
@endsection

@push('scripts')
<script>
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

    function updatePreview() {
        const code = document.querySelector('input[name="code"]').value || '-';
        const name = document.querySelector('input[name="name"]').value || '-';
        const type = document.querySelector('input[name="type"]:checked')?.value || 'percentage';
        const value = document.querySelector('input[name="discount_value"]').value;
        const validUntil = document.querySelector('input[name="valid_until"]').value;

        document.getElementById('previewCode').textContent = code;
        document.getElementById('previewName').textContent = name;

        if (value) {
            document.getElementById('previewDiscount').textContent = type === 'percentage'
                ? `${value}% OFF`
                : `Rp ${parseInt(value).toLocaleString('id-ID')}`;
        }

        if (validUntil) {
            const d = new Date(validUntil);
            document.getElementById('previewUntil').textContent = d.toLocaleDateString('id-ID', {day:'2-digit', month:'short', year:'numeric'});
        }
    }

    document.querySelectorAll('input[name="code"], input[name="name"], input[name="discount_value"], input[name="valid_until"]').forEach(el => {
        el.addEventListener('input', updatePreview);
    });
    typeInputs.forEach(el => el.addEventListener('change', updatePreview));
</script>
@endpush
