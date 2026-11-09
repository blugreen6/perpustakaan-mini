{{-- Bagian form yang dipakai bersama oleh create dan edit --}}
<div class="space-y-5">
    <div>
        <label for="judul" class="block font-medium mb-1 text-[#2b4c34]">Judul</label>
        <input type="text" id="judul" name="judul"
            value="{{ old('judul', $buku->judul ?? '') }}"
            class="w-full rounded-lg border px-3 py-2 outline-none focus:ring-2 focus:ring-[#3c6e47] focus:border-transparent transition @error('judul') border-red-500 @else border-slate-300 @enderror">
        @error('judul')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="penulis" class="block font-medium mb-1 text-[#2b4c34]">Penulis</label>
        <input type="text" id="penulis" name="penulis" 
            value="{{ old('penulis', $buku->penulis ?? '') }}"
            class="w-full rounded-lg border px-3 py-2 outline-none focus:ring-2 focus:ring-[#3c6e47] focus:border-transparent transition @error('penulis') border-red-500 @else border-slate-300 @enderror">
        @error('penulis')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    {{-- Input Kolom Penerbit Baru --}}
    <div>
        <label for="penerbit" class="block font-medium mb-1 text-[#2b4c34]">Penerbit</label>
        <input type="text" id="penerbit" name="penerbit"
            value="{{ old('penerbit', $buku->penerbit ?? '') }}"
            class="w-full rounded-lg border px-3 py-2 outline-none focus:ring-2 focus:ring-[#3c6e47] focus:border-transparent transition @error('penerbit') border-red-500 @else border-slate-300 @enderror">
        @error('penerbit')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="tahun_terbit" class="block font-medium mb-1 text-[#2b4c34]">Tahun Terbit</label>
        <input type="number" id="tahun_terbit" name="tahun_terbit"
            value="{{ old('tahun_terbit', $buku->tahun_terbit ?? '') }}"
            class="w-40 rounded-lg border px-3 py-2 outline-none focus:ring-2 focus:ring-[#3c6e47] focus:border-transparent transition @error('tahun_terbit') border-red-500 @else border-slate-300 @enderror">
        @error('tahun_terbit')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>

    <div>
        <label for="sinopsis" class="block font-medium mb-1 text-[#2b4c34]">Sinopsis <span class="text-[#7c8e81] font-normal">(opsional)</span></label>
        <textarea id="sinopsis" name="sinopsis" rows="4"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 outline-none focus:ring-2 focus:ring-[#3c6e47] focus:border-transparent transition">{{ old('sinopsis', $buku->sinopsis ?? '') }}</textarea>
    </div>

    <div>
        <label for="cover_image" class="block font-medium mb-1 text-[#2b4c34]">Sampul Buku <span class="text-[#7c8e81] font-normal">(opsional, max 2MB)</span></label>
        {{-- Atribut name="cover_image" sudah ditambahkan di bawah ini --}}
        <input type="file" id="cover_image" name="cover_image" accept="image/*"
            class="w-full rounded-lg border border-slate-300 px-3 py-2 bg-white text-slate-600 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-[#f2f6ed] file:text-[#3c6e47] hover:file:bg-[#e4ebd9] transition outline-none focus:ring-2 focus:ring-[#3c6e47] focus:border-transparent">
        @error('cover_image')
            <p class="text-sm text-red-600 mt-1">{{ $message }}</p>
        @enderror
    </div>
</div>