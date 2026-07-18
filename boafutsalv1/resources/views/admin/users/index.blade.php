@extends('layouts.admin')

@section('title', 'Kelola User')

@section('content')
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl md:text-4xl font-extrabold mb-2">Kelola User</h1>
                    <p class="text-sm md:text-base text-gray-400">Manage semua user BOA Futsal</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-green-500 text-black rounded-xl font-bold hover:bg-green-400 transition-all text-center text-sm md:text-base">
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

            <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8">
                <div class="overflow-x-auto -mx-4 md:mx-0">
                    <div class="inline-block min-w-full align-middle px-4 md:px-0">
                        <table class="w-full">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap hidden md:table-cell">ID</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Nama</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Email</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap hidden md:table-cell">Phone</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Member</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap hidden lg:table-cell">Total Booking</th>
                                    <th class="text-left py-3 px-2 md:px-4 text-xs md:text-sm font-bold text-gray-400 whitespace-nowrap">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($users as $user)
                                <tr class="border-b border-white/5 hover:bg-white/5 transition-colors">
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm whitespace-nowrap hidden md:table-cell">#{{ $user->id_user }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm font-bold whitespace-nowrap">{{ $user->name }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm text-gray-400 whitespace-nowrap">{{ $user->email }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm text-gray-400 whitespace-nowrap hidden md:table-cell">{{ $user->phone }}</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 whitespace-nowrap">
                                        @if($user->is_member)
                                            <span class="px-2 py-1 md:px-3 bg-green-500/10 text-green-400 rounded-full text-[10px] md:text-xs font-bold">Member</span>
                                        @else
                                            <span class="px-2 py-1 md:px-3 bg-gray-500/10 text-gray-400 rounded-full text-[10px] md:text-xs font-bold">Regular</span>
                                        @endif
                                    </td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 text-xs md:text-sm whitespace-nowrap hidden lg:table-cell">{{ $user->bookings_count }} booking</td>
                                    <td class="py-3 md:py-4 px-2 md:px-4 whitespace-nowrap">
                                        <div class="flex gap-2">
                                            <a href="{{ route('admin.users.edit', $user->id_user) }}" class="px-2 py-1 md:px-3 md:py-1 bg-blue-500/10 text-blue-400 rounded-lg text-[10px] md:text-xs font-bold hover:bg-blue-500/20 transition-all">
                                                ✎
                                                <span class="hidden md:inline ml-1">Edit</span>
                                            </a>
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id_user) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus user ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="px-2 py-1 md:px-3 md:py-1 bg-red-500/10 text-red-400 rounded-lg text-[10px] md:text-xs font-bold hover:bg-red-500/20 transition-all">
                                                    🗑
                                                    <span class="hidden md:inline ml-1">Hapus</span>
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
@endsection
