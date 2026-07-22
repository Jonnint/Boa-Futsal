    @extends('layouts.admin')

    @section('title', 'Komentar Masuk')

    @section('content')

                <!-- Header -->
                <div class="relative overflow-hidden rounded-[2rem] p-8 md:p-12 bg-gradient-to-br from-green-500/10 via-green-600/5 to-transparent border border-green-500/20 mb-8">
                    <div class="flex items-center justify-between">
                        <div>
                            <h1 class="text-4xl md:text-5xl font-extrabold tracking-tighter mb-2">
                                Komentar <span class="text-green-400">Masuk</span>
                            </h1>
                            <p class="text-gray-400">Komentar Umum dari pengunjung website BOA Futsal</p>
                        </div>
                        @if($unreadCount > 0)
                            <div class="px-5 py-3 bg-green-500/10 border border-green-500/20 rounded-2xl text-center">
                                <p class="text-3xl font-extrabold text-green-400">{{ $unreadCount }}</p>
                                <p class="text-xs text-gray-400 mt-1">Belum Dibaca</p>
                            </div>
                        @endif
                    </div>
                </div>

                @if(session('success'))
                    <div class="mb-6 p-4 bg-green-500/10 border border-green-500/20 rounded-2xl text-green-400 text-sm">
                        {{ session('success') }}
                    </div>
                @endif

                <!-- Messages List -->
                @if($messages->isEmpty())
                    <div class="bg-white/5 border border-white/10 rounded-[2rem] p-16 text-center">
                        <div class="w-16 h-16 bg-white/5 rounded-2xl flex items-center justify-center mx-auto mb-4">
                            <svg class="w-8 h-8 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                            </svg>
                        </div>
                        <p class="text-gray-500 font-medium">Belum ada komentar masuk</p>
                </div>
            @else
                <div class="space-y-4">
                    @foreach($messages as $msg)
                        <div class="group bg-white/5 border {{ $msg->status === 'unread' ? 'border-green-500/30' : 'border-white/10' }} rounded-[2rem] p-6 transition-all duration-300 hover:border-green-500/30">
                            <div class="flex items-start justify-between gap-4">
                                <div class="flex items-start gap-4 flex-1 min-w-0">
                                    <!-- Avatar -->
                                    <div class="w-12 h-12 shrink-0 rounded-2xl bg-green-500/10 border border-green-500/20 flex items-center justify-center font-bold text-green-400 text-lg uppercase">
                                        {{ substr($msg->name, 0, 1) }}
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <div class="flex items-center gap-3 flex-wrap mb-1">
                                            <span class="font-bold text-white">{{ $msg->name }}</span>
                                            @if($msg->status === 'unread')
                                                <span class="px-2 py-0.5 bg-green-500/20 border border-green-500/30 text-green-400 text-xs font-bold rounded-full">Baru</span>
                                            @endif
                                            <span class="text-gray-500 text-xs">{{ $msg->created_at->diffForHumans() }}</span>
                                        </div>
                                        <p class="text-gray-400 text-sm mb-1">{{ $msg->email }}</p>
                                        <p class="text-white font-semibold text-sm mb-3">{{ $msg->subject }}</p>
                                        <p class="text-gray-400 text-sm leading-relaxed">{{ $msg->message }}</p>
                                    </div>
                                </div>

                                <!-- Actions -->
                                <div class="flex items-center gap-2 shrink-0">
                                    @if($msg->status === 'unread')
                                        <form method="POST" action="{{ route('admin.comments.read', $msg->id) }}">
                                            @csrf
                                            <button type="submit" title="Tandai sudah dibaca"
                                                class="w-9 h-9 bg-green-500/10 border border-green-500/20 hover:bg-green-500 hover:border-green-500 rounded-xl flex items-center justify-center transition-all duration-300 group/btn">
                                                <svg class="w-4 h-4 text-green-400 group-hover/btn:text-black transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                                </svg>
                                            </button>
                                        </form>
                                    @endif
                                    <a href="mailto:{{ $msg->email }}" title="Balas via Email"
                                        class="w-9 h-9 bg-white/5 border border-white/10 hover:bg-white/10 rounded-xl flex items-center justify-center transition-all duration-300">
                                        <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                                        </svg>
                                    </a>
                                    <form method="POST" action="{{ route('admin.comments.delete', $msg->id) }}" onsubmit="return confirm('Hapus komentar ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" title="Hapus"
                                            class="w-9 h-9 bg-red-500/10 border border-red-500/20 hover:bg-red-500 hover:border-red-500 rounded-xl flex items-center justify-center transition-all duration-300 group/del">
                                            <svg class="w-4 h-4 text-red-400 group-hover/del:text-white transition-colors" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="mt-8">
                    {{ $messages->links() }}
                </div>
            @endif

@endsection
