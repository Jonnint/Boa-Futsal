<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cara Booking - BOA Futsal</title>
    <meta name="description" content="Panduan lengkap cara booking lapangan futsal di BOA Futsal. Bisa booking tanpa login atau daftar jadi member untuk keuntungan eksklusif.">
    <link rel="icon" type="image/jpeg" href="{{ asset('asset/img/favicon.jpg') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800;900&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }

        ::-webkit-scrollbar { width: 5px; }
        ::-webkit-scrollbar-track { background: #050505; }
        ::-webkit-scrollbar-thumb { background: rgba(74,222,128,0.4); border-radius: 99px; }

        .step-line::before {
            content: '';
            position: absolute;
            left: 23px;
            top: 56px;
            width: 2px;
            height: calc(100% - 16px);
            background: linear-gradient(to bottom, rgba(74,222,128,0.5), rgba(74,222,128,0.05));
        }

        @keyframes pulse-glow {
            0%, 100% { box-shadow: 0 0 20px rgba(74,222,128,0.2); }
            50% { box-shadow: 0 0 40px rgba(74,222,128,0.5); }
        }
        .glow-pulse { animation: pulse-glow 3s ease-in-out infinite; }

        @keyframes float {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-8px); }
        }
        .float-anim { animation: float 4s ease-in-out infinite; }

        .gradient-text {
            background: linear-gradient(135deg, #4ade80, #22d3ee);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .tab-active {
            background: linear-gradient(135deg, rgba(74,222,128,0.2), rgba(74,222,128,0.05));
            border-color: rgba(74,222,128,0.5) !important;
            color: #4ade80 !important;
        }

        @keyframes shine {
            0% { transform: translateX(-100%) skewX(-15deg); }
            100% { transform: translateX(200%) skewX(-15deg); }
        }
        .badge-shine::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent);
            animation: shine 2.5s infinite;
        }

        .benefit-card {
            transition: all 0.3s ease;
        }
        .benefit-card:hover {
            transform: translateY(-4px);
            border-color: rgba(74,222,128,0.4) !important;
            box-shadow: 0 20px 40px rgba(74,222,128,0.1);
        }

        .step-num { background: linear-gradient(135deg, #4ade80, #16a34a); }
        .step-num-yellow { background: linear-gradient(135deg, #facc15, #ca8a04); }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black">

    <x-public-navbar :simple="true" backUrl="/" backText="← Kembali ke Beranda" />

    <!-- Hero Section -->
    <section class="relative min-h-[55vh] flex items-center justify-center pt-28 pb-20 overflow-hidden">
        <div class="absolute inset-0 z-0 pointer-events-none">
            <div class="absolute top-0 left-1/2 -translate-x-1/2 w-[800px] h-[400px] bg-green-500/10 rounded-full blur-[120px]"></div>
            <div class="absolute bottom-0 right-0 w-96 h-96 bg-green-900/15 rounded-full blur-[100px]"></div>
            <div class="absolute inset-0 opacity-[0.03]" style="background-image: linear-gradient(rgba(74,222,128,1) 1px, transparent 1px), linear-gradient(90deg, rgba(74,222,128,1) 1px, transparent 1px); background-size: 50px 50px;"></div>
        </div>

        <div class="container mx-auto px-6 z-10 relative text-center">
            <div class="inline-flex items-center gap-2 px-4 py-2 bg-green-500/10 border border-green-500/30 rounded-full mb-6 relative overflow-hidden badge-shine">
                <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                <span class="text-green-400 text-sm font-bold uppercase tracking-widest">Panduan Lengkap</span>
            </div>

            <h1 class="text-5xl md:text-7xl font-extrabold leading-[1.1] tracking-tight mb-6">
                Tata Cara <span class="gradient-text">Booking</span>
            </h1>
            <p class="text-gray-400 text-base md:text-lg max-w-2xl mx-auto leading-relaxed font-medium">
                Pesan lapangan futsal BOA dalam hitungan menit. Tersedia dua pilihan — langsung booking tanpa akun, atau daftar member untuk nikmati keuntungan eksklusif.
            </p>

            <div class="flex flex-wrap justify-center gap-3 mt-10">
                <button id="btn-tamu" onclick="switchSection('tamu')"
                   class="tab-btn tab-active px-6 py-3 rounded-full border border-white/10 text-sm font-bold text-gray-300 hover:text-white transition-all duration-300 cursor-pointer">
                    🎯 Booking Tanpa Login
                </button>
                <button id="btn-member" onclick="switchSection('member')"
                   class="tab-btn px-6 py-3 rounded-full border border-white/10 text-sm font-bold text-gray-300 hover:text-white transition-all duration-300 cursor-pointer">
                    ⭐ Jadi Member
                </button>
            </div>
        </div>
    </section>

    <!-- Main Content -->
    <div class="container mx-auto px-6 pb-24 max-w-5xl">

        <!-- ===== SECTION 1: BOOKING TANPA LOGIN ===== -->
        <section id="booking-tamu" class="mb-24">

            <div class="flex items-center gap-4 mb-12">
                <div class="w-14 h-14 bg-green-500/10 border border-green-500/30 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 glow-pulse">🎯</div>
                <div>
                    <p class="text-green-400 text-xs font-bold uppercase tracking-widest mb-1">Opsi 1</p>
                    <h2 class="text-3xl md:text-4xl font-extrabold">Booking Tanpa Login</h2>
                </div>
                <div class="ml-auto hidden sm:block">
                    <span class="px-4 py-1.5 bg-blue-500/10 border border-blue-500/20 text-blue-400 text-xs font-bold rounded-full uppercase tracking-wider">Cepat & Mudah</span>
                </div>
            </div>

            <div class="p-5 bg-blue-500/5 border border-blue-500/20 rounded-2xl mb-12 flex items-start gap-4">
                <div class="w-10 h-10 bg-blue-500/10 rounded-xl flex items-center justify-center flex-shrink-0">
                    <svg class="w-5 h-5 text-blue-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-blue-300 font-bold text-sm mb-1">Tidak perlu buat akun!</p>
                    <p class="text-gray-400 text-sm leading-relaxed">Kamu bisa langsung memesan lapangan tanpa harus login atau mendaftar. Cukup isi data diri dan lakukan pembayaran. Simpel!</p>
                </div>
            </div>

            <!-- Steps -->
            <div class="space-y-6">

                <!-- Step 1 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(74,222,128,0.3)]">1</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-green-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Buka Halaman Utama & Pilih Lapangan</h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                    Kunjungi <span class="text-green-400 font-bold">boafutsal.com</span> lalu scroll ke bagian <strong class="text-white">"Pilih Arena Kamu"</strong>. Lihat daftar lapangan beserta status real-time.
                                </p>
                                <div class="flex flex-wrap gap-3">
                                    <div class="flex items-center gap-2 px-3 py-1.5 bg-green-500/10 border border-green-500/20 rounded-lg">
                                        <span class="w-2 h-2 bg-green-400 rounded-full animate-pulse"></span>
                                        <span class="text-green-400 text-xs font-bold">Tersedia Sekarang</span>
                                    </div>
                                    <div class="flex items-center gap-2 px-3 py-1.5 bg-red-500/10 border border-red-500/20 rounded-lg">
                                        <span class="w-2 h-2 bg-red-400 rounded-full"></span>
                                        <span class="text-red-400 text-xs font-bold">Sedang Dipakai</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(74,222,128,0.3)]">2</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-green-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Cek Detail Harga</h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                    Klik tombol <strong class="text-white">"Detail Harga"</strong> pada lapangan pilihanmu. Modal akan menampilkan harga per sesi berdasarkan hari.
                                </p>
                                <div class="rounded-xl overflow-hidden border border-white/10">
                                    <div class="bg-white/5 px-4 py-2 border-b border-white/10">
                                        <p class="text-xs font-bold text-gray-400 uppercase tracking-wider">Contoh Harga</p>
                                    </div>
                                    <div class="divide-y divide-white/5">
                                        <div class="flex items-center justify-between px-4 py-3">
                                            <div>
                                                <p class="text-[10px] text-gray-500 uppercase tracking-wider font-bold">Sesi Pagi — Senin s/d Jumat</p>
                                                <p class="text-sm text-gray-200">06:00 – 12:00 WIB</p>
                                            </div>
                                            <p class="text-sm font-extrabold text-white">Rp 80.000<span class="text-gray-500 font-normal text-xs"> / Jam</span></p>
                                        </div>
                                        <div class="flex items-center justify-between px-4 py-3">
                                            <div>
                                                <p class="text-[10px] text-gray-500 uppercase tracking-wider font-bold">Sesi Malam — Sabtu & Minggu</p>
                                                <p class="text-sm text-gray-200">18:00 – 23:00 WIB</p>
                                            </div>
                                            <p class="text-sm font-extrabold text-white">Rp 110.000<span class="text-gray-500 font-normal text-xs"> / Jam</span></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(74,222,128,0.3)]">3</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-green-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Klik "Booking Sekarang"</h3>
                                <p class="text-gray-400 text-sm leading-relaxed">
                                    Setelah cek harga, klik tombol <span class="text-black bg-green-500 px-2 py-0.5 rounded-lg text-xs font-extrabold">BOOKING SEKARANG</span>. Kamu akan diarahkan ke halaman form pemesanan.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 4 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(74,222,128,0.3)]">4</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-green-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Isi Formulir Pemesanan</h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-5">Lengkapi data yang diperlukan pada form booking:</p>
                                <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                                    <div class="flex items-start gap-3 p-3 bg-black/30 rounded-xl border border-white/5">
                                        <span class="text-xl">👤</span>
                                        <div>
                                            <p class="text-sm font-bold text-white">Nama Lengkap</p>
                                            <p class="text-xs text-gray-500">Nama pemesan</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 bg-black/30 rounded-xl border border-white/5">
                                        <span class="text-xl">📱</span>
                                        <div>
                                            <p class="text-sm font-bold text-white">Nomor WhatsApp</p>
                                            <p class="text-xs text-gray-500">Untuk konfirmasi booking</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 bg-black/30 rounded-xl border border-white/5">
                                        <span class="text-xl">📅</span>
                                        <div>
                                            <p class="text-sm font-bold text-white">Tanggal Main</p>
                                            <p class="text-xs text-gray-500">Pilih tanggal yang diinginkan</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 bg-black/30 rounded-xl border border-white/5">
                                        <span class="text-xl">⏰</span>
                                        <div>
                                            <p class="text-sm font-bold text-white">Jam Mulai & Selesai</p>
                                            <p class="text-xs text-gray-500">Slot waktu yang tersedia</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 bg-black/30 rounded-xl border border-white/5">
                                        <span class="text-xl">🏟️</span>
                                        <div>
                                            <p class="text-sm font-bold text-white">Lapangan</p>
                                            <p class="text-xs text-gray-500">Otomatis terisi sesuai pilihan</p>
                                        </div>
                                    </div>
                                    <div class="flex items-start gap-3 p-3 bg-black/30 rounded-xl border border-white/5">
                                        <span class="text-xl">🎟️</span>
                                        <div>
                                            <p class="text-sm font-bold text-white">Kode Voucher</p>
                                            <p class="text-xs text-gray-500">Opsional, jika punya voucher</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 5 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(74,222,128,0.3)]">5</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-green-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Pilih Metode Pembayaran & Konfirmasi</h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                    Tinjau ringkasan pesanan (lapangan, tanggal, jam, total harga). Pilih metode pembayaran dan klik <strong class="text-white">Konfirmasi Booking</strong>.
                                </p>
                                <div class="flex flex-wrap gap-2">
                                    <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-medium text-gray-300">💳 Transfer Bank</span>
                                    <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-medium text-gray-300">📲 QRIS</span>
                                    <span class="px-3 py-1.5 bg-white/5 border border-white/10 rounded-lg text-xs font-medium text-gray-300">💵 Bayar di Tempat</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 6 - Final -->
                <div class="flex gap-5">
                    <div class="w-12 h-12 step-num rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(74,222,128,0.3)]">6</div>
                    <div class="flex-1">
                        <div class="bg-gradient-to-br from-green-500/10 to-green-900/10 border border-green-500/30 rounded-2xl p-6">
                            <h3 class="text-xl font-extrabold mb-2 text-white">Selesai! Tunggu Konfirmasi</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Booking kamu sudah masuk! Admin akan mengonfirmasi via <strong class="text-green-400">WhatsApp</strong> yang kamu daftarkan. Tunjukkan bukti konfirmasi saat tiba di lapangan.
                            </p>
                            <div class="mt-4 flex items-center gap-2 text-green-400 text-sm font-bold">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                Konfirmasi dikirim via WhatsApp
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-12 text-center">
                <a href="{{ url('/') }}#fields" class="inline-flex items-center gap-3 px-8 py-4 bg-green-500 text-black font-bold text-sm tracking-widest uppercase transition-all hover:bg-green-400 hover:shadow-[0_0_30px_rgba(34,197,94,0.4)] rounded-full">
                    <span class="w-3 h-3 rounded-full bg-black"></span>
                    Mulai Booking Sekarang
                </a>
                <p class="text-gray-600 text-xs mt-3">Tidak perlu buat akun. Langsung pesan!</p>
            </div>
        </section>

        <!-- Divider -->
        <div class="relative my-4 mb-20">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-white/5"></div>
            </div>
            <div class="relative flex justify-center">
                <span class="bg-[#050505] px-6 text-gray-600 text-sm font-medium">atau</span>
            </div>
        </div>

        <!-- ===== SECTION 2: JOIN MEMBER ===== -->
        <section id="join-member" class="mb-16">

            <div class="flex items-center gap-4 mb-12">
                <div class="w-14 h-14 bg-yellow-500/10 border border-yellow-500/30 rounded-2xl flex items-center justify-center text-2xl flex-shrink-0 float-anim">⭐</div>
                <div>
                    <p class="text-yellow-400 text-xs font-bold uppercase tracking-widest mb-1">Opsi 2</p>
                    <h2 class="text-3xl md:text-4xl font-extrabold">Daftar Jadi Member</h2>
                </div>
                <div class="ml-auto hidden sm:block">
                    <span class="px-4 py-1.5 bg-yellow-500/10 border border-yellow-500/20 text-yellow-400 text-xs font-bold rounded-full uppercase tracking-wider">Keuntungan Lebih</span>
                </div>
            </div>

            <!-- Member Benefits -->
            <div class="mb-12">
                <h3 class="text-xl font-extrabold mb-6 text-white">Kenapa Harus Jadi Member? 🏆</h3>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                    <div class="benefit-card bg-white/[0.03] border border-white/10 rounded-2xl p-5 cursor-default">
                        <div class="text-3xl mb-3">💰</div>
                        <h4 class="font-extrabold text-white text-sm mb-2">Harga Member Spesial</h4>
                        <p class="text-gray-500 text-xs leading-relaxed">Dapatkan tarif khusus yang lebih hemat untuk semua sesi booking</p>
                    </div>
                    <div class="benefit-card bg-white/[0.03] border border-white/10 rounded-2xl p-5 cursor-default">
                        <div class="text-3xl mb-3">🎟️</div>
                        <h4 class="font-extrabold text-white text-sm mb-2">Akses Voucher Eksklusif</h4>
                        <p class="text-gray-500 text-xs leading-relaxed">Nikmati voucher diskon yang hanya tersedia untuk member BOA Futsal</p>
                    </div>
                    <div class="benefit-card bg-white/[0.03] border border-white/10 rounded-2xl p-5 cursor-default">
                        <div class="text-3xl mb-3">📊</div>
                        <h4 class="font-extrabold text-white text-sm mb-2">Riwayat Booking</h4>
                        <p class="text-gray-500 text-xs leading-relaxed">Pantau semua histori pemesanan lapangan kamu dari dashboard personal</p>
                    </div>
                    <div class="benefit-card bg-white/[0.03] border border-white/10 rounded-2xl p-5 cursor-default">
                        <div class="text-3xl mb-3">🔔</div>
                        <h4 class="font-extrabold text-white text-sm mb-2">Notifikasi Prioritas</h4>
                        <p class="text-gray-500 text-xs leading-relaxed">Terima notifikasi promo, jadwal, dan info terbaru lebih awal</p>
                    </div>
                    <div class="benefit-card bg-white/[0.03] border border-white/10 rounded-2xl p-5 cursor-default">
                        <div class="text-3xl mb-3">⚡</div>
                        <h4 class="font-extrabold text-white text-sm mb-2">Proses Booking Lebih Cepat</h4>
                        <p class="text-gray-500 text-xs leading-relaxed">Data tersimpan, booking berikutnya makin praktis tanpa isi ulang</p>
                    </div>
                    <div class="benefit-card bg-white/[0.03] border border-white/10 rounded-2xl p-5 cursor-default">
                        <div class="text-3xl mb-3">🏅</div>
                        <h4 class="font-extrabold text-white text-sm mb-2">Status Member Eksklusif</h4>
                        <p class="text-gray-500 text-xs leading-relaxed">Badge member di profil dan akses fitur spesial yang terus berkembang</p>
                    </div>
                </div>
            </div>

            <!-- Member Steps -->
            <h3 class="text-xl font-extrabold mb-8 text-white">Langkah-langkah Daftar Member</h3>
            <div class="space-y-6">

                <!-- Member Step 1 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num-yellow rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(234,179,8,0.3)]">1</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-yellow-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Buat Akun BOA Futsal</h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                    Klik <strong class="text-white">"Login"</strong> di navbar lalu pilih <strong class="text-white">"Daftar Sekarang"</strong>. Isi data berikut:
                                </p>
                                <div class="grid grid-cols-2 gap-2">
                                    <div class="flex items-center gap-2 text-xs text-gray-400 bg-black/30 px-3 py-2 rounded-lg border border-white/5">
                                        <svg class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                                        Nama Lengkap
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-400 bg-black/30 px-3 py-2 rounded-lg border border-white/5">
                                        <svg class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                                        Email Aktif
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-400 bg-black/30 px-3 py-2 rounded-lg border border-white/5">
                                        <svg class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                                        Password
                                    </div>
                                    <div class="flex items-center gap-2 text-xs text-gray-400 bg-black/30 px-3 py-2 rounded-lg border border-white/5">
                                        <svg class="w-3.5 h-3.5 text-yellow-400 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4"/></svg>
                                        Nomor WhatsApp
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Step 2 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num-yellow rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(234,179,8,0.3)]">2</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-yellow-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Verifikasi Email</h3>
                                <p class="text-gray-400 text-sm leading-relaxed">
                                    Setelah mendaftar, cek inbox emailmu. Klik link verifikasi yang dikirimkan oleh BOA Futsal untuk mengaktifkan akunmu. Cek folder <strong class="text-white">spam</strong> jika email tidak masuk.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Step 3 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num-yellow rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(234,179,8,0.3)]">3</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-yellow-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Bayar Biaya Membership</h3>
                                <p class="text-gray-400 text-sm leading-relaxed mb-4">
                                    Login ke akun kamu, lalu kamu akan diarahkan ke halaman pembayaran membership. Selesaikan pembayaran dan upload bukti transfer.
                                </p>
                                <div class="bg-gradient-to-br from-yellow-500/10 to-yellow-900/10 border border-yellow-500/20 rounded-xl p-5">
                                    <div class="flex items-center justify-between">
                                        <div>
                                            <p class="text-xs text-gray-500 uppercase tracking-wider font-bold mb-1">Biaya Membership</p>
                                            <p class="text-3xl font-extrabold text-white">Rp 50.000<span class="text-gray-500 font-normal text-sm"> / bulan</span></p>
                                        </div>
                                        <div class="w-14 h-14 bg-yellow-500/20 rounded-2xl flex items-center justify-center text-3xl">🏅</div>
                                    </div>
                                    <div class="mt-4 pt-4 border-t border-yellow-500/10">
                                        <p class="text-xs text-yellow-400 font-medium">✨ Investasi terbaik untuk pemain aktif BOA Futsal!</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Step 4 -->
                <div class="relative step-line">
                    <div class="flex gap-5">
                        <div class="w-12 h-12 step-num-yellow rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(234,179,8,0.3)]">4</div>
                        <div class="flex-1 pb-8">
                            <div class="bg-white/[0.03] border border-white/10 rounded-2xl p-6 hover:border-yellow-500/30 transition-all duration-300">
                                <h3 class="text-xl font-extrabold mb-2 text-white">Tunggu Konfirmasi Admin</h3>
                                <p class="text-gray-400 text-sm leading-relaxed">
                                    Admin akan memverifikasi bukti pembayaran kamu dalam waktu <strong class="text-white">1×24 jam</strong>. Setelah dikonfirmasi, status member kamu aktif dan kamu bisa menikmati semua keuntungan!
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Member Step 5 - Final -->
                <div class="flex gap-5">
                    <div class="w-12 h-12 step-num-yellow rounded-xl flex items-center justify-center text-black font-extrabold text-lg flex-shrink-0 shadow-[0_0_20px_rgba(234,179,8,0.3)]">5</div>
                    <div class="flex-1">
                        <div class="bg-gradient-to-br from-yellow-500/10 to-yellow-900/10 border border-yellow-500/30 rounded-2xl p-6">
                            <h3 class="text-xl font-extrabold mb-2 text-white">Selamat! Kamu Resmi Jadi Member 🎉</h3>
                            <p class="text-gray-400 text-sm leading-relaxed">
                                Akses dashboard personalmu, nikmati harga spesial member, dan manfaatkan semua fitur eksklusif BOA Futsal. Selamat bermain!
                            </p>
                            <div class="mt-4 flex flex-wrap gap-4">
                                <div class="flex items-center gap-2 text-yellow-400 text-xs font-bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Dashboard Personal Aktif
                                </div>
                                <div class="flex items-center gap-2 text-yellow-400 text-xs font-bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Harga Member Berlaku
                                </div>
                                <div class="flex items-center gap-2 text-yellow-400 text-xs font-bold">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/></svg>
                                    Voucher Eksklusif Tersedia
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="mt-12 flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('register') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-gradient-to-r from-yellow-400 to-yellow-600 text-black font-extrabold text-sm tracking-widest uppercase transition-all hover:from-yellow-300 hover:to-yellow-500 hover:shadow-[0_0_30px_rgba(234,179,8,0.4)] rounded-full">
                    <span>⭐</span>
                    Daftar Jadi Member
                </a>
                <a href="{{ route('login') }}" class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-8 py-4 bg-transparent border border-white/20 text-white font-bold text-sm tracking-widest uppercase transition-all hover:border-white/40 hover:bg-white/5 rounded-full">
                    Sudah Punya Akun? Login
                </a>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="mb-16">
            <div class="text-center mb-10">
                <h2 class="text-3xl font-extrabold mb-3">Pertanyaan yang Sering Ditanya</h2>
                <div class="w-16 h-1 bg-green-500 mx-auto rounded-full"></div>
            </div>

            <div class="space-y-3" id="faq-container">
                <div class="faq-item bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/20 transition-all duration-300">
                    <button onclick="toggleFaq(0)" class="w-full flex items-center justify-between px-6 py-5 text-left gap-4">
                        <span class="font-bold text-white text-sm md:text-base">Apakah saya harus login untuk booking?</span>
                        <svg class="w-5 h-5 text-green-400 flex-shrink-0 transition-transform duration-300" id="faq-icon-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden px-6 pb-5 text-gray-400 text-sm leading-relaxed" id="faq-answer-0">
                        Tidak! Kamu bisa booking lapangan tanpa harus login atau membuat akun. Cukup isi data nama dan nomor WhatsApp saat proses pemesanan.
                    </div>
                </div>

                <div class="faq-item bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/20 transition-all duration-300">
                    <button onclick="toggleFaq(1)" class="w-full flex items-center justify-between px-6 py-5 text-left gap-4">
                        <span class="font-bold text-white text-sm md:text-base">Apa perbedaan booking biasa dan booking sebagai member?</span>
                        <svg class="w-5 h-5 text-green-400 flex-shrink-0 transition-transform duration-300" id="faq-icon-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden px-6 pb-5 text-gray-400 text-sm leading-relaxed" id="faq-answer-1">
                        Booking biasa (tanpa login) menggunakan harga regular. Sebagai member, kamu mendapatkan harga spesial yang lebih hemat, akses voucher eksklusif, riwayat booking di dashboard, dan notifikasi prioritas.
                    </div>
                </div>

                <div class="faq-item bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/20 transition-all duration-300">
                    <button onclick="toggleFaq(2)" class="w-full flex items-center justify-between px-6 py-5 text-left gap-4">
                        <span class="font-bold text-white text-sm md:text-base">Berapa lama proses konfirmasi booking?</span>
                        <svg class="w-5 h-5 text-green-400 flex-shrink-0 transition-transform duration-300" id="faq-icon-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden px-6 pb-5 text-gray-400 text-sm leading-relaxed" id="faq-answer-2">
                        Admin akan mengonfirmasi booking kamu melalui WhatsApp dalam waktu 1–2 jam. Untuk jam malam dan hari libur, konfirmasi bisa membutuhkan waktu lebih lama.
                    </div>
                </div>

                <div class="faq-item bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/20 transition-all duration-300">
                    <button onclick="toggleFaq(3)" class="w-full flex items-center justify-between px-6 py-5 text-left gap-4">
                        <span class="font-bold text-white text-sm md:text-base">Bagaimana cara membatalkan booking?</span>
                        <svg class="w-5 h-5 text-green-400 flex-shrink-0 transition-transform duration-300" id="faq-icon-3" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden px-6 pb-5 text-gray-400 text-sm leading-relaxed" id="faq-answer-3">
                        Silakan hubungi admin via WhatsApp atau telepon secepatnya. Kebijakan pembatalan berlaku sesuai ketentuan yang berlaku di BOA Futsal.
                    </div>
                </div>

                <div class="faq-item bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/20 transition-all duration-300">
                    <button onclick="toggleFaq(4)" class="w-full flex items-center justify-between px-6 py-5 text-left gap-4">
                        <span class="font-bold text-white text-sm md:text-base">Apakah biaya membership bisa dikembalikan?</span>
                        <svg class="w-5 h-5 text-green-400 flex-shrink-0 transition-transform duration-300" id="faq-icon-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden px-6 pb-5 text-gray-400 text-sm leading-relaxed" id="faq-answer-4">
                        Biaya membership bersifat non-refundable. Namun kamu bisa menikmati semua manfaat membership selama masa berlaku aktif.
                    </div>
                </div>

                <div class="faq-item bg-white/[0.03] border border-white/10 rounded-2xl overflow-hidden hover:border-green-500/20 transition-all duration-300">
                    <button onclick="toggleFaq(5)" class="w-full flex items-center justify-between px-6 py-5 text-left gap-4">
                        <span class="font-bold text-white text-sm md:text-base">Berapa lama masa berlaku membership?</span>
                        <svg class="w-5 h-5 text-green-400 flex-shrink-0 transition-transform duration-300" id="faq-icon-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"/></svg>
                    </button>
                    <div class="hidden px-6 pb-5 text-gray-400 text-sm leading-relaxed" id="faq-answer-5">
                        Membership berlaku selama 1 bulan sejak tanggal aktivasi. Kamu bisa memperpanjang kapan saja melalui halaman payment membership di dashboard.
                    </div>
                </div>
            </div>
        </section>

        <!-- Still have questions -->
        <div class="bg-gradient-to-br from-green-500/10 via-green-900/10 to-transparent border border-green-500/20 rounded-3xl p-8 md:p-12 text-center">
            <div class="text-4xl mb-4">💬</div>
            <h3 class="text-2xl font-extrabold mb-3">Masih Ada Pertanyaan?</h3>
            <p class="text-gray-400 text-sm max-w-md mx-auto mb-8 leading-relaxed">
                Tim BOA Futsal siap membantu kamu 7 hari seminggu. Hubungi kami via WhatsApp atau kunjungi halaman kontak.
            </p>
            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="https://wa.me/yournumber" target="_blank"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-7 py-3.5 bg-green-500 text-black font-extrabold text-sm rounded-full hover:bg-green-400 transition-all hover:shadow-[0_0_25px_rgba(74,222,128,0.4)]">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L0 24l6.335-1.662c1.72.94 3.659 1.437 5.634 1.437h.005c6.558 0 11.894-5.335 11.897-11.893a11.821 11.821 0 00-3.48-8.413Z"/>
                    </svg>
                    Chat WhatsApp
                </a>
                <a href="{{ url('/') }}#contact"
                   class="w-full sm:w-auto inline-flex items-center justify-center gap-3 px-7 py-3.5 bg-white/5 border border-white/10 text-white font-bold text-sm rounded-full hover:border-white/30 hover:bg-white/10 transition-all">
                    Halaman Kontak
                </a>
            </div>
        </div>
    </div>

    <!-- Footer mini -->
    <footer class="border-t border-white/5 py-8 text-center">
        <p class="text-gray-600 text-sm">&copy; {{ date('Y') }} <span class="text-green-400 font-bold">BOA Futsal</span>. All rights reserved.</p>
    </footer>

    <script>
        function switchSection(section) {
            const btnTamu = document.getElementById('btn-tamu');
            const btnMember = document.getElementById('btn-member');

            if (section === 'tamu') {
                btnTamu.classList.add('tab-active');
                btnMember.classList.remove('tab-active');
            } else {
                btnMember.classList.add('tab-active');
                btnTamu.classList.remove('tab-active');
            }
        }

        function toggleFaq(index) {
            const answer = document.getElementById('faq-answer-' + index);
            const icon = document.getElementById('faq-icon-' + index);
            if (answer.classList.contains('hidden')) {
                answer.classList.remove('hidden');
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.classList.add('hidden');
                icon.style.transform = 'rotate(0deg)';
            }
        }

        const sections = ['booking-tamu', 'join-member'];
        window.addEventListener('scroll', () => {
            let current = '';
            sections.forEach(id => {
                const el = document.getElementById(id);
                if (el && window.scrollY >= el.offsetTop - 200) current = id;
            });
            if (current === 'booking-tamu') switchSection('tamu');
            else if (current === 'join-member') switchSection('member');
        });
    </script>
</body>
</html>
