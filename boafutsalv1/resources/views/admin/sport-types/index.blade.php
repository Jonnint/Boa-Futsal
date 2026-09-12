@extends('layouts.admin')

@section('title', 'Manajemen Sport Type')

@section('content')
<div class="space-y-8">
    <!-- Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            <h1 class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-2.5 h-8 bg-green-500 rounded-full"></span>
                Manajemen Sport Type (Multi-Olahraga)
            </h1>
            <p class="text-gray-400 text-sm mt-1">Kelola konten, profil olahraga, switch aktif demo, dan finalisasi arsip galeri.</p>
        </div>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.sport-types.create') }}" class="px-5 py-2.5 bg-green-500 text-black font-bold text-sm rounded-xl hover:bg-green-400 transition-all flex items-center gap-2 shadow-lg shadow-green-500/20">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                Tambah Profil Baru
            </a>
        </div>
    </div>

    <!-- Alert Messages -->
    @if(session('success'))
    <div class="p-4 bg-green-500/10 border border-green-500/30 rounded-2xl flex items-center gap-3 text-green-400">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
        <span class="text-sm font-bold">{{ session('success') }}</span>
    </div>
    @endif

    @if(session('error'))
    <div class="p-4 bg-red-500/10 border border-red-500/30 rounded-2xl flex items-center gap-3 text-red-400">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
        <span class="text-sm font-bold">{{ session('error') }}</span>
    </div>
    @endif

    @if(session('info'))
    <div class="p-4 bg-blue-500/10 border border-blue-500/30 rounded-2xl flex items-center gap-3 text-blue-400">
        <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
        <span class="text-sm font-bold">{{ session('info') }}</span>
    </div>
    @endif

    <!-- Sport Types Grid -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($sportTypes as $type)
        <div class="bg-white/5 border {{ $type->is_active ? 'border-green-500/50 shadow-[0_0_30px_rgba(34,197,94,0.15)] ring-1 ring-green-500/30' : 'border-white/10' }} rounded-3xl p-6 flex flex-col justify-between relative overflow-hidden transition-all duration-300 hover:border-white/20">
            @if($type->is_active)
            <div class="absolute -right-12 -top-12 w-32 h-32 bg-green-500/10 rounded-full blur-2xl pointer-events-none"></div>
            @endif

            <div>
                <!-- Top Badge & Title -->
                <div class="flex items-start justify-between gap-4 mb-4">
                    <div>
                        <span class="text-xs font-mono uppercase tracking-wider text-gray-500">Slug: {{ $type->slug }}</span>
                        <h2 class="text-2xl font-extrabold text-white flex items-center gap-2 mt-0.5">
                            {{ $type->name }}
                        </h2>
                    </div>
                    @if($type->is_active)
                        <span class="px-3 py-1 bg-green-500 text-black text-xs font-black uppercase tracking-wider rounded-full shadow-[0_0_15px_rgba(34,197,94,0.4)] flex items-center gap-1.5">
                            <span class="w-2 h-2 rounded-full bg-black animate-pulse"></span>
                            AKTIF LIVE
                        </span>
                    @else
                        <span class="px-3 py-1 bg-white/10 text-gray-400 text-xs font-bold rounded-full">
                            Non-Aktif
                        </span>
                    @endif
                </div>

                <!-- Hero Info -->
                <div class="bg-black/30 border border-white/5 rounded-2xl p-4 mb-4">
                    <p class="text-xs text-gray-500 uppercase tracking-wider mb-1 font-bold">Hero Title</p>
                    <p class="text-sm text-white font-semibold line-clamp-1">{!! strip_tags($type->hero_title) !!}</p>
                    <p class="text-xs text-gray-400 line-clamp-2 mt-1">{{ $type->hero_subtitle }}</p>
                </div>

                <!-- Metrics / Counters -->
                <div class="grid grid-cols-3 gap-2 mb-6">
                    <div class="bg-white/5 rounded-xl p-3 border border-white/5 text-center">
                        <span class="text-xl font-extrabold text-white block">{{ $type->fields_count }}</span>
                        <span class="text-[11px] text-gray-400 uppercase font-semibold">Lapangan</span>
                    </div>
                    <div class="bg-white/5 rounded-xl p-3 border border-white/5 text-center">
                        <span class="text-xl font-extrabold text-white block">{{ $type->galleries_count }}</span>
                        <span class="text-[11px] text-gray-400 uppercase font-semibold">Foto Galeri</span>
                    </div>
                    <div class="bg-white/5 rounded-xl p-3 border border-white/5 text-center">
                        <span class="text-xl font-extrabold text-white block">{{ $type->historical_bookings_count }}</span>
                        <span class="text-[11px] text-gray-400 uppercase font-semibold">Booking</span>
                    </div>
                </div>
            </div>

            <!-- Actions -->
            <div class="space-y-2 pt-4 border-t border-white/10">
                <!-- Edit Konten (Semua Admin) -->
                <a href="{{ route('admin.sport-types.edit', $type->id) }}" class="w-full py-2.5 bg-white/5 hover:bg-white/10 border border-white/10 text-white text-xs font-bold rounded-xl transition-all flex items-center justify-center gap-2">
                    <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                    Edit Konten & Galeri
                </a>

                <!-- Switch Aktif Button -->
                @if($type->is_active)
                    <button disabled class="w-full py-2.5 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-extrabold rounded-xl flex items-center justify-center gap-2 cursor-default">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                        Sedang Aktif Live
                    </button>
                @else
                    @if(Auth::user()->isDeveloper())
                        @if($type->has_valid_fields)
                            <button onclick="confirmActivate({{ $type->id }}, '{{ $type->name }}')" class="w-full py-2.5 bg-green-500 text-black hover:bg-green-400 text-xs font-extrabold rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg shadow-green-500/10">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.752 11.168l-3.197-2.132A1 1 0 0010 9.87v4.263a1 1 0 001.555.832l3.197-2.132a1 1 0 000-1.664z"></path><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Jadikan Aktif (Live Switch)
                            </button>
                        @else
                            <button disabled title="Harus memiliki minimal 1 lapangan aktif berharga sebelum diaktifkan" class="w-full py-2.5 bg-gray-800 text-gray-500 border border-gray-700 text-xs font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2">
                                <svg class="w-4 h-4 text-yellow-500/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                                Belum Ada Lapangan Berharga
                            </button>
                        @endif
                    @else
                        <button disabled title="Hanya role Developer yang bisa mengubah status ini." class="w-full py-2.5 bg-white/5 border border-white/5 text-gray-500 text-xs font-bold rounded-xl cursor-not-allowed flex items-center justify-center gap-2 group relative">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Jadikan Aktif (Khusus Developer)
                        </button>
                    @endif
                @endif

                <!-- Hapus Sport Type (Khusus Developer, Disabled utk Admin) -->
                @if(!$type->is_active)
                    @if(Auth::user()->isDeveloper())
                        <button onclick="confirmDelete({{ $type->id }}, '{{ $type->name }}', {{ $type->fields_count }}, {{ $type->galleries_count }}, {{ $type->historical_bookings_count }})" class="w-full py-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 text-xs font-semibold rounded-xl transition-all flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                            Hapus & Arsipkan Galeri
                        </button>
                    @else
                        <button disabled title="Hanya role Developer yang bisa menghapus Sport Type." class="w-full py-2 text-gray-600 text-xs font-semibold rounded-xl cursor-not-allowed flex items-center justify-center gap-1.5">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path></svg>
                            Hapus (Khusus Developer)
                        </button>
                    @endif
                @endif
            </div>
        </div>
        @endforeach
    </div>

    <!-- Audit Logs Section -->
    <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8">
        <h3 class="text-lg font-extrabold text-white mb-4 flex items-center gap-2">
            <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
            Riwayat Switch & Finalisasi (Audit Log)
        </h3>

        @if($switchLogs->isEmpty())
            <p class="text-sm text-gray-500 italic">Belum ada riwayat switch status olahraga.</p>
        @else
            <div class="overflow-x-auto">
                <table class="w-full text-left text-sm">
                    <thead>
                        <tr class="border-b border-white/10 text-gray-400 text-xs uppercase tracking-wider">
                            <th class="py-3 px-4">Waktu</th>
                            <th class="py-3 px-4">User</th>
                            <th class="py-3 px-4">Aksi</th>
                            <th class="py-3 px-4">Dari</th>
                            <th class="py-3 px-4">Menjadi / Sasaran</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/5">
                        @foreach($switchLogs as $log)
                        <tr class="hover:bg-white/5 transition-colors">
                            <td class="py-3 px-4 text-gray-400 font-mono text-xs">{{ $log->created_at->format('d M Y H:i') }}</td>
                            <td class="py-3 px-4 text-white font-semibold">{{ $log->user->name ?? 'System' }}</td>
                            <td class="py-3 px-4">
                                @if($log->action === 'activate')
                                    <span class="px-2.5 py-1 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold rounded-md">
                                        Switch Aktif
                                    </span>
                                @else
                                    <span class="px-2.5 py-1 bg-red-500/10 border border-red-500/20 text-red-400 text-xs font-bold rounded-md">
                                        Hapus & Arsip
                                    </span>
                                @endif
                            </td>
                            <td class="py-3 px-4 text-gray-400">{{ $log->fromSportType->name ?? '-' }}</td>
                            <td class="py-3 px-4 text-white font-bold">{{ $log->toSportType->name ?? '-' }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>
</div>

<!-- Modal Konfirmasi Switch Aktif -->
<div id="activateModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="bg-[#111] border border-white/20 rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-6">
        <div class="w-14 h-14 rounded-2xl bg-green-500/10 border border-green-500/20 flex items-center justify-center text-green-400 mx-auto">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
        </div>
        <div class="text-center">
            <h3 class="text-xl font-bold text-white mb-2">Konfirmasi Switch Aktif Live</h3>
            <p class="text-sm text-gray-300">
                Apakah Anda yakin ingin mengaktifkan <span id="activateSportName" class="font-extrabold text-green-400"></span>?
            </p>
            <div class="mt-4 p-3 bg-yellow-500/10 border border-yellow-500/20 rounded-xl text-xs text-yellow-300 text-left flex items-start gap-2">
                <svg class="w-4 h-4 shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path></svg>
                <span><strong>Perhatian:</strong> Sesuai keputusan PRD, sistem tidak menggunakan preview/staging. Begitu tombol ini ditekan, konten halaman publik akan <strong>langsung berganti secara live</strong> saat itu juga.</span>
            </div>
        </div>
        <form id="activateForm" method="POST" action="">
            @csrf
            <div class="grid grid-cols-2 gap-3">
                <button type="button" onclick="closeActivateModal()" class="py-3 bg-white/5 hover:bg-white/10 text-white font-bold rounded-xl text-sm transition-all border border-white/10">Batal</button>
                <button type="submit" class="py-3 bg-green-500 hover:bg-green-400 text-black font-extrabold rounded-xl text-sm transition-all shadow-lg shadow-green-500/20">Ya, Aktifkan Sekarang</button>
            </div>
        </form>
    </div>
</div>

<!-- Modal Konfirmasi Hapus & Finalisasi -->
<div id="deleteModal" class="fixed inset-0 z-50 hidden flex items-center justify-center p-4 bg-black/80 backdrop-blur-sm">
    <div class="bg-[#111] border border-red-500/30 rounded-3xl p-6 sm:p-8 max-w-md w-full shadow-2xl space-y-6">
        <div class="w-14 h-14 rounded-2xl bg-red-500/10 border border-red-500/20 flex items-center justify-center text-red-400 mx-auto">
            <svg class="w-7 h-7" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
        </div>
        <div class="text-center">
            <h3 class="text-xl font-bold text-white mb-2">Finalisasi & Hapus Profil</h3>
            <p class="text-sm text-gray-300">
                Anda akan menghapus profil <span id="deleteSportName" class="font-extrabold text-red-400"></span>.
            </p>
            <div class="mt-4 p-4 bg-white/5 border border-white/10 rounded-xl text-xs space-y-2 text-left">
                <div class="flex justify-between text-gray-400">
                    <span>Lapangan Terkait:</span>
                    <span id="delFieldCount" class="font-bold text-white">0</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>Foto Galeri (akan diarsipkan):</span>
                    <span id="delGalleryCount" class="font-bold text-green-400">0</span>
                </div>
                <div class="flex justify-between text-gray-400">
                    <span>Booking Historis (tetap aman):</span>
                    <span id="delBookingCount" class="font-bold text-blue-400">0</span>
                </div>
            </div>
            <p class="text-xs text-gray-400 mt-3 text-left">
                ℹ️ <strong>Catatan Pengarsipan:</strong> File foto galeri TIDAK akan dihapus permanen, melainkan dipindahkan otomatis ke folder arsip (<code>storage/app/archived-galleries</code>).
            </p>
        </div>
        <form id="deleteForm" method="POST" action="">
            @csrf
            @method('DELETE')
            <div class="grid grid-cols-2 gap-3">
                <button type="button" onclick="closeDeleteModal()" class="py-3 bg-white/5 hover:bg-white/10 text-white font-bold rounded-xl text-sm transition-all border border-white/10">Batal</button>
                <button type="submit" class="py-3 bg-red-500 hover:bg-red-400 text-white font-extrabold rounded-xl text-sm transition-all shadow-lg shadow-red-500/20">Hapus & Arsipkan</button>
            </div>
        </form>
    </div>
</div>

<script>
    function confirmActivate(id, name) {
        document.getElementById('activateSportName').textContent = name;
        document.getElementById('activateForm').action = '/admin/sport-types/' + id + '/activate';
        document.getElementById('activateModal').classList.remove('hidden');
    }

    function closeActivateModal() {
        document.getElementById('activateModal').classList.add('hidden');
    }

    function confirmDelete(id, name, fields, galleries, bookings) {
        document.getElementById('deleteSportName').textContent = name;
        document.getElementById('delFieldCount').textContent = fields;
        document.getElementById('delGalleryCount').textContent = galleries;
        document.getElementById('delBookingCount').textContent = bookings;
        document.getElementById('deleteForm').action = '/admin/sport-types/' + id;
        document.getElementById('deleteModal').classList.remove('hidden');
    }

    function closeDeleteModal() {
        document.getElementById('deleteModal').classList.add('hidden');
    }
</script>
@endsection
