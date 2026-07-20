@extends('layouts.admin')

@section('title', 'Kelola Voucher')

@section('content')
    <!-- Header -->
    <div class="relative overflow-hidden rounded-3xl p-8 md:p-10 bg-white/5 border border-white/10 backdrop-blur-xl shadow-2xl mb-8 group">
        <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 via-transparent to-transparent opacity-50 group-hover:opacity-100 transition-opacity duration-700"></div>
        <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
            <div>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-extrabold leading-tight tracking-tighter mb-2 text-white">
                    Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">Voucher</span>
                </h1>
                <p class="text-gray-400 text-sm lg:text-base font-medium">
                    Buat dan kelola voucher diskon untuk customer BOA Futsal
                </p>
            </div>
            <a href="{{ route('admin.vouchers.create') }}"
               class="inline-flex items-center gap-2 px-6 py-3 bg-gradient-to-r from-green-500 to-emerald-500 hover:from-green-400 hover:to-emerald-400 text-white font-bold rounded-xl transition-all duration-300 shadow-lg hover:shadow-green-500/30 hover:-translate-y-0.5 shrink-0">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Buat Voucher Baru
            </a>
        </div>
    </div>

    <!-- Flash Messages -->
    @if(session('success'))
        <div id="flash-success" class="mb-6 flex items-center gap-3 px-5 py-4 rounded-2xl bg-green-500/10 border border-green-500/30 text-green-400 font-semibold text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div id="flash-error" class="mb-6 flex items-center gap-3 px-5 py-4 rounded-2xl bg-red-500/10 border border-red-500/30 text-red-400 font-semibold text-sm">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            {{ session('error') }}
        </div>
    @endif

    <!-- Stats Row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-8">
        @php
            $totalVouchers   = $vouchers->total();
            $activeVouchers  = $vouchers->getCollection()->where('is_active', true)->count();
            $totalUsages     = $vouchers->getCollection()->sum('usages_count');
        @endphp
        <div class="group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-5 hover:-translate-y-1 hover:border-green-500/30 transition-all duration-300">
            <div class="w-10 h-10 bg-green-500/10 rounded-xl flex items-center justify-center mb-3 group-hover:bg-green-500/20 transition-colors">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
            </div>
            <p class="text-2xl font-extrabold text-white">{{ $totalVouchers }}</p>
            <p class="text-xs text-gray-400 font-medium mt-0.5">Total Voucher</p>
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-5 hover:-translate-y-1 hover:border-green-500/30 transition-all duration-300">
            <div class="w-10 h-10 bg-green-500/10 rounded-xl flex items-center justify-center mb-3 group-hover:bg-green-500/20 transition-colors">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-2xl font-extrabold text-white">{{ $activeVouchers }}</p>
            <p class="text-xs text-gray-400 font-medium mt-0.5">Aktif (halaman ini)</p>
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-5 hover:-translate-y-1 hover:border-blue-500/30 transition-all duration-300">
            <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center mb-3 group-hover:bg-blue-500/20 transition-colors">
                <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 9V7a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2m2 4h10a2 2 0 002-2v-6a2 2 0 00-2-2H9a2 2 0 00-2 2v6a2 2 0 002 2zm7-5a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
            </div>
            <p class="text-2xl font-extrabold text-white">{{ $totalUsages }}</p>
            <p class="text-xs text-gray-400 font-medium mt-0.5">Total Penggunaan</p>
        </div>
        <div class="group relative overflow-hidden rounded-2xl bg-white/5 border border-white/10 p-5 hover:-translate-y-1 hover:border-yellow-500/30 transition-all duration-300">
            <div class="w-10 h-10 bg-yellow-500/10 rounded-xl flex items-center justify-center mb-3 group-hover:bg-yellow-500/20 transition-colors">
                <svg class="w-5 h-5 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            </div>
            <p class="text-2xl font-extrabold text-white">{{ $vouchers->lastPage() }}</p>
            <p class="text-xs text-gray-400 font-medium mt-0.5">Total Halaman</p>
        </div>
    </div>

    <!-- Table -->
    <div class="bg-white/5 border border-white/10 rounded-3xl backdrop-blur-xl shadow-2xl overflow-hidden">
        <div class="px-6 md:px-8 py-6 border-b border-white/10 flex items-center justify-between gap-4 flex-wrap">
            <h2 class="text-xl font-extrabold text-white">Daftar Voucher</h2>
            <span class="text-sm text-gray-400">{{ $vouchers->total() }} voucher ditemukan</span>
        </div>

        @if($vouchers->isEmpty())
            <div class="flex flex-col items-center justify-center py-20 text-gray-500">
                <svg class="w-16 h-16 mb-4 text-gray-600/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                <p class="font-bold text-lg text-gray-400 mb-2">Belum ada voucher</p>
                <p class="text-sm text-gray-500 mb-6">Mulai buat voucher pertama kamu!</p>
                <a href="{{ route('admin.vouchers.create') }}" class="px-6 py-3 bg-green-500/20 border border-green-500/30 text-green-400 font-bold rounded-xl hover:bg-green-500/30 transition-all">
                    Buat Voucher
                </a>
            </div>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b border-white/10">
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider">Voucher</th>
                            <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider hidden md:table-cell">Tipe & Diskon</th>
                            <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider hidden lg:table-cell">Periode</th>
                            <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider hidden sm:table-cell">Penggunaan</th>
                            <th class="py-4 px-4 text-xs font-bold text-gray-400 uppercase tracking-wider">Status</th>
                            <th class="py-4 px-6 text-xs font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($vouchers as $voucher)
                        <tr class="hover:bg-white/5 transition-colors group">
                            <!-- Voucher Info -->
                            <td class="py-4 px-6 whitespace-nowrap">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-green-500/20 to-emerald-500/20 border border-green-500/20 flex items-center justify-center shrink-0">
                                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 7h.01M7 3h5c.512 0 1.024.195 1.414.586l7 7a2 2 0 010 2.828l-7 7a2 2 0 01-2.828 0l-7-7A1.994 1.994 0 013 12V7a4 4 0 014-4z"></path></svg>
                                    </div>
                                    <div>
                                        <div class="font-extrabold text-sm text-white tracking-wider font-mono group-hover:text-green-400 transition-colors">{{ $voucher->code }}</div>
                                        <div class="text-xs text-gray-400 mt-0.5 max-w-[160px] truncate">{{ $voucher->name }}</div>
                                        @if($voucher->is_member_only)
                                            <span class="mt-1 inline-flex items-center px-1.5 py-0.5 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-[9px] font-extrabold rounded uppercase tracking-wider">Member Only</span>
                                        @endif
                                    </div>
                                </div>
                            </td>

                            <!-- Tipe & Diskon -->
                            <td class="py-4 px-4 whitespace-nowrap hidden md:table-cell">
                                @if($voucher->type === 'percentage')
                                    <div class="flex items-center gap-2">
                                        <span class="px-2.5 py-1 bg-blue-500/10 border border-blue-500/20 text-blue-400 rounded-lg text-xs font-bold">%</span>
                                        <span class="text-white font-bold text-sm">{{ $voucher->discount_value }}%</span>
                                    </div>
                                    @if($voucher->max_discount)
                                        <div class="text-xs text-gray-500 mt-1">Maks. Rp {{ number_format($voucher->max_discount, 0, ',', '.') }}</div>
                                    @endif
                                @else
                                    <div class="flex items-center gap-2">
                                        <span class="px-2.5 py-1 bg-green-500/10 border border-green-500/20 text-green-400 rounded-lg text-xs font-bold">Rp</span>
                                        <span class="text-white font-bold text-sm">{{ number_format($voucher->discount_value, 0, ',', '.') }}</span>
                                    </div>
                                @endif
                                @if($voucher->min_booking_amount)
                                    <div class="text-xs text-gray-500 mt-1">Min. Rp {{ number_format($voucher->min_booking_amount, 0, ',', '.') }}</div>
                                @endif
                            </td>

                            <!-- Periode -->
                            <td class="py-4 px-4 whitespace-nowrap hidden lg:table-cell">
                                <div class="text-sm text-white font-medium">{{ $voucher->valid_from->format('d M Y') }}</div>
                                <div class="text-xs text-gray-400 mt-0.5 flex items-center gap-1">
                                    <span>s/d</span>
                                    <span class="{{ $voucher->valid_until->isPast() ? 'text-red-400' : 'text-gray-400' }}">{{ $voucher->valid_until->format('d M Y') }}</span>
                                </div>
                                @if($voucher->valid_until->isPast())
                                    <span class="mt-1 inline-block text-[9px] font-bold text-red-400 uppercase tracking-wider">Expired</span>
                                @elseif($voucher->valid_from->isFuture())
                                    <span class="mt-1 inline-block text-[9px] font-bold text-yellow-400 uppercase tracking-wider">Belum Mulai</span>
                                @endif
                            </td>

                            <!-- Penggunaan -->
                            <td class="py-4 px-4 whitespace-nowrap hidden sm:table-cell">
                                <div class="flex items-center gap-2">
                                    <div class="w-28 h-1.5 bg-white/10 rounded-full overflow-hidden">
                                        @php
                                            $usagePercent = $voucher->usage_limit ? min(100, ($voucher->usages_count / $voucher->usage_limit) * 100) : 0;
                                        @endphp
                                        <div class="h-full bg-gradient-to-r from-green-500 to-emerald-500 rounded-full transition-all"
                                             style="width: {{ $usagePercent }}%"></div>
                                    </div>
                                </div>
                                <div class="text-xs text-gray-400 mt-1 font-medium">
                                    {{ $voucher->usages_count }}
                                    @if($voucher->usage_limit)
                                        / {{ $voucher->usage_limit }}
                                    @else
                                        <span class="text-gray-500">/ ∞</span>
                                    @endif
                                    kali
                                </div>
                            </td>

                            <!-- Status -->
                            <td class="py-4 px-4 whitespace-nowrap">
                                @if($voucher->is_active)
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-green-500/10 border border-green-500/30 text-green-400 rounded-full text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-green-400 animate-pulse"></span>
                                        Aktif
                                    </span>
                                @else
                                    <span class="inline-flex items-center gap-1.5 px-3 py-1 bg-gray-500/10 border border-gray-500/30 text-gray-400 rounded-full text-xs font-bold">
                                        <span class="w-1.5 h-1.5 rounded-full bg-gray-500"></span>
                                        Nonaktif
                                    </span>
                                @endif
                            </td>

                            <!-- Aksi -->
                            <td class="py-4 px-6 whitespace-nowrap text-right">
                                <div class="flex items-center justify-end gap-2">
                                    <!-- Toggle Active -->
                                    <form action="{{ route('admin.vouchers.toggle', $voucher) }}" method="POST">
                                        @csrf
                                        <button type="submit"
                                                class="p-2 rounded-lg transition-all duration-200 {{ $voucher->is_active ? 'bg-yellow-500/10 hover:bg-yellow-500/20 text-yellow-400 border border-yellow-500/20' : 'bg-green-500/10 hover:bg-green-500/20 text-green-400 border border-green-500/20' }}"
                                                title="{{ $voucher->is_active ? 'Nonaktifkan' : 'Aktifkan' }}">
                                            @if($voucher->is_active)
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 18.364A9 9 0 005.636 5.636m12.728 12.728A9 9 0 015.636 5.636m12.728 12.728L5.636 5.636"></path></svg>
                                            @else
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            @endif
                                        </button>
                                    </form>

                                    <!-- Edit -->
                                    <a href="{{ route('admin.vouchers.edit', $voucher) }}"
                                       class="p-2 rounded-lg bg-blue-500/10 hover:bg-blue-500/20 text-blue-400 border border-blue-500/20 transition-all duration-200"
                                       title="Edit">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                    </a>

                                    <!-- Delete -->
                                    <form action="{{ route('admin.vouchers.destroy', $voucher) }}" method="POST"
                                          onsubmit="return confirm('Yakin hapus voucher {{ $voucher->code }}? Data tidak bisa dikembalikan.')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="p-2 rounded-lg bg-red-500/10 hover:bg-red-500/20 text-red-400 border border-red-500/20 transition-all duration-200"
                                                title="Hapus">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            @if($vouchers->hasPages())
                <div class="px-6 py-5 border-t border-white/10 flex items-center justify-between gap-4 flex-wrap">
                    <p class="text-sm text-gray-500">
                        Menampilkan <span class="text-white font-bold">{{ $vouchers->firstItem() }}</span>–<span class="text-white font-bold">{{ $vouchers->lastItem() }}</span>
                        dari <span class="text-white font-bold">{{ $vouchers->total() }}</span> voucher
                    </p>
                    <div class="flex items-center gap-2">
                        @if($vouchers->onFirstPage())
                            <span class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-600 text-sm cursor-not-allowed">
                                &larr;
                            </span>
                        @else
                            <a href="{{ $vouchers->previousPageUrl() }}" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:border-white/20 text-sm transition-all">
                                &larr;
                            </a>
                        @endif

                        @foreach($vouchers->getUrlRange(1, $vouchers->lastPage()) as $page => $url)
                            @if($page == $vouchers->currentPage())
                                <span class="px-3 py-2 rounded-lg bg-green-500/20 border border-green-500/40 text-green-400 font-bold text-sm">{{ $page }}</span>
                            @else
                                <a href="{{ $url }}" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:border-white/20 text-sm transition-all">{{ $page }}</a>
                            @endif
                        @endforeach

                        @if($vouchers->hasMorePages())
                            <a href="{{ $vouchers->nextPageUrl() }}" class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-400 hover:text-white hover:border-white/20 text-sm transition-all">
                                &rarr;
                            </a>
                        @else
                            <span class="px-3 py-2 rounded-lg bg-white/5 border border-white/10 text-gray-600 text-sm cursor-not-allowed">
                                &rarr;
                            </span>
                        @endif
                    </div>
                </div>
            @endif
        @endif
    </div>
@endsection

@push('scripts')
<script>
    // Auto-dismiss flash messages after 4s
    setTimeout(() => {
        document.querySelectorAll('#flash-success, #flash-error').forEach(el => {
            el.style.transition = 'opacity 0.5s';
            el.style.opacity = '0';
            setTimeout(() => el.remove(), 500);
        });
    }, 4000);
</script>
@endpush
