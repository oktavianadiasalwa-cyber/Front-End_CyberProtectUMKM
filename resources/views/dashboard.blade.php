<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi & Fraud - CyberProtect</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* Memperbaiki dropdown yang terpotong */
        .overflow-hidden { overflow: visible !important; }
    </style>
</head>
<body class="bg-gray-50 flex items-stretch h-screen text-sm overflow-hidden">

    <aside class="w-64 bg-[#0B2046] text-white flex flex-col justify-between">
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
            <h2 class="text-2xl font-bold text-[#0B2046]">Transaksi & Fraud</h2>
            
            <div class="flex items-center gap-4 relative">
                <button onclick="toggleElement('profilePopup')" class="flex items-center gap-2 font-semibold">
                    <div class="w-8 h-8 rounded-full bg-gray-300 overflow-hidden"></div>
                    {{ auth()->user()->name ?? 'Username' }}
                </button>
                
                <button onclick="toggleElement('notifPopup')"><i class="fa-regular fa-bell text-lg"></i></button>

                <div id="profilePopup" class="hidden absolute top-12 right-10 w-48 bg-white border border-gray-200 shadow-lg rounded-xl p-4 text-center z-50">
                    <div class="flex items-center gap-2 font-bold mb-3 border-b pb-2">
                        <i class="fa-solid fa-user text-gray-400 text-xl"></i>
                        {{ auth()->user()->name ?? 'USERNAME' }}
                    </div>
                    <a href="/login" class="block w-full bg-[#0B2046] text-white rounded py-2 text-center text-xs font-bold hover:bg-slate-800">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i> LOG OUT
                    </a>
                </div>

                <div id="notifPopup" class="hidden absolute top-12 right-0 w-80 bg-white border border-gray-200 shadow-xl rounded-xl p-4 z-50">
                    <h3 class="font-bold text-center mb-3 text-base">Semua Notifikasi Keamanan</h3>
                    <div class="space-y-2 max-h-64 overflow-y-auto">
                        <div class="border border-blue-300 bg-blue-50 p-2 rounded flex gap-2">
                            <i class="fa-solid fa-circle-info text-blue-500 mt-1"></i>
                            <div>
                                <p class="font-bold text-xs"><span class="bg-blue-200 text-blue-800 px-1 rounded text-[10px]">INFO</span> Update Sistem</p>
                                <p class="text-xs text-gray-600">Sistem mengirim notifikasi tentang update...</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <div class="p-6 overflow-y-auto flex-1 bg-gray-50">
            <div id="viewTable">
                <div class="flex gap-4 mb-6 bg-white p-3 border rounded-xl shadow-sm justify-center max-w-4xl mx-auto">
                    <input type="text" placeholder="Nama Kasir atau ID..." class="border rounded px-3 py-1 text-xs w-48">
                    <input type="date" class="border rounded px-3 py-1 text-xs w-40">
                    <select id="statusFilter" onchange="filterTable()" class="border rounded px-3 py-1 text-xs w-40">
                        <option value="all">Semua Status</option>
                        <option value="SUKSES">Sukses</option>
                        <option value="MENCURIGAKAN">Mencurigakan</option>
                    </select>
                    <button class="bg-teal-700 text-white px-4 py-1 rounded text-xs font-bold"><i class="fa-solid fa-filter"></i> TERAPKAN FILTER</button>
                </div>

                <div class="bg-white border rounded-xl shadow-sm overflow-hidden mb-6">
                    <table class="w-full text-left text-xs">
                        <thead class="bg-gray-50 text-black-500 text-xl font-bold uppercase border-b">
                            <tr>
                                <th class="p-3">LOGIN KARYAWAN</th>
                            </tr>
                        </thead>
                        <thead class="bg-gray-50 text-gray-500 font-bold uppercase border-b">
                            <tr>
                                <th class="p-3">ID Transaksi</th>
                                <th class="p-3">Nama User</th>
                                <th class="p-3">Jumlah (Rp)</th>
                                <th class="p-3">Tanggal/Waktu</th>
                                <th class="p-3">Status</th>
                                <th class="p-3 text-center">Tindakan</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b data-row" data-status="MENCURIGAKAN"> 
                                <td class="p-3">#TRX-8829-01</td>
                                <td class="p-3 font-bold"><i class="fa-solid fa-circle-user"></i> Andi Darmawan</td>
                                <td class="p-3 text-red-600 font-bold">Rp 300.000</td>
                                <td class="p-3 text-gray-500">24 Okt 2023, 14:22</td>
                                <td class="p-3 relative">
                                    <button onclick="toggleElement('statusPop1')" class="bg-red-200 text-red-700 px-2 py-1 rounded-full font-bold text-[10px]">&bull; MENCURIGAKAN</button>
                                    <div id="statusPop1" class="hidden absolute bg-white border shadow p-1 rounded mt-1 z-10 w-32">
                                        <button class="block w-full text-left px-2 py-1 hover:bg-gray-100 text-green-600 font-bold text-xs">Sukses</button>
                                        <button class="block w-full text-left px-2 py-1 hover:bg-gray-100 text-red-600 font-bold text-xs">Mencurigakan</button>
                                    </div>
                                </td>
                                <td class="p-3 flex items-center justify-center gap-2" id="action-1">
                                    <button onclick="switchView('viewInvoice')" class="text-gray-400 hover:text-gray-700"><i class="fa-solid fa-eye"></i></button>
                                    <button onclick="verifikasiAction('action-1')" class="bg-green-600 text-white px-2 py-1 rounded font-bold text-[10px]">SETUJUI</button>
                                    <button onclick="verifikasiAction('action-1')" class="bg-red-500 text-white px-2 py-1 rounded font-bold text-[10px]">TOLAK</button>
                                </td>
                            </tr>
                            <tr class="border-b data-row" data-status="SUKSES"> 
                                <td class="p-3">#TRX-8089-01</td>
                                <td class="p-3 font-bold"><i class="fa-solid fa-circle-user"></i> Aysa Andrian</td>
                                <td class="p-3 text-gray-600 font-bold"> Rp 50.000</td>
                                <td class="p-3 text-gray-500">24 Okt 2023, 14:22</td>
                                <td class="p-3">
                                    <span class="bg-green-200 text-green-700 px-2 py-1 rounded-full font-bold text-[10px]">&bull; SUKSES</span>
                                </td>
                                <td class="p-3 flex items-center justify-center gap-2">
                                    <button onclick="switchView('viewInvoice')" class="text-gray-400 hover:text-gray-700"><i class="fa-solid fa-eye"></i></button>
                                    <span class="text-gray-500 font-bold text-[10px]">AMAN</span> 
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
               <div id="statsCards" class="grid grid-cols-4 gap-4 mb-6">
                <div class="bg-white p-4 border rounded-xl shadow-sm text-center">
                    <p class="text-xs font-bold text-gray-500">JUMLAH SUKSES <i class="fa-solid fa-circle-check text-green-500"></i></p>
                    <p class="text-3xl font-bold mt-2">124 <span class="text-xs text-green-500">&uarr; 8%</span></p>
                </div>
                <div class="bg-white p-4 border rounded-xl shadow-sm text-center">
                    <p class="text-xs font-bold text-gray-500">TRANSAKSI MENCURIGAKAN <i class="fa-solid fa-triangle-exclamation text-red-500"></i></p>
                    <p class="text-3xl font-bold mt-2">12 <span class="text-xs text-red-500">&darr; 2%</span></p>
                </div>
                <div class="bg-white p-4 border rounded-xl shadow-sm text-center">
                    <p class="text-xs font-bold text-gray-500">STATUS KEAMANAN SISTEM <i class="fa-solid fa-shield-halved text-green-500"></i></p>
                    <p class="text-2xl font-bold text-green-500 mt-2">Sistem Aman/Normal <span class="text-xs text-green-500">&uarr; 100%</span></p>
                </div>
                <div class="bg-white p-4 border rounded-xl shadow-sm text-center">
                    <p class="text-xs font-bold text-gray-500">TOTAL OMZET HARI INI <i class="fa-solid fa-coins text-blue-500"></i></p>
                    <p class="text-xl font-bold mt-2">Rp 7.000.000 <span class="text-xs text-blue-500">&uarr; 2%</span></p>
                </div>
            </div>
            </div>

            <div id="viewInvoice" class="hidden">
                <button onclick="switchView('viewTable')" class="font-bold text-lg mb-4 hover:text-blue-700">
                    <i class="fa-solid fa-angle-left"></i> Kembali
                </button>
                <div class="bg-white border-2 border-blue-400 p-8 rounded-xl shadow-sm max-w-4xl mx-auto">
                    <div class="flex justify-between items-start border-b pb-6 mb-6">
                        <div class="flex gap-2">
                            <i class="fa-solid fa-store text-2xl text-blue-800"></i>
                            <div>
                                <h3 class="font-bold text-blue-900 text-lg">Alneyra Coffe</h3>
                                <p class="text-xs text-gray-500">Jl. Sudirman No.123... <br> Telp: (021) 555-0192</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <span class="bg-blue-100 text-blue-800 px-3 py-1 rounded-full font-bold text-xs">INVOICE</span>
                            <p class="text-xs mt-2 text-gray-500">ID Transaksi<br>#TRX-882910</p>
                        </div>
                    </div>
                    <div class="bg-gray-100 p-6 rounded-lg mb-6">
                    <div class="grid grid-cols-4 gap-4">
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Tanggal</p>
                            <p class="font-bold">24 Okt 2025</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Kasir</p>
                            <p class="font-bold">Andi Darmawan</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Metode Bayar</p>
                            <p class="font-bold"><i class="fa-solid fa-qrcode"></i> QRIS</p>
                        </div>
                        <div>
                            <p class="text-xs text-gray-500 font-bold uppercase">Status</p>
                            <span class="bg-blue-200 text-blue-700 px-3 py-1 rounded text-xs font-bold">Selesai</span>
                        </div>
                    </div>
                </div>
                <table class="w-full text-left mb-6">
                    <thead>
                        <tr class="text-gray-500 border-b text-xs uppercase">
                            <th class="py-2">Item</th>
                            <th class="py-2 text-right">Harga Satuan</th>
                            <th class="py-2 text-center">Qty</th>
                            <th class="py-2 text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody class="text-sm">
                        <tr class="border-b">
                            <td class="py-3 font-bold">Chocolate Cake</td>
                            <td class="py-3 text-right">Rp 15.000</td>
                            <td class="py-3 text-center">1</td>
                            <td class="py-3 text-right">Rp 15.000</td>
                        </tr>
                        </tbody>
                </table>
                <table class="w-full text-left mb-6">
                    <tbody class="text-sm">
                        <tr class="border-b">
                            <td class="py-3 font-bold">Brown Sugar Latte</td>
                            <td class="py-3 text-right">Rp 20.000</td>
                            <td class="py-3 text-center">2</td>
                            <td class="py-3 text-right">Rp 40.000</td>
                        </tr>
                        </tbody>
                </table>
                <div class="flex justify-end">
                    <div class="w-64 space-y-2">
                        <div class="flex justify-between text-sm">
                            <span>Subtotal</span>
                            <span class="font-bold">Rp 55.000</span>
                        </div>
                        <div class="flex justify-between text-sm">
                            <span>PPN (10%)</span>
                            <span class="font-bold">Rp 5.500</span>
                        </div>
                        <div class="flex justify-between text-lg border-t pt-2 font-bold">
                            <span>Total</span>
                            <span>Rp 60.500</span>
                        </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        function toggleElement(id) {
            document.getElementById(id).classList.toggle('hidden');
        }

        function switchView(targetId) {
            document.getElementById('viewTable').classList.add('hidden');
            document.getElementById('viewInvoice').classList.add('hidden');
            document.getElementById(targetId).classList.remove('hidden');
        }

        function filterTable() {
            const filter = document.getElementById('statusFilter').value;
            const rows = document.querySelectorAll('.data-row');
            rows.forEach(row => {
                row.style.display = (filter === 'all' || row.getAttribute('data-status') === filter) ? '' : 'none';
            });
        }

        function verifikasiAction(containerId) {
            const container = document.getElementById(containerId);
            container.innerHTML = `
                <button onclick="switchView('viewInvoice')" class="text-gray-400 hover:text-gray-700"><i class="fa-solid fa-eye"></i></button>
                <span class="text-gray-400 font-bold text-[10px] ml-2">SUDAH DIVERIFIKASI</span>
            `;
        }
    </script>
</body>
</html>