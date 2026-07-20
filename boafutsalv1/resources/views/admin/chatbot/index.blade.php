@extends('layouts.admin')

@section('title', 'Kelola Chatbot Fonnte')

@section('content')
    <!-- Header -->
    <div class="flex items-center justify-between mb-8">
        <div>
            <h1 class="text-2xl md:text-3xl font-extrabold text-white tracking-tight">
                Kelola <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-emerald-400">Chatbot Fonnte</span>
            </h1>
            <p class="text-gray-400 text-sm mt-0.5">Konfigurasi bot auto-reply WhatsApp dengan Fonnte API Gateway</p>
        </div>
        <div class="flex items-center gap-2">
            <span class="px-3 py-1 bg-green-500/10 border border-green-500/30 text-green-400 rounded-full text-xs font-bold shadow-sm">
                Fonnte API v1
            </span>
        </div>
    </div>

    <!-- Alert Success -->
    @if(session('success'))
        <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 text-green-400 rounded-2xl flex items-center gap-3">
            <svg class="w-5 h-5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
            <span class="text-sm font-bold">{{ session('success') }}</span>
        </div>
    @endif

    <form action="{{ route('admin.chatbot.update') }}" method="POST" id="chatbotForm">
        @csrf

        <div class="grid grid-cols-1 xl:grid-cols-3 gap-6">

            <!-- LEFT COLUMN: Configurations & Message Templates -->
            <div class="xl:col-span-2 space-y-6">

                <!-- Fonnte Credentials -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-green-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path></svg>
                        </span>
                        Koneksi & API Fonnte
                    </h2>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                        <!-- Nomor WA Bot -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">
                                Nomor WhatsApp Bot <span class="text-red-400">*</span>
                            </label>
                            <input type="text" name="wa_number" value="{{ old('wa_number', $settings->wa_number) }}"
                                   class="w-full bg-white/5 border {{ $errors->has('wa_number') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-white/8 transition-all"
                                   placeholder="Contoh: 6281234567890" required>
                            <p class="text-[10px] text-gray-500 mt-1.5">Gunakan format kode negara tanpa karakter tambahan (misal: 628xxx)</p>
                            @error('wa_number')
                                <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Fonnte Token -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">
                                Fonnte API Token
                            </label>
                            <input type="password" name="api_token" value="{{ old('api_token', $settings->api_token) }}"
                                   class="w-full bg-white/5 border {{ $errors->has('api_token') ? 'border-red-500/50' : 'border-white/10' }} rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-white/8 transition-all"
                                   placeholder="Masukkan token dari Fonnte Dashboard">
                            <p class="text-[10px] text-gray-500 mt-1.5">Dibutuhkan untuk mengirim pesan balasan otomatis dari backend</p>
                            @error('api_token')
                                <p class="mt-1.5 text-xs text-red-400 font-medium">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Message Templates -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6 flex items-center gap-2">
                        <span class="w-7 h-7 rounded-lg bg-green-500/20 flex items-center justify-center">
                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path></svg>
                        </span>
                        Template Pesan Chatbot
                    </h2>

                    <div class="space-y-6">
                        <!-- User Message (Trigger) -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">
                                Template Pesan User (Trigger)
                            </label>
                            <textarea name="user_message_template" rows="4"
                                      class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-white/8 transition-all font-mono text-sm leading-relaxed"
                                      placeholder="Masukkan pesan yang dikirim oleh user...">{{ old('user_message_template', $settings->user_message_template) }}</textarea>
                            <p class="text-[10px] text-gray-500 mt-1.5">
                                Gunakan placeholder <span class="text-green-400 font-bold font-mono">{greeting}</span> untuk menyisipkan ucapan selamat pagi/siang/sore/malam secara dinamis.
                            </p>
                        </div>

                        <!-- Bot Reply -->
                        <div>
                            <label class="block text-sm font-bold text-gray-300 mb-2">
                                Template Balasan Chatbot (Response)
                            </label>
                            <textarea name="reply_message_template" rows="4"
                                      class="w-full bg-white/5 border border-white/10 rounded-xl px-4 py-3 text-white placeholder-gray-600 focus:outline-none focus:border-green-500/50 focus:bg-white/8 transition-all font-mono text-sm leading-relaxed"
                                      placeholder="Masukkan pesan respon balasan bot...">{{ old('reply_message_template', $settings->reply_message_template) }}</textarea>
                            <p class="text-[10px] text-gray-500 mt-1.5">
                                Gunakan placeholder <span class="text-green-400 font-bold font-mono">{greeting}</span> untuk menyisipkan ucapan selamat pagi/siang/sore/malam secara dinamis.
                            </p>
                        </div>
                    </div>
                </div>

            </div>

            <!-- RIGHT COLUMN: Control Panel & Status -->
            <div class="xl:col-span-1 space-y-6">

                <!-- Activation Card -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-lg font-extrabold text-white mb-6">Status Chatbot</h2>

                    <div class="space-y-6">
                        <!-- Status Toggle -->
                        <div class="flex items-center justify-between p-4 bg-black/40 border border-white/10 rounded-2xl">
                            <div>
                                <p class="text-sm font-bold text-white">Status Aktif</p>
                                <p class="text-[10px] text-gray-400">Aktifkan atau nonaktifkan bot auto-reply</p>
                            </div>
                            <div class="relative inline-flex items-center cursor-pointer">
                                <input type="checkbox" name="is_active" value="1" id="is_active" class="sr-only peer" {{ $settings->is_active ? 'checked' : '' }}>
                                <label for="is_active" class="w-11 h-6 bg-white/10 border border-white/10 rounded-full peer peer-focus:ring-0 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-0.5 after:left-[2px] after:bg-gray-400 after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-500 peer-checked:after:bg-black peer-checked:after:border-black cursor-pointer"></label>
                            </div>
                        </div>

                        <!-- Webhook URL Info -->
                        <div class="p-4 bg-black/40 border border-white/10 rounded-2xl space-y-3">
                            <h3 class="text-xs font-bold text-gray-300 uppercase tracking-wider">URL Webhook Anda</h3>
                            <p class="text-[10px] text-gray-400 leading-relaxed">
                                Salin URL berikut dan masukkan ke kolom **Webhook URL** di halaman pengaturan device dashboard Fonnte Anda:
                            </p>
                            <div class="flex items-center gap-2 bg-white/5 border border-white/5 rounded-xl p-3">
                                <input type="text" readonly id="webhookUrlInput"
                                       value="{{ url('/webhook/fonnte') }}"
                                       class="bg-transparent text-xs font-mono text-green-400 focus:outline-none w-full select-all">
                                <button type="button" onclick="copyWebhookUrl()"
                                        class="p-1 hover:bg-white/10 rounded text-gray-400 hover:text-white transition-all shrink-0"
                                        title="Copy URL">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 5H6a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2v-1M8 5a2 2 0 002 2h2a2 2 0 002-2M8 5a2 2 0 012-2h2a2 2 0 012 2m-3 7h3m-3 4h3m-6-4h.01M9 16h.01"></path></svg>
                                </button>
                            </div>
                        </div>

                        <!-- Save Button -->
                        <button type="submit"
                                class="w-full py-4 text-center bg-green-500 hover:bg-green-400 text-black font-extrabold rounded-xl transition-all shadow-lg shadow-green-500/10 flex items-center justify-center gap-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path></svg>
                            Simpan Perubahan
                        </button>
                    </div>
                </div>

                <!-- Guidance Info -->
                <div class="bg-white/5 border border-white/10 rounded-3xl p-6 md:p-8 backdrop-blur-xl shadow-2xl">
                    <h2 class="text-sm font-extrabold text-white mb-4">Panduan Webhook</h2>
                    <ul class="text-xs text-gray-400 space-y-3 leading-relaxed">
                        <li class="flex gap-2">
                            <span class="text-green-400 font-bold">1.</span>
                            <span>Pastikan **Fonnte API Token** diisi dengan benar agar sistem dapat mengirim balik pesan.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-400 font-bold">2.</span>
                            <span>Daftarkan URL Webhook di dashboard Fonnte Anda pada menu Device Settings.</span>
                        </li>
                        <li class="flex gap-2">
                            <span class="text-green-400 font-bold">3.</span>
                            <span>Status Chatbot harus **Aktif** agar server merespon trigger pesan yang masuk dari Fonnte.</span>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
    </form>

    <script>
        function copyWebhookUrl() {
            var copyText = document.getElementById("webhookUrlInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999); /* For mobile devices */
            navigator.clipboard.writeText(copyText.value);
            
            // Show toast or alert
            alert("URL Webhook berhasil disalin!");
        }
    </script>
@endsection
