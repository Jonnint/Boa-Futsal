<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah User - Admin BOA Futsal</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Plus Jakarta Sans', sans-serif; }
    </style>
</head>
<body class="bg-[#050505] text-white">

    <!-- Navbar -->
    <nav class="fixed top-0 left-0 right-0 z-50 py-6 bg-black/20 backdrop-blur-lg border-b border-white/5">
        <div class="container mx-auto px-6">
            <div class="flex items-center justify-between">
                <a href="/admin/dashboard" class="text-2xl font-extrabold tracking-tighter text-green-400">
                    BOA<span class="text-white">FUTSAL</span> <span class="text-sm text-gray-500">Admin</span>
                </a>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-32 pb-20 px-6">
        <div class="container mx-auto max-w-2xl">
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-green-400 transition-colors mb-8">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>

            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <h1 class="text-3xl font-extrabold mb-2">Tambah User Baru</h1>
                <p class="text-gray-400 mb-8">Isi form untuk menambahkan user</p>

                <form action="{{ route('admin.users.store') }}" method="POST" class="space-y-6">
                    @csrf

                    <div>
                        <label class="block text-sm font-bold mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name') }}"
                            required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                        >
                        @error('name')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2">Email</label>
                        <input 
                            type="email" 
                            name="email" 
                            value="{{ old('email') }}"
                            required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                        >
                        @error('email')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2">No. Telepon</label>
                        <input 
                            type="text" 
                            name="phone" 
                            value="{{ old('phone') }}"
                            required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                        >
                        @error('phone')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2">Password</label>
                        <input 
                            type="password" 
                            name="password" 
                            required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                        >
                        @error('password')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center gap-3">
                        <input 
                            type="checkbox" 
                            name="is_member" 
                            id="is_member"
                            {{ old('is_member') ? 'checked' : '' }}
                            class="w-5 h-5 bg-white/5 border border-white/10 rounded text-green-500 focus:ring-2 focus:ring-green-500/20"
                        >
                        <label for="is_member" class="text-sm font-bold">Member (Dapat harga khusus)</label>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 px-6 py-4 bg-green-500 text-black rounded-xl font-bold text-lg hover:bg-green-400 transition-all"
                        >
                            Tambah User
                        </button>
                        <a 
                            href="{{ route('admin.users.index') }}"
                            class="flex-1 px-6 py-4 bg-white/5 border border-white/10 rounded-xl font-bold text-lg hover:bg-white/10 transition-all text-center"
                        >
                            Batal
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

</body>
</html>
