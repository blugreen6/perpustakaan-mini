@extends('layouts.app')
@section('judul', 'Daftar Buku')

@section('konten')
{{-- Section Judul & Pencarian Tengah --}}
<div class="flex flex-col items-center justify-center text-center mt-2 mb-12 gap-4">
    <h1 class="text-3xl font-extrabold text-[#2b4c34]">Temukan Buku Favoritmu</h1>
    <p class="text-slate-500 max-w-xl text-sm">Cari dan kelola koleksi buku bacaan dengan mudah menggunakan antarmuka yang nyaman.</p>

    {{-- Form Pencarian (Pill shape) --}}
    <form action="{{ route('buku.index') }}" method="GET" class="w-full max-w-2xl bg-white p-2 rounded-full shadow-sm flex items-center border border-slate-100 mt-4">
        <div class="flex-1 flex items-center px-4">
            <svg class="w-5 h-5 text-slate-400 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"></path></svg>
            <input type="text" name="cari" value="{{ $cari ?? '' }}" placeholder="Cari judul, penulis, penerbit..."
                   class="w-full bg-transparent border-none focus:ring-0 text-slate-700 placeholder-slate-400 outline-none">
        </div>
        <button class="bg-[#3c6e47] text-white px-8 py-3 rounded-full hover:bg-[#2b5234] font-semibold transition text-sm">
            Cari
        </button>
    </form>

    @auth
        <a href="{{ route('buku.create') }}" class="mt-4 bg-[#3c6e47] text-white px-6 py-2.5 rounded-full hover:bg-[#2b5234] text-sm font-semibold shadow-sm transition">
            + Tambah Koleksi Baru
        </a>
    @endauth
</div>

{{-- Grid Cards ala Agent Cards referensi --}}
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse ($daftarBuku as $buku)
        <div class="bg-white rounded-[2rem] p-4 shadow-sm border border-slate-100 flex flex-col hover:shadow-md transition-all duration-300">
            
            {{-- Gambar Sampul (Memiliki padding di dalam kartu putih) --}}
            <div class="h-56 w-full rounded-[1.5rem] overflow-hidden bg-[#f4f7ed] mb-5 relative group">
                @if($buku->cover_image)
                    <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Sampul {{ $buku->judul }}" class="w-full h-full object-cover transition-transform duration-500 group-hover:scale-105">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#95b09b]">
                        <svg class="w-12 h-12 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-sm font-medium">Tanpa Sampul</span>
                    </div>
                @endif
            </div>
            
            {{-- Konten Teks --}}
            <div class="px-2 flex-1 flex flex-col justify-between">
                <div>
                    <h2 class="text-lg font-extrabold text-[#2b4c34] leading-tight">
                        <a href="{{ route('buku.show', $buku) }}" class="hover:text-[#4a8557] transition-colors">
                            {{ $buku->judul }}
                        </a>
                    </h2>
                    <p class="text-[#7c8e81] text-xs mt-2 font-medium leading-relaxed">
                        {{ $buku->penulis }} <br>
                        {{ $buku->penerbit ?: 'Penerbit Kosong' }} &middot; {{ $buku->tahun_terbit }}
                    </p>
                </div>
                
                {{-- Tombol Aksi --}}
                @auth
                    <div class="flex gap-2 mt-5">
                        <a href="{{ route('buku.edit', $buku) }}" class="flex-1 text-center bg-[#3c6e47] text-white px-4 py-2.5 rounded-full text-xs font-bold hover:bg-[#2b5234] transition">
                            Ubah
                        </a>
                        <form action="{{ route('buku.destroy', $buku) }}" method="POST" class="flex-none" onsubmit="return confirm('Yakin ingin menghapus buku ini?')">
                            @csrf
                            @method('DELETE')
                            <button class="bg-[#f2f6ed] text-[#3c6e47] px-5 py-2.5 rounded-full text-xs font-bold hover:bg-[#e4ebd9] transition">
                                Hapus
                            </button>
                        </form>
                    </div>
                @endauth
            </div>
        </div>
    @empty
        <div class="col-span-full py-16 text-center text-[#7c8e81] bg-white rounded-[2rem] shadow-sm border border-slate-100">
            <p class="text-lg font-medium">Belum ada koleksi buku yang ditambahkan.</p>
        </div>
    @endforelse
</div>

{{-- Pagination --}}
<div class="mt-10 mb-8">
    {{ $daftarBuku->links() }}
</div>
@endsection