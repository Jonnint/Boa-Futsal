<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Member - BOA Futsal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glow-green { box-shadow: 0 0 20px rgba(74, 222, 128, 0.15); }
        .radio-custom:checked + label {
            border-color: #4ade80;
            background-color: rgba(74, 222, 128, 0.1);
        }
        .radio-custom:checked + label .check-icon {
            opacity: 1;
        }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black min-h-screen relative pb-12">

    <!-- Notification Bell -->
    <x-notification-bell />

    <!-- Background Effects -->
    <div class="fixed top-0 -left-20 w-96 h-96 bg-green-600/10 rounded-full blur-[120px] pointer-events-none"></div>
    <div class="fixed bottom-0 -right-20 w-96 h-96 bg-green-900/10 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-4xl mx-auto pt-12 px-6 relative z-10">
        <!-- Logo/Brand -->
        <div class="text-center mb-10">
            <a href="/" class="inline-block">
                <h1 class="text-4xl font-extrabold tracking-tighter text-green-400">
                    BOA<span class="text-white">FUTSAL</span>
                </h1>
            </a>
            <p class="text-gray-400 mt-2 text-lg">Selesaikan Pembayaran Member Anda</p>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-5 gap-8">
            
            <!-- Left Column: Biodata & Detail -->
            <div class="lg:col-span-3 space-y-6">
                <!-- Biodata Customer -->
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-6 glow-green">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
                        </svg>
                        Biodata Customer
                    </h2>
                    
                    <div class="space-y-4">
                        <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex justify-between items-center">
                            <span class="text-gray-400">Nama Lengkap</span>
                            <span class="font-semibold text-white">{{ auth()->user()->name }}</span>
                        </div>
                        <div class="bg-black/40 border border-white/5 rounded-xl p-4 flex justify-between items-center">
                            <span class="text-gray-400">Email</span>
                            <span class="font-semibold text-white">{{ auth()->user()->email }}</span>
                        </div>
                    </div>
                </div>
                
                <!-- Opsi Pembayaran -->
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-6 glow-green">
                    <h2 class="text-xl font-bold text-white mb-6 flex items-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 10h18M7 15h1m4 0h1m-7 4h12a3 3 0 003-3V8a3 3 0 00-3-3H6a3 3 0 00-3 3v8a3 3 0 003 3z" />
                        </svg>
                        Metode Pembayaran
                    </h2>

                    <form action="{{ route('payment.member.process') }}" method="POST" id="paymentForm" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Pilih Tier -->
                        <div class="mb-6 p-6 bg-gradient-to-br from-green-500/10 to-green-600/5 border border-green-500/20 rounded-2xl">
                            <h3 class="text-lg font-bold text-white mb-4">Pilih Paket Membership</h3>
                            <div class="space-y-3">
                                <label class="flex items-center justify-between p-4 bg-black/40 border border-white/10 rounded-xl cursor-pointer hover:border-green-400/50 transition-all has-[:checked]:border-green-500 has-[:checked]:bg-green-500/10">
                                    <div>
                                        <p class="font-bold text-white">Regular Member</p>
                                        <p class="text-xs text-gray-400">Diskon 10% setiap booking</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-lg font-bold text-green-400">Rp 150.000</span>
                                        <input type="radio" name="membership_tier" value="regular" class="w-5 h-5" checked>
                                    </div>
                                </label>
                                
                                <label class="flex items-center justify-between p-4 bg-black/40 border border-white/10 rounded-xl cursor-pointer hover:border-green-400/50 transition-all has-[:checked]:border-green-500 has-[:checked]:bg-green-500/10">
                                    <div>
                                        <p class="font-bold text-white flex items-center gap-2">
                                            VIP Member
                                            <span class="px-2 py-0.5 bg-yellow-500 text-black text-xs rounded-full">HOT</span>
                                        </p>
                                        <p class="text-xs text-gray-400">Diskon 15% + Priority Booking</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-lg font-bold text-green-400">Rp 250.000</span>
                                        <input type="radio" name="membership_tier" value="vip" class="w-5 h-5">
                                    </div>
                                </label>
                                
                                <label class="flex items-center justify-between p-4 bg-black/40 border border-white/10 rounded-xl cursor-pointer hover:border-green-400/50 transition-all has-[:checked]:border-green-500 has-[:checked]:bg-green-500/10">
                                    <div>
                                        <p class="font-bold text-white flex items-center gap-2">
                                            VVIP Member
                                            <span class="px-2 py-0.5 bg-purple-500 text-white text-xs rounded-full">PREMIUM</span>
                                        </p>
                                        <p class="text-xs text-gray-400">Diskon 20% + Free Drink + Locker</p>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="text-lg font-bold text-green-400">Rp 500.000</span>
                                        <input type="radio" name="membership_tier" value="vvip" class="w-5 h-5">
                                    </div>
                                </label>
                            </div>
                        </div>
                        
                        <div class="space-y-3">
                            <!-- BCA -->
                            <div class="relative">
                                <input type="radio" name="payment_method" value="BCA" id="bca" class="peer hidden radio-custom" checked>
                                <label for="bca" class="flex items-center justify-between p-4 bg-black/40 border border-white/10 rounded-xl cursor-pointer hover:border-green-400/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-8 bg-white rounded flex items-center justify-center p-1">
                                        <span class="text-blue-700 font-black text-xs">BCA</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">BCA Virtual Account</p>
                                        <p class="text-xs text-gray-400">No. Rek: <span class="font-mono text-green-400 font-bold">092819281</span></p>
                                    </div>
                                </div>
                                <div class="check-icon opacity-0 w-6 h-6 rounded-full bg-green-500 text-black flex items-center justify-center transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </label>
                        </div>
                        
                        <!-- Mandiri -->
                        <div class="relative">
                            <input type="rad io" name="payment_method" value="Mandiri" id="mandiri" class="peer hidden radio-custom">
                            <label for="mandiri" class="flex items-center justify-between p-4 bg-black/40 border border-white/10 rounded-xl cursor-pointer hover:border-green-400/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-8 bg-white rounded flex items-center justify-center p-1">
                                        <span class="text-blue-900 font-black text-[10px]">mandiri</span>
                                    </div>
                                    <div>
                                        <p class="font-semibold text-white">Mandiri Virtual Account</p>
                                        <p class="text-xs text-gray-400">No. Rek: <span class="font-mono text-green-400 font-bold">0239129310</span></p>
                                    </div>
                                </div>
                                <div class="check-icon opacity-0 w-6 h-6 rounded-full bg-green-500 text-black flex items-center justify-center transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </label>
                        </div>

                        <!-- GoPay -->
                        <div class="relative">
                            <input type="radio" name="payment_method" value="GoPay" id="gopay" class="peer hidden radio-custom">
                            <label for="gopay" class="flex items-center justify-between p-4 bg-black/40 border border-white/10 rounded-xl cursor-pointer hover:border-green-400/50 transition-all">
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-8 bg-white rounded flex items-center justify-center p-1">
                                        <span class="text-blue-500 font-bold text-xs">gopay</span>
                                    </div>
                                    <div class="w-full">
                                        <p class="font-semibold text-white">GoPay / QRIS</p>
                                        <p class="text-xs text-gray-400 mt-1">Scan QRIS di bawah ini:</p>
                                        <div class="flex items-start gap-4 mt-3">
                                            <a href="{{ asset('asset/img/qris.png') }}" target="_blank" title="Klik untuk memperbesar" class="block relative group">
                                                <img src="{{ asset('asset/img/qris.png') }}" alt="QRIS" class="w-24 rounded-xl bg-white p-2 group-hover:opacity-80 transition-opacity">
                                                <div class="absolute inset-0 flex items-center justify-center opacity-0 group-hover:opacity-100 transition-opacity pointer-events-none">
                                                    <div class="bg-black/60 p-1.5 rounded-full text-white">
                                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                            <path fill-rule="evenodd" d="M3 4a1 1 0 011-1h4a1 1 0 010 2H6.414l3.293 3.293a1 1 0 11-1.414 1.414L5 6.414V8a1 1 0 01-2 0V4zm9 1a1 1 0 010-2h4a1 1 0 011 1v4a1 1 0 01-2 0V6.414l-3.293 3.293a1 1 0 11-1.414-1.414L13.586 5H12zm-9 7a1 1 0 012 0v1.586l3.293-3.293a1 1 0 111.414 1.414L6.414 15H8a1 1 0 010 2H4a1 1 0 01-1-1v-4zm13-1a1 1 0 011 1v4a1 1 0 01-1 1h-4a1 1 0 010-2h1.586l-3.293-3.293a1 1 0 111.414-1.414L15 13.586V12a1 1 0 011-1z" clip-rule="evenodd" />
                                                        </svg>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="{{ asset('asset/img/qris.png') }}" download="QRIS_BOA_Futsal.png" class="px-3 py-1.5 bg-white/5 border border-white/10 hover:bg-green-500/10 hover:border-green-500/50 hover:text-green-400 rounded-lg text-xs font-bold transition-colors flex items-center gap-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                                    <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zm3.293-7.707a1 1 0 011.414 0L9 10.586V3a1 1 0 112 0v7.586l1.293-1.293a1 1 0 111.414 1.414l-3 3a1 1 0 01-1.414 0l-3-3a1 1 0 010-1.414z" clip-rule="evenodd" />
                                                </svg>
                                                Download QR
                                            </a>
                                        </div>
                                    </div>
                                </div>
                                <div class="check-icon opacity-0 w-6 h-6 rounded-full bg-green-500 text-black flex items-center justify-center transition-opacity">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </label>
                        </div>
                    </div>
                    </form>
                </div>

            </div>

            <!-- Right Column: Summary -->
            <div class="lg:col-span-2">
                <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-3xl p-6 glow-green sticky top-6" x-data="{
                    tier: 'regular',
                    prices: { regular: 150000, vip: 250000, vvip: 500000 },
                    benefits: {
                        regular: 'Diskon 10% / Booking',
                        vip: 'Diskon 15% + Priority',
                        vvip: 'Diskon 20% + Premium'
                    },
                    get price() { return this.prices[this.tier]; },
                    get benefit() { return this.benefits[this.tier]; }
                }" @change="tier = document.querySelector('input[name=membership_tier]:checked').value">
                    <h2 class="text-xl font-bold text-white mb-6">Ringkasan</h2>
                    
                    <div class="space-y-4 mb-6">
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Jenis Layanan</span>
                            <span class="text-white font-medium">Join Member</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Paket</span>
                            <span class="text-white font-medium uppercase" x-text="tier"></span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Masa Aktif</span>
                            <span class="text-white font-medium">1 Tahun</span>
                        </div>
                        <div class="flex justify-between items-center text-sm">
                            <span class="text-gray-400">Benefit</span>
                            <span class="text-green-400 font-medium text-xs" x-text="benefit"></span>
                        </div>
                        <hr class="border-white/10">
                        <div class="flex justify-between items-center">
                            <span class="text-gray-300 font-semibold">Total Tagihan</span>
                            <span class="text-2xl font-extrabold text-green-400" x-text="'Rp ' + price.toLocaleString('id-ID')"></span>
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 mb-4">
                        <button type="submit" form="paymentForm" class="w-full py-4 text-center bg-green-500 text-black rounded-xl font-bold text-lg hover:bg-green-400 transition-all shadow-lg shadow-green-500/20">
                            Bayar Sekarang
                        </button>
                        
                        <div class="relative group">
                            <input type="file" name="payment_proof" id="payment_proof" class="absolute inset-0 w-full h-full opacity-0 cursor-pointer z-10" form="paymentForm" accept="image/*" onchange="handleFileUpload(event)">
                            <div id="upload-btn" class="w-full py-3.5 px-4 text-center bg-transparent border-2 border-green-500/50 text-green-400 rounded-xl font-bold group-hover:bg-green-500/10 transition-all flex flex-col items-center justify-center gap-2 overflow-hidden relative">
                                <div class="flex items-center justify-center gap-2 pointer-events-none relative z-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 shrink-0" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M3 17a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 110 2H4a1 1 0 01-1-1zM6.293 6.707a1 1 0 010-1.414l3-3a1 1 0 011.414 0l3 3a1 1 0 01-1.414 1.414L11 5.414V13a1 1 0 11-2 0V5.414L7.707 6.707a1 1 0 01-1.414 0z" clip-rule="evenodd" />
                                    </svg>
                                    <span id="upload-text" class="truncate max-w-[200px]">Upload Bukti Pembayaran</span>
                                </div>
                                <img id="upload-preview" src="" alt="Preview" class="hidden mt-2 rounded-lg max-h-40 w-full object-contain pointer-events-none">
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-center text-gray-500">
                        Dengan menekan tombol di atas, Anda menyetujui <a href="#" class="text-green-400 hover:underline">Syarat & Ketentuan</a> kami.
                    </p>
                </div>
            </div>

        </div>
    </div>

    <script>
        function handleFileUpload(event) {
            const file = event.target.files[0];
            const btn = document.getElementById('upload-btn');
            const text = document.getElementById('upload-text');
            const preview = document.getElementById('upload-preview');

            if (file) {
                text.textContent = file.name;
                btn.classList.add('bg-green-500/10', 'border-green-400', 'text-green-300');
                btn.classList.remove('bg-transparent', 'border-green-500/50');
                
                // Set and show preview
                preview.src = URL.createObjectURL(file);
                preview.classList.remove('hidden');
            } else {
                text.textContent = 'Upload Bukti Pembayaran';
                btn.classList.remove('bg-green-500/10', 'border-green-400', 'text-green-300');
                btn.classList.add('bg-transparent', 'border-green-500/50');
                
                // Hide preview
                preview.src = '';
                preview.classList.add('hidden');
            }
        }
    </script>
</body>
</html>
