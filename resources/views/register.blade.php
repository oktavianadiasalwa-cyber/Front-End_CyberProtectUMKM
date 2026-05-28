<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - CyberProtect UMKM</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-[#1E1E1E] flex flex-col justify-center items-center min-h-screen font-sans">

    <div class="bg-white w-[400px] rounded-[24px] shadow-2xl p-8 relative flex flex-col justify-between">
        <div>
            <div class="flex flex-col items-center justify-center mt-4">
                <div class="flex items-center gap-2">
                    <i class="fa-solid fa-shield-halved text-[#001F5B] text-3xl"></i>
                    <h1 class="text-2xl font-bold text-[#001F5B] tracking-tight leading-none">
                        CyberProtect<br><span class="text-sm font-black tracking-widest block">UMKM</span>
                    </h1>
                </div>
                <p class="text-gray-500 text-xs mt-4 font-semibold">Buat Akun Baru Secara Bebas</p>
            </div>

            @if ($errors->any())
                <div class="bg-red-100 text-red-600 p-3 rounded-lg text-xs mt-4 font-bold">
                    {{ $errors->first() }}
                </div>
            @endif

            <form action="{{ route('register') }}" method="POST" class="mt-6">
                @csrf
                <div>
                    <label class="text-xs font-bold text-gray-700 block">Nama Lengkap/Username</label>
                    <input type="text" name="name" placeholder="Masukkan nama Anda" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 mt-1 text-sm focus:outline-none focus:border-[#001F5B]" required>
                </div>

                <div class="mt-4">
                    <label class="text-xs font-bold text-gray-700 block">Email</label>
                    <input type="email" name="email" placeholder="contoh@gmail.com" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 mt-1 text-sm focus:outline-none focus:border-[#001F5B]" required>
                </div>

                <div class="mt-4">
                    <label class="text-xs font-bold text-gray-700 block">Kata Sandi (Minimal 5 Karakter)</label>
                    <input type="password" name="password" placeholder="Buat kata sandi baru" class="w-full border border-gray-300 rounded-lg px-4 py-2.5 mt-1 text-sm focus:outline-none focus:border-[#001F5B]" required>
                </div>

                <button type="submit" class="w-full bg-[#001F5B] text-white py-3 rounded-lg mt-8 font-bold text-sm tracking-wide hover:bg-[#001744] uppercase">
                    DAFTAR & MASUK
                </button>
            </form>
        </div>

        <div class="text-center mt-6">
            <p class="text-xs text-gray-500">Sudah punya akun? <a href="{{ route('login.user') }}" class="text-blue-600 font-bold hover:underline">Masuk di sini</a></p>
        </div>
    </div>

</body>
</html>