<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil - CyberProtect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-stretch h-screen text-sm overflow-hidden">

    <aside class="w-64 bg-[#0B2046] text-white flex flex-col justify-between shrink-0 h-full">
        <div>
            <div class="p-6 flex items-center gap-2">
                <i class="fa-solid fa-shield-halved text-2xl"></i>
                <h1 class="font-bold leading-tight">CyberProtect<br>UMKM</h1>
            </div>
            <nav class="flex flex-col gap-2 px-4 mt-4">
                <a href="{{ route('dashboard') }}" class="hover:text-gray-300 py-2 {{ Route::is('dashboard') ? 'font-bold underline' : '' }}">Transaksi & Fraud</a>
                <a href="{{ route('ringkasan-keamanan') }}" class="hover:text-gray-300 py-2 {{ Route::is('ringkasan-keamanan') ? 'font-bold underline' : '' }}">Ringkasan Keamanan & Log Aktivitas</a>
                <a href="{{ route('manajemen-karyawan') }}" class="hover:text-gray-300 py-2 {{ Route::is('manajemen-karyawan') ? 'font-bold underline' : '' }}">Manajemen Karyawan</a>
                <a href="{{ route('rule-based') }}" class="hover:text-gray-300 py-2 {{ Route::is('rule-based') ? 'font-bold underline' : '' }}">Rule Based System</a>
            </nav>
        </div>
        <div class="p-6">
            <a href="{{ route('profil') }}" class="font-bold hover:text-gray-300 {{ Route::is('profil') ? 'underline' : '' }}">
                <i class="fa-solid fa-user mr-2"></i> Profil
            </a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col relative h-full overflow-y-auto">
        <header class="bg-white border-b border-gray-200 p-4 flex justify-between items-center z-10">
            <h2 class="text-2xl font-bold text-[#0B2046]">Profil</h2>

            <div class="flex items-center gap-4 relative">
                <button onclick="toggleElement('profilePopup')" class="flex items-center gap-2 font-semibold">
                    <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden"></div>
                    {{ auth()->user()->name ?? 'Username' }}
                </button>

                <button onclick="toggleElement('notifPopup')"><i class="fa-regular fa-bell text-lg"></i></button>

                <div id="profilePopup" class="hidden absolute top-12 right-10 w-48 bg-white border border-gray-200 shadow-lg rounded-xl p-4 text-center z-50">
                    <div class="flex items-center gap-2 font-bold mb-3 border-b pb-2">
                        <i class="fa-solid fa-user-circle text-gray-400 text-xl"></i>
                        {{ auth()->user()->name ?? 'Username' }}
                    </div>
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="block w-full bg-[#0B2046] text-white rounded py-2 text-center text-xs font-bold hover:bg-slate-800">
                            <i class="fa-solid fa-arrow-right-from-bracket"></i> LOG OUT
                        </button>
                    </form>
                </div>

                <div id="notifPopup" class="hidden absolute top-12 right-0 w-80 bg-white border border-gray-200 shadow-lg rounded-xl p-4 text-sm z-50">
                    <div class="flex gap-4 mb-4">
                        <i class="fa-solid fa-triangle-exclamation text-red-500 text-xl"></i>
                        <div>
                            <p class="font-bold text-xs"><span class="bg-red-200 text-red-800 px-1 rounded text-[10px]">PERINGATAN</span> Ancaman Keamanan Terdeteksi</p>
                            <p class="text-xs text-gray-600">Beberapa aktivitas login mencurigakan telah terdeteksi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-8 flex-1 flex flex-col justify-start">
            <div class="bg-white p-6 rounded-2xl border shadow-sm w-full max-w-md mx-auto">
                
                <div class="flex flex-col items-center mb-5">
                    <div class="w-24 h-24 rounded-full bg-gray-100 flex items-center justify-center mb-2 border">
                        <i class="fa-solid fa-user text-4xl text-gray-400"></i>
                    </div>
                    <p class="font-bold text-gray-700 text-xs">Foto Profil</p>
                </div>

                <div class="space-y-3">
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Nama UMKM</label>
                        <input type="text" value="{{ auth()->user()->name ?? 'Toko Maju Jaya' }}" class="w-full border border-gray-200 px-3 py-2 rounded-xl bg-gray-50 focus:outline-none text-xs" readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Email</label>
                        <input type="email" value="{{ auth()->user()->email ?? 'admin@majujaya.com' }}" class="w-full border border-gray-200 px-3 py-2 rounded-xl bg-gray-50 focus:outline-none text-xs" readonly>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Alamat UMKM</label>
                        <div class="relative">
                            <input type="text" class="w-full border border-gray-300 px-3 py-2 rounded-xl focus:outline-none text-xs pr-10" placeholder="Masukkan alamat" value="Jl. Merdeka No. 123, Jakarta">
                        </div>
                    </div>
                    <div>
                        <label class="block text-xs font-bold text-gray-600 mb-1">Kata Sandi</label>
                        <div class="relative">
                            <input type="password" value="********" readonly class="w-full border border-gray-300 px-3 py-2 rounded-xl text-xs pr-10 bg-gray-50">
                            <button onclick="toggleModal('modalPassword')" class="absolute right-3 top-2.5">
                                <i class="fa-solid fa-pencil text-gray-400 text-xs"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="flex gap-3 mt-6">
                    <button class="flex-1 bg-[#0B2046] hover:bg-slate-800 text-white py-2.5 rounded-xl font-bold text-xs transition">Simpan</button>
                    <button onclick="toggleModal('modalLogout')" class="px-4 border border-red-500 text-red-500 hover:bg-red-50 rounded-xl font-bold text-xs transition">Log Out</button>
                </div>
            </div>
        </div>

        <div id="modalPassword" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl w-80 shadow-2xl">
                <h3 class="text-base font-bold mb-4 text-center text-[#0B2046]">Ubah Kata Sandi Baru</h3>
                <form action="#" method="POST" class="space-y-3" onsubmit="event.preventDefault(); toggleModal('modalPassword');">
                    @csrf
                    <input type="password" placeholder="Kata Sandi Saat Ini" class="w-full border p-2 rounded-lg text-xs">
                    <input type="password" placeholder="Kata Sandi Baru" class="w-full border p-2 rounded-lg text-xs">
                    <input type="password" placeholder="Konfirmasi Kata Sandi Baru" class="w-full border p-2 rounded-lg text-xs">
                    <input type="text" placeholder="Jawaban Keamanan" class="w-full border p-2 rounded-lg text-xs">
                    <div class="flex gap-2 pt-2">
                        <button type="button" onclick="toggleModal('modalPassword')" class="flex-1 py-2 border rounded-lg text-xs">Batal</button>
                        <button type="submit" class="flex-1 py-2 bg-[#0B2046] text-white rounded-lg text-xs">Simpan</button>
                    </div>
                </form>
            </div>
        </div>

        <div id="modalLogout" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
            <div class="bg-white p-6 rounded-2xl w-72 text-center shadow-2xl">
                <i class="fa-solid fa-right-from-bracket text-3xl text-red-500 mb-3"></i>
                <h3 class="font-bold text-sm mb-2">Konfirmasi Log Out</h3>
                <p class="text-xs text-gray-500 mb-5">Apakah Anda yakin ingin keluar?</p>
                <div class="flex flex-col gap-2">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button class="w-full py-2 bg-red-600 hover:bg-red-700 text-white rounded-lg font-bold text-xs">YA, LOG OUT</button>
                    </form>
                    <button onclick="toggleModal('modalLogout')" class="w-full py-2 bg-gray-200 text-gray-700 rounded-lg font-bold text-xs">BATAL</button>
                </div>
            </div>
        </div>
    </main>

    <script>
    function toggleModal(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
    function toggleElement(id) {
        document.getElementById(id).classList.toggle('hidden');
    }
    </script>
</body>
</html>