@extends('layouts.app')
@section('judul', 'Detail Buku - ' . $buku->judul)

@section('konten')
<div class="max-w-3xl mx-auto mt-8">
    <div class="bg-white rounded-[2rem] p-6 md:p-10 shadow-sm border border-slate-100 flex flex-col md:flex-row gap-8">
        
        {{-- Bagian Kiri: Cover Buku --}}
        <div class="w-full md:w-1/3 flex-shrink-0">
            <div class="w-full aspect-[3/4] rounded-[1.5rem] overflow-hidden bg-[#f4f7ed] relative">
                @if($buku->cover_image)
                    <img src="{{ asset('storage/' . $buku->cover_image) }}" alt="Sampul {{ $buku->judul }}" class="w-full h-full object-cover">
                @else
                    <div class="w-full h-full flex flex-col items-center justify-center text-[#95b09b]">
                        <svg class="w-16 h-16 mb-2 opacity-50" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                        <span class="text-sm font-medium">Tanpa Sampul</span>
                    </div>
                @endif
            </div>
        </div>

        {{-- Bagian Kanan: Detail & Sinopsis --}}
        <div class="flex-1 flex flex-col">
            <h1 class="text-3xl md:text-4xl font-extrabold text-[#2b4c34] leading-tight mb-2">{{ $buku->judul }}</h1>
            
            <p class="text-[#7c8e81] font-medium text-sm md:text-base mb-6 border-b border-slate-100 pb-4">
                Ditulis oleh <span class="font-bold text-[#3c6e47]">{{ $buku->penulis }}</span> <br>
                Diterbitkan oleh {{ $buku->penerbit ?: 'Tidak diketahui' }} pada tahun {{ $buku->tahun_terbit }}
            </p>

            <div class="flex-1 mb-8">
                <h3 class="text-sm font-bold text-[#2b4c34] uppercase tracking-wider mb-3">Sinopsis</h3>
                
                {{-- Di sinilah kita memanggil $buku->sinopsis --}}
                @if($buku->sinopsis)
                    <p class="text-slate-600 leading-relaxed text-justify">
                        {{ $buku->sinopsis }}
                    </p>
                @else
                    <p class="text-slate-400 italic">Belum ada sinopsis untuk buku ini.</p>
                @endif
            </div>

            {{-- Tombol Navigasi --}}
            <div class="flex flex-wrap gap-3 mt-auto">
                <a href="{{ route('buku.index') }}" class="bg-[#f2f6ed] text-[#3c6e47] px-6 py-2.5 rounded-full text-sm font-bold hover:bg-[#e4ebd9] transition border border-[#d3e0c5]">
                    &larr; Kembali
                </a>
                
                @auth
                    <a href="{{ route('buku.edit', $buku) }}" class="bg-[#3c6e47] text-white px-8 py-2.5 rounded-full text-sm font-bold hover:bg-[#2b5234] shadow-sm transition">
                        Ubah Data
                    </a>
                @endauth
            </div>
        </div>
        
    </div>
</div>
@endsection