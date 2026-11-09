<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Wajib ditambahkan untuk mengelola file gambar

class BukuController extends Controller
{
    // Menampilkan daftar buku (dengan pencarian)
    public function index(Request $request)
    {
        $cari = $request->query('cari');

        $daftarBuku = Buku::query()
            ->when($cari, function ($query, $cari) {
                $query->where('judul', 'like', "%{$cari}%")
                      ->orWhere('penulis', 'like', "%{$cari}%")
                      ->orWhere('penerbit', 'like', "%{$cari}%");
            })
            ->latest()
            ->paginate(6) // Saya ubah jadi 6 agar pas dengan grid 3 kolom
            ->withQueryString();

        return view('buku.index', compact('daftarBuku', 'cari'));
    }

    // Menampilkan form tambah buku
    public function create()
    {
        return view('buku.create');
    }

    // Menyimpan buku baru ke database
    public function store(Request $request)
    {
        $data = $request->validate($this->aturan(), $this->pesanError());

        // Jika user mengunggah gambar, simpan ke folder 'storage/app/public/covers'
        if ($request->hasFile('cover_image')) {
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        Buku::create($data);

        return redirect()->route('buku.index')
            ->with('sukses', 'Buku berhasil ditambahkan.');
    }

    // Menampilkan detail satu buku
    public function show(Buku $buku)
    {
        return view('buku.show', compact('buku'));
    }

    // Menampilkan form ubah buku
    public function edit(Buku $buku)
    {
        return view('buku.edit', compact('buku'));
    }

    // Menyimpan perubahan buku
    public function update(Request $request, Buku $buku)
    {
        $data = $request->validate($this->aturan(), $this->pesanError());

        // Jika user mengunggah gambar baru saat update
        if ($request->hasFile('cover_image')) {
            // Hapus gambar lama dari storage jika sebelumnya sudah ada
            if ($buku->cover_image) {
                Storage::disk('public')->delete($buku->cover_image);
            }
            // Simpan gambar baru
            $data['cover_image'] = $request->file('cover_image')->store('covers', 'public');
        }

        $buku->update($data);

        return redirect()->route('buku.index')
            ->with('sukses', 'Buku berhasil diperbarui.');
    }

    // Menghapus buku
    public function destroy(Buku $buku)
    {
        // Hapus file gambar dari server sebelum data bukunya dihapus dari database
        if ($buku->cover_image) {
            Storage::disk('public')->delete($buku->cover_image);
        }

        $buku->delete();

        return redirect()->route('buku.index')
            ->with('sukses', 'Buku berhasil dihapus.');
    }

    // Aturan validasi
    private function aturan(): array
    {
        return [
            'judul'        => 'required|string|max:255',
            'penulis'      => 'required|string|max:255',
            'penerbit'     => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1000|max:' . date('Y'),
            'sinopsis'     => 'nullable|string',
            'cover_image'  => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048', // Maksimal 2MB
        ];
    }

    // Pesan error berbahasa Indonesia
    private function pesanError(): array
    {
        return [
            'required' => ':attribute wajib diisi.',
            'string'   => ':attribute harus berupa teks.',
            'integer'  => ':attribute harus berupa angka.',
            'max'      => ':attribute tidak boleh lebih dari :max.',
            'min'      => ':attribute tidak boleh kurang dari :min.',
            'image'    => ':attribute harus berupa file gambar.',
            'mimes'    => 'Format :attribute yang diizinkan hanya jpeg, png, jpg, atau webp.',
        ];
    }
}