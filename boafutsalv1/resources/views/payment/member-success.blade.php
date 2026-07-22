<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran Berhasil - BOA Futsal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#050505] text-white min-h-screen flex items-center justify-center px-6">
    <!-- Notification Bell -->
    <x-notification-bell />

    <div class="max-w-lg w-full text-center">
        <div class="bg-white/5 border border-white/10 rounded-3xl p-8">
            <div class="w-20 h-20 bg-green-500/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <svg class="w-10 h-10 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
            </div>
            
            <h1 class="text-3xl font-extrabold mb-4">Pembayaran Sedang Diproses</h1>
            <p class="text-gray-400 mb-6">Terima kasih! Pembayaran membership Anda sedang dalam proses verifikasi oleh admin.</p>
            
            <div class="bg-black/40 border border-white/10 rounded-xl p-6 mb-6">
                <div class="flex justify-between mb-3">
                    <span class="text-gray-400">Transaction ID</span>
                    <span class="font-mono text-green-400">{{ $payment->transaction_id }}</span>
                </div>
                <div class="flex justify-between mb-3">
                    <span class="text-gray-400">Metode</span>
                    <span class="font-semibold">{{ $payment->payment_method }}</span>
                </div>
                <div class="flex justify-between">
                    <span class="text-gray-400">Total</span>
                    <span class="font-bold text-xl text-green-400">Rp {{ number_format($payment->amount, 0, ',', '.') }}</span>
                </div>
            </div>
            
            <div class="bg-yellow-500/10 border border-yellow-500/20 rounded-xl p-4 mb-6">
                <p class="text-sm text-yellow-400 font-bold mb-2">
                    ⏳ Status: Menunggu Approval Admin
                </p>
                <p class="text-xs text-gray-400">
                    Membership Anda akan diaktifkan setelah admin mengonfirmasi pembayaran. Anda akan mendapat notifikasi via email.
                </p>
            </div>
            
            <a href="/" class="block w-full py-3 bg-green-500 text-black rounded-xl font-bold hover:bg-green-400 transition-all mb-2">
                Kembali ke Beranda
            </a>
            
            <a href="{{ route('login') }}" class="block w-full py-3 bg-white/5 border border-white/10 text-white rounded-xl font-bold hover:bg-white/10 transition-all text-center">
                Login
            </a>
        </div>
    </div>
</body>
</html>
