<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('judul', 'Koleksi Buku')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<!-- Latar belakang hijau sangat muda khas eco-friendly -->
<body class="min-h-screen bg-[#f4f7ed] text-slate-800 font-sans antialiased">

    {{-- Navigasi Mengambang (Floating Navbar) ala desain referensi --}}
    <div class="pt-6 px-4">
        <nav class="max-w-5xl mx-auto bg-white rounded-full shadow-sm px-6 py-3 flex items-center justify-between">
            <a href="{{ route('buku.index') }}" class="text-2xl font-extrabold text-[#2b4c34] tracking-tight">
                Mini<span class="text-sm font-medium ml-2 text-slate-400">Library</span>
            </a>
            
            <div class="flex items-center gap-6 text-sm font-semibold text-[#2b4c34]">
                @auth
                    <span class="hidden md:inline">Halo, {{ Auth::user()->name }}</span>
                    <form method="POST" action="{{ route('logout') }}" class="m-0">
                        @csrf
                        <button type="submit" class="bg-[#3c6e47] text-white hover:bg-[#2b5234] px-5 py-2 rounded-full transition">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="hover:text-[#3c6e47] transition">Log in</a>
                    <a href="{{ route('register') }}" class="bg-[#3c6e47] text-white hover:bg-[#2b5234] px-5 py-2 rounded-full transition">Register</a>
                @endauth
            </div>
        </nav>
    </div>

    <main class="max-w-5xl mx-auto px-4 py-8">
        {{-- Flash message jika berhasil tambah/ubah/hapus --}}
        @if (session('sukses'))
            <div class="mb-6 rounded-full bg-[#dcfce7] border border-[#bbf7d0] text-[#166534] px-6 py-3 text-sm font-medium text-center shadow-sm">
                {{ session('sukses') }}
            </div>
        @endif

        @yield('konten')
        {{ $slot ?? '' }}
    </main>

</body>
</html>