<!DOCTYPE html>
<html lang="id" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola User - Admin BOA Futsal</title>
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
                
                <div class="flex items-center gap-4">
                    <a href="/admin/dashboard" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Dashboard</a>
                    <a href="/admin/bookings" class="text-sm font-medium text-gray-400 hover:text-green-400 transition-colors">Booking</a>
                    <a href="/admin/users" class="text-sm font-medium text-green-400">Users</a>
                    <span class="text-gray-600">|</span>
                    <form method="POST" action="{{ route('logout') }}" class="inline">
                        @csrf
                        <button type="submit" class="px-5 py-2.5 bg-white/5 border border-white/10 text-white rounded-xl font-bold text-sm hover:bg-white/10 transition-all">
                            Logout
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="pt-32 pb-20 px-6">
        <div class="container mx-auto max-w-7xl">
            <div class="flex items-center justify-between mb-8">
                <div>
                    <h1 class="text-4xl font-extrabold mb-2">Kelola User</h1>
                    <p class="text-gray-400">Manage semua user BOA Futsal</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-green-500 text-black rounded-xl font-bold hover:bg-green-400 transition-all">
                    + Tambah User
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400">
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead>
                            <tr class="border-b border-white/10">
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">ID</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Nama</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Email</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Phone</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Member</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Total Booking</th>
                                <th class="text-left py-3 px-4 text-sm font-bold text-gray-400">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($users as $user)
                            <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                <td class="py-4 px-4 text-sm">#{{ $user->id_user }}</td>
                                <td class="py-4 px-4 text-sm font-bold">{{ $user->name }}</td>
                                <td class="py-4 px-4 text-sm text-gray-400">{{ $user->email }}</td>
                                <td class="py-4 px-4 text-sm text-gray-400">{{ $user->phone }}</td>
                                <td class="py-4 px-4">
                                    @if($user->is_member)
                                        <span class="px-3 py-1 bg-green-500/10 text-green-400 rounded-full text-xs font-bold">Member</span>
                                    @else
                                        <span class="px-3 py-1 bg-gray-500/10 text-gray-400 rounded-full text-xs font-bold">Regular</span>
                                    @endif
                                </td>
                                <td class="py-4 px-4 text-sm">{{ $user->bookings_count }} booking</td>
                                <td class="py-4 px-4">
                                    <div class="flex gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id_user) }}" class="px-3 py-1 bg-blue-500/10 text-blue-400 rounded-lg text-xs font-bold hover:bg-blue-500/20 transition-all">
                                            Edit
                                        </a>
                                        <form method="POST" action="{{ route('admin.users.destroy', $user->id_user) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="px-3 py-1 bg-red-500/10 text-red-400 rounded-lg text-xs font-bold hover:bg-red-500/20 transition-all">
                                                Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="7" class="py-8 text-center text-gray-500">Belum ada user</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="mt-6">
                    {{ $users->links() }}
                </div>
            </div>
        </div>
    </div>

</body>
</html>
