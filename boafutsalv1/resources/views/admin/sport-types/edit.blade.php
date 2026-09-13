@extends('layouts.admin')

@section('title', 'Edit Konten Sport Type: ' . $sportType->name)

@section('content')
<div class="max-w-6xl mx-auto space-y-8">
    <!-- Top Header -->
    <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
        <div>
            @if(Auth::user()->isDeveloper())
                <a href="{{ route('admin.sport-types.index') }}" class="text-xs font-bold text-gray-400 hover:text-green-400 flex items-center gap-1 mb-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Switch Sport Type
                </a>
            @else
                <a href="{{ route('admin.dashboard') }}" class="text-xs font-bold text-gray-400 hover:text-green-400 flex items-center gap-1 mb-2 transition-colors">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path></svg>
                    Kembali ke Dashboard
                </a>
            @endif
            <h1 class="text-3xl font-extrabold text-white tracking-tight flex items-center gap-3">
                <span class="w-2.5 h-8 bg-green-500 rounded-full"></span>
                Kelola Konten: {{ $sportType->name }}
            </h1>
            <p class="text-gray-400 text-sm mt-1">Sesuaikan teks, gambar, dan kebijakan untuk setiap halaman publik pada cabang olahraga ini.</p>
        </div>

        @if($sportType->is_active)
            <span class="self-start sm:self-auto px-4 py-2 bg-green-500 text-black text-xs font-black uppercase tracking-wider rounded-full flex items-center gap-2 shadow-lg shadow-green-500/20">
                <span class="w-2 h-2 rounded-full bg-black animate-pulse"></span>
                Profil Sedang Aktif Live
            </span>
        @endif
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="p-4 bg-green-500/10 border border-green-500/30 rounded-2xl text-green-400 text-sm flex items-center gap-3">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
            <p class="font-bold">{{ session('success') }}</p>
        </div>
    @endif

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

    <!-- Multi-tab Navigation Bar -->
    <div class="flex flex-wrap items-center gap-2 border-b border-white/10 pb-4">
        <button type="button" onclick="switchTab('tab-home')" id="btn-tab-home" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-extrabold tracking-wider uppercase transition-all bg-green-500 text-black shadow-lg shadow-green-500/20">
            🏠 Home (Beranda)
        </button>
        <button type="button" onclick="switchTab('tab-sejarah')" id="btn-tab-sejarah" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-extrabold tracking-wider uppercase transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 border border-white/5">
            📖 Sejarah & Profil
        </button>
        <button type="button" onclick="switchTab('tab-cara-booking')" id="btn-tab-cara-booking" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-extrabold tracking-wider uppercase transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 border border-white/5">
            📋 Cara Booking
        </button>
        <button type="button" onclick="switchTab('tab-booking')" id="btn-tab-booking" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-extrabold tracking-wider uppercase transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 border border-white/5">
            🏟️ Form Booking
        </button>
        <button type="button" onclick="switchTab('tab-detail-booking')" id="btn-tab-detail-booking" class="tab-btn px-5 py-2.5 rounded-xl text-xs font-extrabold tracking-wider uppercase transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 border border-white/5">
            🧾 Detail Booking / Struk
        </button>
    </div>

    <form method="POST" action="{{ route('admin.sport-types.update', $sportType->id) }}" enctype="multipart/form-data" class="space-y-8">
        @csrf
        @method('PUT')

        <!-- TAB 1: HOME (BERANDA) -->
        <div id="tab-home" class="tab-pane space-y-8">
            <!-- Informasi Utama & Hero Section -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Hero Section Homepage
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

            <!-- Fasilitas Dinamis -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
                <div class="flex items-center justify-between border-b border-white/10 pb-4">
                    <h2 class="text-xl font-bold text-white flex items-center gap-2">
                        <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                        Fasilitas Khusus Sport Type
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

            <!-- Galeri Foto Lapangan & Venue -->
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Galeri Foto Lapangan & Venue
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
        </div>

        <!-- TAB 2: SEJARAH (LEGACY) -->
        <div id="tab-sejarah" class="tab-pane hidden space-y-6">
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"></path></svg>
                    Halaman Sejarah & Profil Venue
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Sub Judul Header</label>
                        <input type="text" name="sections[sejarah][header_subtitle]" value="{{ old('sections.sejarah.header_subtitle', $sportType->getSectionValue('sejarah', 'header_subtitle', 'Since 2009')) }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none" placeholder="Contoh: Since 2009">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Judul Header (Bisa gunakan tag HTML span warna)</label>
                        <input type="text" name="sections[sejarah][header_title]" value="{{ old('sections.sejarah.header_title', $sportType->getSectionValue('sejarah', 'header_title', 'Our <span class=\"text-green-400\">Legacy</span>')) }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none" placeholder="Contoh: Our <span class='text-green-400'>Legacy</span>">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Foto Profil Utama Venue</label>
                    @if($sportType->getSectionImage('sejarah', 'profile_image'))
                        <div class="mb-3 flex items-center gap-4">
                            <img src="{{ asset($sportType->getSectionImage('sejarah', 'profile_image')) }}" alt="Profile Image" class="w-36 h-20 object-cover rounded-xl border border-white/10">
                            <span class="text-xs text-gray-400">Foto profil sejarah saat ini. Unggah file baru untuk memperbarui.</span>
                        </div>
                    @endif
                    <input type="file" name="section_images[sejarah][profile_image]" accept="image/*" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-gray-400 text-sm focus:border-green-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-xs file:font-bold file:bg-green-500 file:text-black hover:file:bg-green-400">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Isi Cerita / Body Sejarah (Format Paragraf / Rich Text)</label>
                    <textarea name="sections[sejarah][body_text]" rows="10" class="w-full font-mono bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none leading-relaxed">{{ old('sections.sejarah.body_text', $sportType->getSectionValue('sejarah', 'body_text')) }}</textarea>
                    <p class="text-xs text-gray-500 mt-1">Dapat menggunakan tag HTML seperti &lt;h2&gt;, &lt;p&gt;, dan &lt;blockquote&gt; untuk styling yang rapi.</p>
                </div>
            </div>
        </div>

        <!-- TAB 3: CARA BOOKING -->
        <div id="tab-cara-booking" class="tab-pane hidden space-y-6">
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path></svg>
                    Halaman Tata Cara Booking
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Badge Atas</label>
                        <input type="text" name="sections[cara_booking][hero_badge]" value="{{ old('sections.cara_booking.hero_badge', $sportType->getSectionValue('cara_booking', 'hero_badge', 'Panduan Lengkap')) }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Judul Hero</label>
                        <input type="text" name="sections[cara_booking][hero_title]" value="{{ old('sections.cara_booking.hero_title', $sportType->getSectionValue('cara_booking', 'hero_title', 'Tata Cara <span class=\"gradient-text\">Booking</span>')) }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Sub Judul / Pengantar</label>
                    <textarea name="sections[cara_booking][hero_subtitle]" rows="2" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none">{{ old('sections.cara_booking.hero_subtitle', $sportType->getSectionValue('cara_booking', 'hero_subtitle')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Teks Call-to-Action WhatsApp / Customer Service</label>
                    <textarea name="sections[cara_booking][contact_cta_text]" rows="2" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none">{{ old('sections.cara_booking.contact_cta_text', $sportType->getSectionValue('cara_booking', 'contact_cta_text')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- TAB 4: FORM BOOKING -->
        <div id="tab-booking" class="tab-pane hidden space-y-6">
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                    Halaman Form Reservasi Lapangan
                </h2>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Badge Form</label>
                        <input type="text" name="sections[booking][page_badge]" value="{{ old('sections.booking.page_badge', $sportType->getSectionValue('booking', 'page_badge', 'Reservasi Lapangan')) }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none">
                    </div>

                    <div>
                        <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Teks Tombol Submit (Tamu)</label>
                        <input type="text" name="sections[booking][cta_button_text]" value="{{ old('sections.booking.cta_button_text', $sportType->getSectionValue('booking', 'cta_button_text', 'Lanjutkan ke Pembayaran')) }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Catatan Kebijakan / Aturan Main (Ditampilkan di atas tombol submit)</label>
                    <textarea name="sections[booking][policy_note]" rows="3" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none" placeholder="Contoh: Wajib menggunakan sepatu khusus. Dilarang merokok di area arena lapangan.">{{ old('sections.booking.policy_note', $sportType->getSectionValue('booking', 'policy_note')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- TAB 5: DETAIL BOOKING / STRUK -->
        <div id="tab-detail-booking" class="tab-pane hidden space-y-6">
            <div class="bg-white/5 border border-white/10 rounded-3xl p-6 sm:p-8 space-y-6">
                <h2 class="text-xl font-bold text-white flex items-center gap-2 border-b border-white/10 pb-4">
                    <svg class="w-5 h-5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"></path></svg>
                    Halaman Detail Booking & Invoice
                </h2>

                <div class="p-4 bg-blue-500/10 border border-blue-500/20 rounded-2xl text-xs text-blue-300 leading-relaxed">
                    ℹ️ <strong>Integritas Data Terlindungi:</strong> Informasi jadwal, nama pemesan, harga total, dan kode booking bersifat transaksional murni dari sistem. Yang dapat diedit di bawah ini hanyalah teks judul, catatan ketentuan, dan pesan follow-up bantuan.
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Judul Header Struk / Invoice</label>
                    <input type="text" name="sections[booking_detail][header_title]" value="{{ old('sections.booking_detail.header_title', $sportType->getSectionValue('booking_detail', 'header_title', 'Detail Booking')) }}" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none" placeholder="Contoh: Detail Booking / Detail Reservasi Padel">
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Catatan Kaki Reservasi (Aturan Datang / Check-in)</label>
                    <textarea name="sections[booking_detail][footer_note]" rows="3" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none" placeholder="Contoh: Harap tunjukkan bukti booking ini atau sebutkan kode booking kepada staf kasir saat tiba di lokasi.">{{ old('sections.booking_detail.footer_note', $sportType->getSectionValue('booking_detail', 'footer_note')) }}</textarea>
                </div>

                <div>
                    <label class="block text-xs font-bold uppercase tracking-wider text-gray-400 mb-2">Teks Bantuan Customer Service (WA CTA)</label>
                    <textarea name="sections[booking_detail][wa_cta_text]" rows="2" class="w-full bg-black/40 border border-white/10 rounded-xl px-4 py-3 text-white text-sm focus:border-green-500 outline-none" placeholder="Contoh: Ada kendala dengan booking Anda? Hubungi CS kami.">{{ old('sections.booking_detail.wa_cta_text', $sportType->getSectionValue('booking_detail', 'wa_cta_text')) }}</textarea>
                </div>
            </div>
        </div>

        <!-- Submit Button Bottom Bar -->
        <div class="sticky bottom-6 z-20 p-4 bg-[#0a0a0a]/90 backdrop-blur-xl border border-white/10 rounded-2xl flex items-center justify-between shadow-2xl">
            <div class="text-xs text-gray-400">
                Menyimpan seluruh perubahan tab untuk: <strong class="text-white">{{ $sportType->name }}</strong>
            </div>
            <div class="flex items-center gap-3">
                @if(Auth::user()->isDeveloper())
                    <a href="{{ route('admin.sport-types.index') }}" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-white font-bold text-xs rounded-xl transition-all border border-white/10">Batal</a>
                @else
                    <a href="{{ route('admin.dashboard') }}" class="px-5 py-2.5 bg-white/5 hover:bg-white/10 text-white font-bold text-xs rounded-xl transition-all border border-white/10">Batal</a>
                @endif
                <button type="submit" class="px-8 py-3 bg-green-500 hover:bg-green-400 text-black font-extrabold text-sm rounded-xl transition-all shadow-lg shadow-green-500/20">
                    Simpan Semua Perubahan Konten
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    function switchTab(tabId) {
        // Hide all panes
        document.querySelectorAll('.tab-pane').forEach(el => el.classList.add('hidden'));
        
        // Reset button states
        document.querySelectorAll('.tab-btn').forEach(btn => {
            btn.className = 'tab-btn px-5 py-2.5 rounded-xl text-xs font-extrabold tracking-wider uppercase transition-all bg-white/5 text-gray-400 hover:text-white hover:bg-white/10 border border-white/5';
        });

        // Show target pane
        const target = document.getElementById(tabId);
        if (target) {
            target.classList.remove('hidden');
        }

        // Activate button
        const activeBtn = document.getElementById('btn-' + tabId);
        if (activeBtn) {
            activeBtn.className = 'tab-btn px-5 py-2.5 rounded-xl text-xs font-extrabold tracking-wider uppercase transition-all bg-green-500 text-black shadow-lg shadow-green-500/20';
        }

        // Save active tab in hash
        history.replaceState(null, null, '#' + tabId);
    }

    // Restore active tab from hash if present
    document.addEventListener('DOMContentLoaded', () => {
        const hash = window.location.hash.replace('#', '');
        if (hash && document.getElementById(hash)) {
            switchTab(hash);
        }
    });

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
