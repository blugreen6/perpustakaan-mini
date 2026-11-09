@extends ('layouts.app')
@section('judul', 'Ubah Buku')

@section('konten')
<div class="max-w-3xl mx-auto mt-8">
    <div class="bg-white rounded-[2rem] p-6 md:p-10 shadow-sm border border-slate-100">
        <h1 class="text-3xl font-extrabold text-[#2b4c34] mb-8">Ubah Buku</h1>
        
        <form action="{{ route('buku.update', $buku) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('buku._form')
            
            <div class="mt-8 flex flex-wrap gap-3">
                <button type="submit" class="bg-[#3c6e47] text-white px-8 py-2.5 rounded-full text-sm font-bold hover:bg-[#2b5234] shadow-sm transition">
                    Simpan Perubahan
                </button>
                <a href="{{ route('buku.index') }}" class="bg-[#f2f6ed] text-[#3c6e47] px-6 py-2.5 rounded-full text-sm font-bold hover:bg-[#e4ebd9] transition border border-[#d3e0c5]">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection