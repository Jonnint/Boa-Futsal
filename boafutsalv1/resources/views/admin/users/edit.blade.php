@extends('layouts.admin')

@section('title', 'Edit User')

@section('content')
            <a href="{{ route('admin.users.index') }}" class="inline-flex items-center gap-2 text-gray-400 hover:text-green-400 transition-colors mb-8">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
                Kembali
            </a>

            <div class="bg-white/5 border border-white/10 rounded-[2rem] p-8">
                <h1 class="text-3xl font-extrabold mb-2">Edit User</h1>
                <p class="text-gray-400 mb-8">Update informasi user</p>

                <form action="{{ route('admin.users.update', $user->id_user) }}" method="POST" class="space-y-6">
                    @csrf
                    @method('PUT')

                    <div>
                        <label class="block text-sm font-bold mb-2">Nama Lengkap</label>
                        <input 
                            type="text" 
                            name="name" 
                            value="{{ old('name', $user->name) }}"
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
                            value="{{ old('email', $user->email) }}"
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
                            value="{{ old('phone', $user->phone) }}"
                            required
                            class="w-full px-4 py-3 bg-white/5 border border-white/10 rounded-xl text-white focus:outline-none focus:border-green-500 focus:ring-2 focus:ring-green-500/20 transition-all"
                        >
                        @error('phone')
                            <p class="mt-2 text-sm text-red-400">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label class="block text-sm font-bold mb-2">Password (Kosongkan jika tidak ingin mengubah)</label>
                        <input 
                            type="password" 
                            name="password" 
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
                            {{ old('is_member', $user->is_member) ? 'checked' : '' }}
                            class="w-5 h-5 bg-white/5 border border-white/10 rounded text-green-500 focus:ring-2 focus:ring-green-500/20"
                        >
                        <label for="is_member" class="text-sm font-bold">Member (Dapat harga khusus)</label>
                    </div>

                    <div class="flex gap-4 pt-4">
                        <button 
                            type="submit"
                            class="flex-1 px-6 py-4 bg-green-500 text-black rounded-xl font-bold text-lg hover:bg-green-400 transition-all"
                        >
                            Update User
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
@endsection
