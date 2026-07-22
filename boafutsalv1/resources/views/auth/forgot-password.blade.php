<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lupa Password - BOA Futsal</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glow-green { box-shadow: 0 0 20px rgba(74, 222, 128, 0.2); }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black">

    <div class="min-h-screen flex items-center justify-center px-6 py-12 relative overflow-hidden">
        <div class="absolute top-0 -left-20 w-96 h-96 bg-green-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-green-900/10 rounded-full blur-[120px]"></div>

        <div class="w-full max-w-md relative z-10">
            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <h1 class="text-4xl font-extrabold tracking-tighter text-green-400">
                        BOA<span class="text-white">FUTSAL</span>
                    </h1>
                </a>
                <p class="text-gray-400 mt-2">Reset password kamu</p>
            </div>

            <!-- Card -->
            <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-[2rem] p-8 glow-green">

                <p class="text-gray-400 text-sm leading-relaxed mb-6">
                    Lupa password? Tenang. Masukkan email kamu dan kami akan kirimkan link untuk reset password.
                </p>

                @if (session('status'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-bold text-white mb-2">Email</label>
                        <input
                            id="email"
                            type="email"
                            name="email"
                            value="{{ old('email') }}"
                            required
                            autofocus
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                            placeholder="nama@email.com"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <button
                        type="submit"
                        class="w-full px-6 py-3 bg-green-500 text-black rounded-xl font-bold text-base hover:bg-green-400 transition-all shadow-lg shadow-green-500/20"
                    >
                        Kirim Link Reset Password
                    </button>
                </form>
            </div>

            <div class="text-center mt-6">
                <a href="{{ route('login') }}" class="text-sm text-gray-400 hover:text-green-400 transition-colors">
                    ← Kembali ke Login
                </a>
            </div>
        </div>
    </div>

</body>
</html>
