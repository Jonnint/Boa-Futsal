@extends('layouts.admin')

@section('title', 'Manage Member')

@section('content')
            <div class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                <div>
                    <h1 class="text-2xl md:text-4xl font-extrabold mb-2 text-white">Manage Member</h1>
                    <p class="text-sm md:text-base text-gray-400">Kelola data keanggotaan dan status member BOA Futsal</p>
                </div>
                <a href="{{ route('admin.users.create') }}" class="px-6 py-3 bg-green-500 text-black rounded-xl font-bold hover:bg-green-400 hover:shadow-[0_0_20px_rgba(34,197,94,0.4)] transition-all text-center text-sm md:text-base flex items-center justify-center gap-2">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path></svg>
                    Tambah Member
                </a>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 p-4 bg-red-500/10 border border-red-500/20 rounded-xl text-red-400 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('error') }}
                </div>
            @endif

            <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8 backdrop-blur-xl shadow-2xl">
                <div class="overflow-x-auto -mx-4 md:mx-0">
                    <!-- Desktop Table View -->
                    <div class="hidden md:block min-w-full align-middle px-4 md:px-0">
                        <table class="w-full text-left border-collapse">
                            <thead>
                                <tr class="border-b border-white/10">
                                    <th class="py-4 px-4 text-xs md:text-sm font-bold text-gray-400 uppercase tracking-wider">Member Info</th>
                                    <th class="py-4 px-4 text-xs md:text-sm font-bold text-gray-400 uppercase tracking-wider">Status Member</th>
                                    <th class="py-4 px-4 text-xs md:text-sm font-bold text-gray-400 uppercase tracking-wider">Masa Aktif</th>
                                    <th class="py-4 px-4 text-xs md:text-sm font-bold text-gray-400 uppercase tracking-wider text-right">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-white/5">
                                @forelse($users as $index => $user)
                                @php
                                    // Mock data for UI purposes since backend isn't ready
                                    $statuses = ['VVIP', 'VIP', 'Regular'];
                                    // Use user's property if exists, else assign a random one based on index for variety
                                    $mockStatus = $user->status_member ?? $statuses[$index % 3];
                                    
                                    $statusColors = [
                                        'VVIP' => 'bg-purple-500/10 text-purple-400 border-purple-500/30',
                                        'VIP' => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                                        'Regular' => 'bg-gray-500/10 text-gray-400 border-gray-500/30'
                                    ];
                                    $colorClass = $statusColors[$mockStatus] ?? $statusColors['Regular'];

                                    // Mock date if property doesn't exist
                                    $mockDate = $user->masa_aktif ?? now()->addMonths(($index + 1) * 2)->format('d M Y');
                                @endphp
                                <tr class="hover:bg-white/5 transition-colors group">
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <div class="flex items-center gap-3">
                                            <!-- Avatar Initial -->
                                            <div class="w-10 h-10 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-black font-extrabold text-lg shadow-lg">
                                                {{ strtoupper(substr($user->name, 0, 1)) }}
                                            </div>
                                            <!-- Name and Email -->
                                            <div>
                                                <div class="text-sm font-bold text-white group-hover:text-green-400 transition-colors">{{ $user->name }}</div>
                                                <div class="text-xs text-gray-400">{{ $user->email }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <span class="px-3 py-1 rounded-full text-xs font-bold border {{ $colorClass }} shadow-sm">
                                            {{ $mockStatus }}
                                        </span>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap">
                                        <div class="flex items-center gap-2 text-sm text-gray-300 font-medium">
                                            <svg class="w-4 h-4 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            s/d {{ $mockDate }}
                                        </div>
                                    </td>
                                    <td class="py-4 px-4 whitespace-nowrap text-right">
                                        <div class="flex items-center justify-end gap-2">
                                            <!-- Edit / View Button -->
                                            <a href="{{ route('admin.users.edit', $user->id_user) }}" class="p-2 bg-blue-500/10 text-blue-400 rounded-lg hover:bg-blue-500 hover:text-white transition-all shadow-[0_0_10px_rgba(59,130,246,0)] hover:shadow-[0_0_15px_rgba(59,130,246,0.5)]" title="Edit Member">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                            </a>
                                            <!-- Delete Button -->
                                            <form method="POST" action="{{ route('admin.users.destroy', $user->id_user) }}" class="inline" onsubmit="return confirm('Yakin ingin menghapus member ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="p-2 bg-red-500/10 text-red-400 rounded-lg hover:bg-red-500 hover:text-white transition-all shadow-[0_0_10px_rgba(239,68,68,0)] hover:shadow-[0_0_15px_rgba(239,68,68,0.5)]" title="Hapus Member">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="py-16 text-center">
                                        <div class="flex flex-col items-center justify-center text-gray-500">
                                            <svg class="w-16 h-16 mb-4 text-gray-600/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                            <p class="text-lg font-medium">Belum ada member yang terdaftar</p>
                                        </div>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Mobile Cards View -->
                    <div class="block md:hidden space-y-4 px-4 pb-4">
                        @forelse($users as $index => $user)
                        @php
                            $statuses = ['VVIP', 'VIP', 'Regular'];
                            $mockStatus = $user->status_member ?? $statuses[$index % 3];
                            $statusColors = [
                                'VVIP' => 'bg-purple-500/10 text-purple-400 border-purple-500/30',
                                'VIP' => 'bg-amber-500/10 text-amber-400 border-amber-500/30',
                                'Regular' => 'bg-gray-500/10 text-gray-400 border-gray-500/30'
                            ];
                            $colorClass = $statusColors[$mockStatus] ?? $statusColors['Regular'];
                            $mockDate = $user->masa_aktif ?? now()->addMonths(($index + 1) * 2)->format('d M Y');
                        @endphp
                            <div class="bg-black/40 border border-white/5 rounded-2xl p-5 shadow-lg flex flex-col gap-4">
                                <!-- Top: Avatar & Info -->
                                <div class="flex items-center gap-4">
                                    <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-green-600 flex items-center justify-center text-black font-extrabold text-xl shadow-lg shrink-0">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <div class="overflow-hidden">
                                        <div class="text-base font-bold text-white truncate">{{ $user->name }}</div>
                                        <div class="text-sm text-gray-400 truncate">{{ $user->email }}</div>
                                    </div>
                                </div>
                                
                                <!-- Middle: Status & Date -->
                                <div class="bg-white/5 rounded-xl p-3 grid grid-cols-2 gap-3 border border-white/5">
                                    <div>
                                        <div class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Status Member</div>
                                        <span class="px-2.5 py-0.5 rounded-full text-[10px] font-bold border {{ $colorClass }}">
                                            {{ $mockStatus }}
                                        </span>
                                    </div>
                                    <div>
                                        <div class="text-[10px] text-gray-500 font-bold uppercase tracking-wider mb-1">Masa Aktif</div>
                                        <div class="flex items-center gap-1.5 text-xs text-gray-300 font-medium">
                                            <svg class="w-3.5 h-3.5 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                            s/d {{ $mockDate }}
                                        </div>
                                    </div>
                                </div>
                                
                                <!-- Bottom: Actions -->
                                <div class="pt-3 border-t border-white/5 flex items-center justify-end gap-2">
                                    <a href="{{ route('admin.users.edit', $user->id_user) }}" class="flex-1 py-2.5 bg-blue-500/10 text-blue-400 rounded-lg text-sm font-bold hover:bg-blue-500 hover:text-white transition-colors border border-blue-500/20 flex items-center justify-center gap-2">
                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path></svg>
                                        Edit
                                    </a>
                                    <form method="POST" action="{{ route('admin.users.destroy', $user->id_user) }}" class="flex-1" onsubmit="return confirm('Yakin ingin menghapus member ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full py-2.5 bg-red-500/10 text-red-400 rounded-lg text-sm font-bold hover:bg-red-500 hover:text-white transition-colors border border-red-500/20 flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            Hapus
                                        </button>
                                    </form>
                                </div>
                            </div>
                        @empty
                            <div class="py-10 text-center bg-black/20 rounded-2xl border border-white/5">
                                <svg class="w-12 h-12 mx-auto mb-3 text-gray-600/50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path></svg>
                                <p class="text-sm font-medium text-gray-500">Belum ada member yang terdaftar</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="mt-6">
                        {{ $users->links() }}
                    </div>
                </div>
            </div>
@endsection
