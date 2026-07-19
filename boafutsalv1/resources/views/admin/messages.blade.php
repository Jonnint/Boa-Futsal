@extends('layouts.admin')

@section('title', 'Pesan Masuk')

@section('content')

            <!-- Header -->
            <div class="relative overflow-hidden rounded-3xl p-8 md:p-12 bg-white/5 border border-white/10 backdrop-blur-xl shadow-2xl mb-8 group">
                <div class="absolute inset-0 bg-gradient-to-br from-green-500/20 via-transparent to-transparent opacity-50 group-hover:opacity-100 transition-opacity duration-700"></div>
                <div class="relative z-10 flex flex-col md:flex-row md:items-center justify-between gap-6">
                    <div>
                        <h1 class="text-3xl md:text-5xl font-extrabold tracking-tighter mb-2 text-white">
                            Pesan <span class="text-transparent bg-clip-text bg-gradient-to-r from-green-400 to-green-600">Masuk</span>
                        </h1>
                        <p class="text-gray-400 font-medium text-sm md:text-base">Pesan kolaborasi, kritik, atau saran dari pengunjung website</p>
                    </div>
                    @if($unreadCount > 0)
                        <div class="px-6 py-4 bg-green-500/10 border border-green-500/30 rounded-2xl text-center shadow-[0_0_30px_rgba(34,197,94,0.15)] flex flex-col items-center justify-center min-w-[120px]">
                            <p class="text-4xl font-extrabold text-green-400">{{ $unreadCount }}</p>
                            <p class="text-xs text-green-400/80 mt-1 uppercase tracking-widest font-bold">Belum Dibaca</p>
                        </div>
                    @else
                        <div class="hidden md:flex items-center justify-center w-20 h-20 rounded-full bg-white/5 border border-white/10">
                            <svg class="w-8 h-8 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path></svg>
                        </div>
                    @endif
                </div>
            </div>

            @if(session('success'))
                <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-xl text-green-400 flex items-center gap-3">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                    {{ session('success') }}
                </div>
            @endif

            <!-- Messages List -->
            <div class="bg-white/5 border border-white/10 rounded-2xl md:rounded-[2rem] p-4 md:p-8 backdrop-blur-xl shadow-2xl">
                
                @if($messages->isEmpty())
                    <div class="py-20 text-center">
                        <div class="w-20 h-20 bg-white/5 border border-white/10 rounded-3xl flex items-center justify-center mx-auto mb-6 shadow-inner">
                            <svg class="w-10 h-10 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-xl text-white font-bold mb-2">Kotak Masuk Kosong</p>
                        <p class="text-gray-500">Belum ada pesan baru yang masuk dari pengunjung.</p>
                    </div>
                @else
                    <div class="space-y-4">
                        @foreach($messages as $msg)
                            <div class="group relative overflow-hidden flex flex-col md:flex-row md:items-start gap-4 md:gap-6 p-5 md:p-6 rounded-2xl transition-all duration-300 {{ $msg->status === 'unread' ? 'bg-gradient-to-r from-green-500/10 to-transparent border border-green-500/30 shadow-[0_4px_20px_rgba(34,197,94,0.1)]' : 'bg-white/5 border border-white/10 hover:bg-white/10 hover:border-white/20' }}">
                                
                                @if($msg->status === 'unread')
                                    <div class="absolute left-0 top-0 bottom-0 w-1.5 bg-green-500 rounded-l-2xl shadow-[0_0_10px_rgba(34,197,94,0.8)]"></div>
                                @endif

                                <!-- Avatar & Initial Info -->
                                <div class="flex items-center gap-4 md:w-64 shrink-0 pl-2">
                                    <div class="w-12 h-12 shrink-0 rounded-full flex items-center justify-center font-extrabold text-lg uppercase shadow-lg {{ $msg->status === 'unread' ? 'bg-green-500/20 text-green-400 border border-green-500/30' : 'bg-white/10 text-white border border-white/20' }}">
                                        {{ substr($msg->name, 0, 1) }}
                                    </div>
                                    <div class="min-w-0 flex-1">
                                        <h3 class="font-bold text-white text-base truncate">{{ $msg->name }}</h3>
                                        <p class="text-xs text-gray-400 truncate">{{ $msg->email }}</p>
                                        @if($msg->phone)
                                        <p class="text-xs text-gray-500 truncate mt-0.5">{{ $msg->phone }}</p>
                                        @endif
                                    </div>
                                </div>

                                <!-- Message Content -->
                                <div class="flex-1 min-w-0 bg-black/20 rounded-xl p-4 md:p-5 border border-white/5">
                                    <div class="flex items-center justify-between gap-4 mb-2">
                                        <h4 class="font-extrabold text-white text-base md:text-lg">{{ $msg->subject }}</h4>
                                        <span class="text-xs font-medium text-gray-500 shrink-0 flex items-center gap-1">
                                            <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                            {{ $msg->created_at->diffForHumans() }}
                                        </span>
                                    </div>
                                    <p class="text-sm text-gray-300 leading-relaxed">{{ $msg->message }}</p>
                                </div>

                                <!-- Actions -->
                                <div class="flex md:flex-col items-center justify-end gap-2 shrink-0 pt-2 md:pt-0">
                                    @if($msg->status === 'unread')
                                        <form method="POST" action="{{ route('admin.messages.update-status', [$msg->id, 'read']) }}" class="w-full md:w-auto">
                                            @csrf
                                            <button type="submit" class="w-full md:w-auto px-4 py-2 bg-green-500/10 text-green-400 hover:bg-green-500 hover:text-white rounded-xl text-sm font-bold transition-all border border-green-500/20 hover:border-green-500 flex items-center justify-center gap-2">
                                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                                <span class="md:hidden">Tandai Dibaca</span>
                                            </button>
                                        </form>
                                    @endif
                                    
                                    <form method="POST" action="{{ route('admin.messages.destroy', $msg->id) }}" onsubmit="return confirm('Yakin ingin menghapus pesan ini?')" class="w-full md:w-auto">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="w-full md:w-auto px-4 py-2 bg-red-500/10 text-red-400 hover:bg-red-500 hover:text-white rounded-xl text-sm font-bold transition-all border border-red-500/20 hover:border-red-500 flex items-center justify-center gap-2">
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path></svg>
                                            <span class="md:hidden">Hapus</span>
                                        </button>
                                    </form>
                                </div>

                            </div>
                        @endforeach
                    </div>

                    <div class="mt-8">
                        {{ $messages->links() }}
                    </div>
                @endif
            </div>

@endsection
