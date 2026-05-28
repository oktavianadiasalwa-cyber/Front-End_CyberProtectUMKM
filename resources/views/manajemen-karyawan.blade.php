<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manajemen Karyawan - CyberProtect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>
<body class="bg-gray-50 flex items-stretch h-screen text-sm overflow-hidden">

    <aside class="w-64 bg-[#0B2046] text-white flex flex-col justify-between shrink-0">
        <div>
            <div class="p-6 flex items-center gap-2">
                <i class="fa-solid fa-shield-halved text-2xl"></i>
                <h1 class="font-bold leading-tight">CyberProtect<br>UMKM</h1>
            </div>
            <nav class="flex flex-col gap-2 px-4 mt-4">
                <a href="{{ route('dashboard') }}" class="py-2 hover:text-gray-300 {{ Route::is('dashboard') ? 'font-bold underline' : '' }}">
                    Transaksi & Fraud
                </a>

                <a href="{{ route('ringkasan-keamanan') }}" class="py-2 hover:text-gray-300 {{ Route::is('ringkasan-keamanan') ? 'font-bold underline' : '' }}">
                    Ringkasan Keamanan & Log Aktivitas Login
                </a>

                <a href="{{ route('manajemen-karyawan') }}" class="py-2 hover:text-gray-300 {{ Route::is('manajemen-karyawan') ? 'font-bold underline' : '' }}">
                    Manajemen Karyawan
                </a>

                <a href="{{ route('rule-based') }}" class="py-2 hover:text-gray-300 {{ Route::is('rule-based') ? 'font-bold underline' : '' }}">
                    Rule Based System
                </a>
            </nav>
        </div>
        <div class="p-6">
            <a href="{{ route('profil') }}" class="font-bold"><i class="fa-solid fa-user mr-2"></i> Profil</a>
        </div>
    </aside>

    <main class="flex-1 flex flex-col relative">
        <header class="bg-white border-b border-gray-200 p-4 flex justify-between items-center z-10">
            <h2 class="text-2xl font-bold text-[#0B2046]">Manajemen Karyawan</h2>

            <div class="flex items-center gap-4 relative">
                <button onclick="toggleElement('profilePopup')" class="flex items-center gap-2 font-semibold">
                    <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden"></div>
                    {{ auth()->user()->name ?? 'Username' }}
                </button>

                <button onclick="toggleElement('notifPopup')">
                    <i class="fa-regular fa-bell text-lg"></i>
                </button>

                <div id="profilePopup" class="hidden absolute top-12 right-10 w-48 bg-white border border-gray-200 shadow-lg rounded-xl p-4 text-center z-50">
                    <div class="flex items-center gap-2 font-bold mb-3 border-b pb-2">
                        <i class="fa-solid fa-user-circle text-gray-400 text-xl"></i>
                        {{ auth()->user()->name ?? 'USERNAME' }}
                    </div>
                    <a href="/login" class="block w-full bg-[#0B2046] text-white rounded py-2 text-center text-xs font-bold hover:bg-slate-800">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> LOG OUT
                    </a>
                </div>

                <div id="notifPopup" class="hidden absolute top-12 right-0 w-80 bg-white border border-gray-200 shadow-lg rounded-xl p-4 text-sm z-50">
                    <div class="flex gap-4">
                        <i class="fa-solid fa-triangle-exclamation text-red-500 text-xl mt-1"></i>
                        <div>
                            <p class="font-bold text-xs">
                                <span class="bg-red-200 text-red-800 px-1 rounded text-[10px]">PERINGATAN</span> 
                                Ancaman Keamanan Terdeteksi
                            </p>
                            <p class="text-xs text-gray-600 mt-1">Beberapa aktivitas login mencurigakan telah terdeteksi.</p>
                        </div>
                    </div>
                </div>
            </div>
        </header>

    <main class="flex-1 p-8 overflow-y-auto bg-gray-50">
    <div class="flex justify-between items-center mb-6">
        <div>
            <h2 class="text-4xl font-bold text-[#0B204]">Manajemen Karyawan</h2>
            <p class="text-gray-500 text-sm">Kelola hak akses dan akun staf kasir dengan kontrol keamanan tingkat tinggi.</p>
        </div>
        <button onclick="toggleModal('modalTambah')" class="bg-black text-white px-5 py-2.5 rounded-xl font-bold text-xs hover:bg-slate-800">
            <i class="fa-solid fa-user-plus mr-2"></i> TAMBAH AKUN KARYAWAN BARU
        </button>
    </div>

    <div class="bg-blue-50 border border-blue-100 p-4 rounded-xl mb-6 flex gap-3 text-sm text-blue-900">
        <i class="fa-solid fa-circle-info mt-1"></i>
        <p><span class="font-bold">Password dibuat langsung oleh Admin tanpa aktivasi email.</span><br>Pastikan untuk memberikan kredensial secara aman kepada staf yang bersangkutan setelah pembuatan akun.</p>
    </div>

    <div class="grid grid-cols-4 gap-4 mb-8">
        <div class="bg-white p-5 border rounded-2xl shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Total Akun Staf</p>
            <p class="text-3xl font-bold mt-1">12 <span class="text-xs text-green-500 font-bold ml-2">↑ 2</span></p>
        </div>
        <div class="bg-white p-5 border rounded-2xl shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Akun Aktif</p>
            <p class="text-3xl font-bold mt-1">10 <span class="text-xs text-green-500 font-bold ml-2">↑ 1</span></p>
        </div>
        <div class="bg-white p-5 border rounded-2xl shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Upaya Login (24H)</p>
            <p class="text-3xl font-bold mt-1">48 <span class="text-xs text-red-500 font-bold ml-2">↓ 3</span></p>
        </div>
        <div class="bg-white p-5 border rounded-2xl shadow-sm">
            <p class="text-[10px] font-bold text-gray-400 uppercase tracking-wider">Status Sistem</p>
            <p class="text-xl font-bold mt-1 text-green-500">Terlindungi</p>
        </div>
    </div>

    <div class="bg-white border rounded-2xl shadow-sm overflow-hidden">
        <div class="p-4 border-b flex justify-between items-center">
            <h3 class="font-bold text-lg">Daftar Akun Kasir</h3>
        </div>
        <table class="w-full text-left text-sm">
            <thead class="bg-gray-50 text-gray-400 uppercase text-[10px]">
                <tr>
                    <th class="p-4">Nama Lengkap</th>
                    <th class="p-4">Email</th>
                    <th class="p-4">Password Sementara</th>
                    <th class="p-4">Tanggal Dibuat</th>
                    <th class="p-4">Status</th>
                    <th class="p-4">Aksi</th>
                </tr>
            </thead>
            <tbody class="text-xs font-medium">
    <tr class="border-b">
        <td class="p-4 font-bold">Andini Putri</td>
        <td class="p-4 text-gray-600">andini.p@umkm.id</td>
        <td class="p-4"><span class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">CP_88291X</span></td>
        <td class="p-4 text-gray-500">12 Okt 2023</td>
        <td class="p-4">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" checked class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                <span class="ml-3 text-xs font-bold text-green-700 peer-checked:block hidden">Aktif</span>
                <span class="ml-3 text-xs font-bold text-gray-400 block peer-checked:hidden">Nonaktif</span>
            </label>
        </td>
        <td class="p-4">
            <button onclick="toggleModal('modalUbah')" class="mr-3 text-gray-500 hover:text-black"><i class="fa-solid fa-pen-to-square"></i></button>
            <button onclick="confirmAction('Hapus akun?')" class="text-gray-500 hover:text-red-600"><i class="fa-solid fa-trash"></i></button>
        </td>
    </tr>

    <tr class="border-b">
        <td class="p-4 font-bold">Budiono Sutrisno</td>
        <td class="p-4 text-gray-600">budiono.s@umkm.id</td>
        <td class="p-4"><span class="bg-gray-100 px-2 py-1 rounded text-xs font-mono">CP_00129Z</span></td>
        <td class="p-4 text-gray-500">15 Okt 2023</td>
        <td class="p-4">
            <label class="relative inline-flex items-center cursor-pointer">
                <input type="checkbox" class="sr-only peer">
                <div class="w-11 h-6 bg-gray-200 rounded-full peer peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all peer-checked:bg-green-600"></div>
                <span class="ml-3 text-xs font-bold text-green-700 peer-checked:block hidden">Aktif</span>
                <span class="ml-3 text-xs font-bold text-gray-400 block peer-checked:hidden">Nonaktif</span>
            </label>
        </td>
        <td class="p-4">
            <button onclick="toggleModal('modalUbah')" class="mr-3 text-gray-500 hover:text-black"><i class="fa-solid fa-pen-to-square"></i></button>
            <button onclick="confirmAction('Hapus akun?')" class="text-gray-500 hover:text-red-600"><i class="fa-solid fa-trash"></i></button>
        </td>
    </tr>
</tbody>
        </table>
    </div>
</main>

    <div id="modalTambah" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-3xl w-96 shadow-2xl">
            <h3 class="font-bold text-lg mb-4">Tambah Akun Karyawan Baru</h3>
            <div class="mb-4">
                <label class="block text-sm font-bold text-black-700 mb-1">Nama Lengkap</label>
                <input type="text" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-black-700 mb-1">Email</label>
                <input type="email" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-black-700 mb-1">Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="reg_password" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 pr-10">
                    <button type="button" onclick="togglePassword('reg_password', 'eyeIconReg')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="reg_password_confirm" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 pr-10">
                    <button type="button" onclick="togglePassword('reg_password_confirm', 'eyeIconConfirm')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                    </button>
                </div>
                <p id="errorText" class="text-red-500 text-xs font-semibold mt-1 hidden">Konfirmasi kata sandi tidak sesuai!</p>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Pilih Pertanyaan Keamanan (Untuk Lupa Sandi)</label>
                <select required class="w-full border border-gray-300 rounded px-3 py-2 bg-white focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 appearance-none text-gray-700">
                    <option value="" disabled selected>Pilih Pertanyaan</option>
                    <option value="lokasi">Nama Hewan Peliharaan Anda?</option>
                    <option value="hewan">Nama Ibu Kandung Anda?</option>
                    <option value="kota">Kota Kelahiran Anda?</option>
                </select>
            </div>
            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-1">Jawaban Keamanan</label>
                <input type="text" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <button onclick="toggleModal('modalTambah')" class="w-full bg-black text-white py-2 rounded-xl font-bold">Simpan Akun</button>
        </div>
    </div>

    <div id="modalUbah" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
        <div class="bg-white p-6 rounded-3xl w-96 shadow-2xl">
            <h3 class="font-bold text-lg mb-4">Ubah Data Karyawan</h3>
            <div class="mb-4">
                <label class="block text-sm font-bold text-black-700 mb-1">Nama Lengkap</label>
                <input type="text" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-black-700 mb-1">Email</label>
                <input type="email" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <div class="mb-4">
            <label class="block text-sm font-bold text-black-700 mb-1">Kata Sandi Saat Ini</label>
                <div class="relative">
                    <input type="password" id="reg_password" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 pr-10">
                    <button type="button" onclick="togglePassword('reg_password', 'eyeIconReg')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                    </button>
                </div>
            </div>
            <div class="mb-4">
            <label class="block text-sm font-bold text-black-700 mb-1">Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="reg_password" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 pr-10">
                    <button type="button" onclick="togglePassword('reg_password', 'eyeIconReg')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                    </button>
                </div>
            </div>
            <div class="mb-4">
                <label class="block text-sm font-bold text-gray-700 mb-1">Konfirmasi Kata Sandi</label>
                <div class="relative">
                    <input type="password" id="reg_password_confirm" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500 pr-10">
                    <button type="button" onclick="togglePassword('reg_password_confirm', 'eyeIconConfirm')" class="absolute inset-y-0 right-0 pr-3 flex items-center text-gray-500 focus:outline-none">
                    </button>
                </div>
                <p id="errorText" class="text-red-500 text-xs font-semibold mt-1 hidden">Konfirmasi kata sandi tidak sesuai!</p>
            </div>
            <div class="mb-8">
                <label class="block text-sm font-bold text-gray-700 mb-1">Jawaban Keamanan</label>
                <input type="text" required class="w-full border border-gray-300 rounded px-3 py-2 focus:outline-none focus:border-blue-500 focus:ring-1 focus:ring-blue-500">
            </div>
            <button onclick="toggleModal('modalUbah')" class="w-full bg-black text-white py-2 rounded-xl font-bold">Simpan Perubahan</button>
        </div>
    </div>

    <script>
        function toggleModal(id) { document.getElementById(id).classList.toggle('hidden'); }
        function toggleElement(id) { document.getElementById(id).classList.toggle('hidden'); }
        function confirmAction(msg) { if(confirm(msg)) { alert('Aksi berhasil dilakukan!'); } }
    </script>
</body>
</html>