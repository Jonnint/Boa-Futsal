<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
        .glow-green { box-shadow: 0 0 20px rgba(74, 222, 128, 0.2); }
    </style>
</head>
<body class="bg-[#050505] text-white selection:bg-green-500 selection:text-black">

    <div class="min-h-screen flex items-center justify-center px-6 py-12 relative overflow-hidden">
        <!-- Background Effects -->
        <div class="absolute top-0 -left-20 w-96 h-96 bg-green-600/10 rounded-full blur-[120px]"></div>
        <div class="absolute bottom-0 -right-20 w-96 h-96 bg-green-900/10 rounded-full blur-[120px]"></div>

        <div class="w-full max-w-md relative z-10">
            <!-- Logo/Brand -->
            <div class="text-center mb-8">
                <a href="/" class="inline-block">
                    <h1 class="text-4xl font-extrabold tracking-tighter text-green-400">
                        BOA<span class="text-white">FUTSAL</span>
                    </h1>
                </a>
                <p class="text-gray-400 mt-2">Masuk ke akun kamu</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white/5 backdrop-blur-lg border border-white/10 rounded-[2rem] p-8 glow-green">
                <!-- Session Status -->
                @if (session('status'))
                    <div class="mb-4 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 text-sm">
                        {{ session('status') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-bold text-white mb-2">Email</label>
                        <input 
                            id="email" 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}" 
                            required 
                            autofocus 
                            autocomplete="username"
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                            placeholder="nama@email.com"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <label for="password" class="block text-sm font-bold text-white mb-2">Password</label>
                        <input 
                            id="password" 
                            type="password" 
                            name="password" 
                            required 
                            autocomplete="current-password"
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white placeholder-gray-500 focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                            placeholder="••••••••"
                        >
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me & Forgot Password -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center">
                            <input 
                                id="remember_me" 
                                type="checkbox" 
                                name="remember"
                                class="w-4 h-4 bg-white/5 border-white/10 rounded text-green-500 focus:ring-green-500 focus:ring-offset-0"
                            >
                            <span class="ml-2 text-sm text-gray-400">Ingat saya</span>
                        </label>

                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-green-400 hover:text-green-300 transition-colors">
                                Lupa password?
                            </a>
                        @endif
                    </div>

                    <!-- Submit Button -->
                    <button 
                        type="submit"
                        class="w-full px-6 py-3 bg-green-500 text-black rounded-xl font-bold text-base hover:bg-green-400 transition-all shadow-lg shadow-green-500/20"
                    >
                        Masuk
                    </button>

                    <!-- Register Link -->
                    <div class="text-center pt-4">
                        <p class="text-gray-400 text-sm">
                            Daftar kalau belum punya akun? 
                            <a href="{{ route('register') }}" class="text-green-400 hover:text-green-300 font-bold transition-colors">
                                Daftar sekarang
                            </a>
                        </p>
                    </div>
                </form>
            </div>

            <!-- Back to Home -->
            <div class="text-center mt-6">
                <a href="/" class="text-sm text-gray-400 hover:text-green-400 transition-colors">
                    ← Kembali ke Beranda
                </a>
            </div>
        </div>
    </div>

</body>
</html>
