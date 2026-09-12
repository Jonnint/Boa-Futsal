@extends('layouts.admin')

@section('title', 'Edit Konten Sport Type')

@section('content')
<div class="max-w-5xl mx-auto space-y-8">
    <!-- Header -->
    <div class="flex items-center justify-between">
        <div>
            <a href="{{ route('admin.sport-types.index') }}" class="text-xs font-bold text-gray-400 hover:text-green-400 flex items-center gap-1 mb-2 transition-colors">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                Kembali ke Daftar Sport Type
            </a>
            <h1 class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-2.5 h-8 bg-green-500 rounded-full"></span>
                Edit Konten & Galeri: {{ $sportType->name }}
            </h1>
            <p class="text-gray-400 text-sm mt-1">Ubah teks hero, deskripsi, fasilitas, dan foto galeri untuk profil olahraga ini.</p>
        </div>

        @if($sportType->is_active)
            <span class="px-3.5 py-1.5 bg-green-500 text-black text-xs font-black uppercase tracking-wider rounded-full flex items-center gap-2">
                <span class="w-2 h-2 rounded-full bg-black animate-pulse"></span>
                Profil Sedang Aktif Live
            </span>
        @endif
    </div>

    <!-- Error Messages -->
    @if ($errors->any())
    <div class="p-4 bg-red-500/10 border border-red-500/30 rounded-2xl text-red-400 text-sm">
        <ul class="list-disc pl-5 space-y-1">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form method="POST" action="{{ route('admin.sport-types.update', $sportType->id) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- Bagian 1: Informasi Utama & Hero Section -->
        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
            <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                1. Header & Hero Section
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Nama Olahraga</label>
                    <input type="text" name="name" value="{{ old('name', $sportType->name) }}" required class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Hero Title</label>
                    <input type="text" name="hero_title" value="{{ old('hero_title', $sportType->hero_title) }}" required class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none" placeholder="Contoh: MAIN PRO SETIAP HARI.">
                </div>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Hero Subtitle</label>
                <textarea name="hero_subtitle" rows="2" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">{{ old('hero_subtitle', $sportType->hero_subtitle) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Deskripsi Umum</label>
                <textarea name="description" rows="3" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 focus:ring-1 focus:ring-green-500 outline-none">{{ old('description', $sportType->description) }}</textarea>
            </div>

            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Foto Hero Background</label>
                @if($sportType->hero_image_path)
                    <div class="mb-3 flex items-center gap-4">
                        <img src="{{ asset($sportType->hero_image_path) }}" alt="Current Hero" class="w-32 h-20 object-cover rounded-xl border border-white/10">
                        <span class="text-xs text-gray-400">Foto saat ini aktif. Unggah foto baru jika ingin mengganti.</span>
                    </div>
                @endif
                <input type="file" name="hero_image" accept="image/*" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-gray-400 text-sm focus:border-green-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-green-500 file:text-black hover:file:bg-green-400">
            </div>
        </div>

        <!-- Bagian 2: Fasilitas Dinamis -->
        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
            <div class="flex items-center justify-between border-b border-white/10 pb-4">
                <h2 class="text-xl font-bold text-white flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                    2. Fasilitas Khusus Sport Type
                </h2>
                <button type="button" onclick="addFacilityRow()" class="px-3 py-1.5 bg-green-500/10 border border-green-500/20 text-green-400 text-xs font-bold rounded-lg hover:bg-green-500 hover:text-black transition-all flex items-center gap-1.5">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Fasilitas
                </button>
            </div>

            <div id="facilitiesContainer" class="space-y-4">
                @php
                    $facilities = old('facilities', $sportType->facilities ?? []);
                @endphp
                @forelse($facilities as $index => $fac)
                <div class="facility-row bg-black/40 border border-white/10 rounded-2xl p-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-center">
                    <div class="md:col-span-4">
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Nama Fasilitas</label>
                        <input type="text" name="facilities[{{ $index }}][name]" value="{{ $fac['name'] ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-xs outline-none focus:border-green-500" required>
                    </div>
                    <div class="md:col-span-5">
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Deskripsi Singkat</label>
                        <input type="text" name="facilities[{{ $index }}][desc]" value="{{ $fac['desc'] ?? '' }}" class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-xs outline-none focus:border-green-500">
                    </div>
                    <div class="md:col-span-2">
                        <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Icon</label>
                        <select name="facilities[{{ $index }}][icon]" class="w-full bg-black border border-white/10 rounded-xl px-3 py-2 text-white text-xs outline-none focus:border-green-500">
                            <option value="toilet" {{ ($fac['icon'] ?? '') == 'toilet' ? 'selected' : '' }}>Toilet / Shower</option>
                            <option value="mushola" {{ ($fac['icon'] ?? '') == 'mushola' ? 'selected' : '' }}>Mushola / Ibadah</option>
                            <option value="kasir" {{ ($fac['icon'] ?? '') == 'kasir' ? 'selected' : '' }}>Kasir / Pro Shop</option>
                            <option value="parkir" {{ ($fac['icon'] ?? '') == 'parkir' ? 'selected' : '' }}>Parkir / Lapangan</option>
                        </select>
                    </div>
                    <div class="md:col-span-1 flex items-end justify-center pt-3 md:pt-0">
                        <button type="button" onclick="removeFacilityRow(this)" class="p-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-xl transition-all" title="Hapus Fasilitas">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                        </button>
                    </div>
                </div>
                @empty
                <p id="noFacilityText" class="text-xs text-gray-500 italic text-center py-4">Belum ada fasilitas khusus yang ditambahkan.</p>
                @endforelse
            </div>
        </div>

        <!-- Bagian 3: Galeri Foto -->
        <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
            <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                3. Galeri Foto Lapangan & Venue
            </h2>

            <!-- Foto Saat Ini -->
            <div>
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-3">Foto Galeri Aktif</label>
                @if($sportType->galleries->isEmpty())
                    <p class="text-xs text-gray-500 italic">Belum ada foto galeri.</p>
                @else
                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                        @foreach($sportType->galleries as $gallery)
                        <div class="group relative rounded-2xl overflow-hidden border border-white/10 bg-black/40">
                            <img src="{{ asset($gallery->image_path) }}" alt="{{ $gallery->caption }}" class="w-full h-32 object-cover">
                            <div class="p-2">
                                <p class="text-[11px] text-gray-300 truncate">{{ $gallery->caption ?? 'Foto' }}</p>
                            </div>
                            <button type="submit" name="delete_gallery_id" value="{{ $gallery->id }}" onclick="return confirm('Hapus foto ini dari galeri?')" class="absolute top-2 right-2 p-1.5 bg-red-500/80 hover:bg-red-500 text-white rounded-lg opacity-0 group-hover:opacity-100 transition-opacity" title="Hapus foto">
                                <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                            </button>
                        </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- Upload Tambahan -->
            <div class="pt-4 border-t border-white/5">
                <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Unggah Foto Galeri Baru (Multiple)</label>
                <input type="file" name="gallery_images[]" multiple accept="image/*" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-gray-400 text-sm focus:border-green-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-green-500 file:text-black hover:file:bg-green-400">
                <p class="text-xs text-gray-500 mt-1.5">Bisa memilih lebih dari satu foto sekaligus (PNG, JPG, WEBP maks 5MB per file).</p>
            </div>
        </div>

        <!-- Submit Button -->
        <div class="flex items-center justify-end gap-4">
            <a href="{{ route('admin.sport-types.index') }}" class="px-6 py-3 bg-white/5 hover:bg-white/10 text-white font-bold text-sm rounded-xl transition-all border border-white/10">Batal</a>
            <button type="submit" class="px-8 py-3 bg-green-500 hover:bg-green-400 text-black font-extrabold text-sm rounded-xl transition-all shadow-lg shadow-green-500/20">
                Simpan Perubahan Konten
            </button>
        </div>
    </form>
</div>

<script>
    let facilityIndex = {{ count($facilities) }};

    function addFacilityRow() {
        const noText = document.getElementById('noFacilityText');
        if (noText) noText.style.display = 'none';

        const container = document.getElementById('facilitiesContainer');
        const row = document.createElement('div');
        row.className = 'facility-row bg-black/40 border border-white/10 rounded-2xl p-4 grid grid-cols-1 md:grid-cols-12 gap-4 items-center';
        row.innerHTML = `
            <div class="md:col-span-4">
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Nama Fasilitas</label>
                <input type="text" name="facilities[${facilityIndex}][name]" placeholder="Nama fasilitas" class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-xs outline-none focus:border-green-500" required>
            </div>
            <div class="md:col-span-5">
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Deskripsi Singkat</label>
                <input type="text" name="facilities[${facilityIndex}][desc]" placeholder="Keterangan singkat..." class="w-full bg-white/5 border border-white/10 rounded-xl px-3 py-2 text-white text-xs outline-none focus:border-green-500">
            </div>
            <div class="md:col-span-2">
                <label class="block text-[10px] font-bold uppercase text-gray-400 mb-1">Icon</label>
                <select name="facilities[${facilityIndex}][icon]" class="w-full bg-black border border-white/10 rounded-xl px-3 py-2 text-white text-xs outline-none focus:border-green-500">
                    <option value="toilet">Toilet / Shower</option>
                    <option value="mushola">Mushola / Ibadah</option>
                    <option value="kasir">Kasir / Pro Shop</option>
                    <option value="parkir">Parkir / Lapangan</option>
                </select>
            </div>
            <div class="md:col-span-1 flex items-end justify-center pt-3 md:pt-0">
                <button type="button" onclick="removeFacilityRow(this)" class="p-2 text-red-400 hover:text-red-300 hover:bg-red-500/10 rounded-xl transition-all" title="Hapus Fasilitas">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                </button>
            </div>
        `;
        container.appendChild(row);
        facilityIndex++;
    }

    function removeFacilityRow(btn) {
        btn.closest('.facility-row').remove();
    }
</script>
@endsection
