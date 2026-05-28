<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>POS - CyberProtect UMKM</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"/>

    <style>

        ::-webkit-scrollbar{
            width:6px;
        }

        ::-webkit-scrollbar-thumb{
            background:#cbd5e1;
            border-radius:20px;
        }

    </style>

</head>

<body class="bg-[#EBEBEB] flex h-screen overflow-hidden font-sans">

    {{-- SIDEBAR --}}
    <aside class="w-64 bg-[#010915] text-white flex flex-col justify-between p-6 flex-shrink-0 h-full">

        <div>

            {{-- LOGO --}}
            <div class="flex items-center gap-3 mb-12">

                <i class="fa-solid fa-shield-halved text-blue-500 text-3xl"></i>

                <div>
                    <h1 class="text-2xl font-black leading-none uppercase">
                        CyberProtect
                    </h1>

                    <span class="text-xs tracking-[4px] text-gray-300">
                        UMKM
                    </span>
                </div>

            </div>

            {{-- MENU --}}
            <nav class="space-y-3">

                <a href="{{ route('dashboard') }}"
                    class="flex items-center gap-4 text-gray-400 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition-all">

                    <i class="fa-solid fa-house text-lg"></i>
                    <span class="font-medium">Dashboard</span>

                </a>

                <a href="{{ route('pos') }}"
                    class="flex items-center gap-4 text-blue-400 bg-blue-500/10 p-4 rounded-2xl font-semibold">

                    <i class="fa-solid fa-desktop text-lg"></i>
                    <span>POS</span>

                </a>

                <a href="{{ route('history') }}"
                    class="flex items-center gap-4 text-gray-400 hover:text-white p-4 rounded-2xl hover:bg-white/5 transition-all">

                    <i class="fa-solid fa-clock-rotate-left text-lg"></i>
                    <span class="font-medium">History</span>

                </a>

            </nav>

        </div>

        {{-- PROFIL BAWAH --}}
        <div class="border-t border-gray-800 pt-6">

            <a href="{{ route('profile') }}"
                class="flex items-center gap-3 hover:bg-white/5 p-3 rounded-2xl transition-all">

                <div class="w-11 h-11 rounded-full bg-gray-700 flex items-center justify-center">

                    <i class="fa-solid fa-user text-white"></i>

                </div>

                <div class="overflow-hidden">

                    <p class="font-semibold truncate">
                        {{ Auth::user()->name }}
                    </p>

                    <p class="text-xs text-gray-400 truncate">
                        {{ Auth::user()->email }}
                    </p>

                </div>

            </a>

        </div>

    </aside>

    {{-- MAIN --}}
    <main class="flex-1 overflow-y-auto p-8">

        {{-- HEADER --}}
        <header class="flex justify-between items-center border-b border-gray-300 pb-5 mb-6">

            <h2 class="text-4xl font-black text-gray-800">
                POS (Point of Sales)
            </h2>

            <div class="flex items-center gap-3 relative">

                {{-- PROFIL --}}
                <button id="profileBtn"
                    class="bg-white rounded-xl shadow-sm border border-gray-200 px-4 py-2 flex items-center gap-3 hover:shadow transition-all">

                    <span class="text-sm font-semibold text-gray-700">
                        {{ Auth::user()->name }}
                    </span>

                    <i class="fa-solid fa-circle-user text-2xl text-gray-500"></i>
                </button>

                {{-- DROPDOWN PROFIL --}}
                <div id="profileDropdown"
                    class="hidden absolute top-16 right-20 w-64 bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden z-50">

                    {{-- INFO USER --}}
                    <div class="px-5 py-4 border-b">

                        <h3 class="font-bold text-gray-800 text-lg">
                            {{ Auth::user()->name }}
                        </h3>

                        <p class="text-sm text-gray-400 truncate">
                            {{ Auth::user()->email }}
                        </p>

                    </div>

                    {{-- MENU PROFIL --}}
                    <a href="{{ route('profile') }}"
                        class="flex items-center gap-3 px-5 py-4 hover:bg-gray-50 transition text-gray-700">

                        <i class="fa-solid fa-user-gear text-gray-500"></i>

                        <span class="font-medium">
                            Pengaturan Profil
                        </span>

                    </a>

                    {{-- LOGOUT --}}
                    <button id="logoutBtn"
                        class="w-full flex items-center gap-3 px-5 py-4 hover:bg-red-50 transition text-red-500">

                        <i class="fa-solid fa-right-from-bracket"></i>

                        <span class="font-medium">
                            Keluar Sistem
                        </span>

                    </button>

                </div>

                {{-- TOMBOL NOTIFIKASI --}}
                <button id="notifBtn" class="bg-white rounded-xl shadow-sm border border-gray-200 p-2.5 flex items-center justify-center relative hover:shadow transition-all">
                    <i class="fa-regular fa-bell text-xl text-gray-600"></i>
                    <span id="notifBadge" class="absolute top-2 right-2.5 w-2 h-2 bg-red-500 rounded-full"></span>
                </button>

                {{-- DROPDOWN NOTIFIKASI --}}
                <div id="notifDropdown"
                    class="hidden absolute top-16 right-0 w-[420px] bg-white rounded-2xl shadow-xl border border-gray-200 overflow-hidden z-50">

                    {{-- HEADER --}}
                    <div class="flex items-center justify-between px-5 py-4 border-b border-gray-150">

                        <h2 class="text-base font-bold text-gray-800">
                            Pemberitahuan Sistem
                        </h2>

                        <button id="markAsReadBtn" class="text-xs text-blue-500 font-semibold hover:text-blue-700 transition-all">
                            Tandai dibaca
                        </button>

                    </div>

                    {{-- ISI --}}
                    <div class="max-h-[350px] overflow-y-auto">

                        {{-- NOTIF MERAH --}}
                        <div class="bg-red-50/70 px-5 py-4 flex gap-4 border-b border-gray-100">

                            <div class="w-10 h-10 rounded-full bg-red-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-triangle-exclamation text-red-500 text-sm"></i>
                            </div>

                            <div class="flex-1">

                                <h3 class="text-sm font-bold text-gray-800 mb-0.5">
                                    Percobaan Akses Diblokir!
                                </h3>

                                <p class="text-gray-600 text-xs leading-relaxed">
                                    Sistem CyberProtect mendeteksi dan memblokir 1 percobaan login ilegal dari perangkat tidak dikenal.
                                </p>

                                <span class="inline-block mt-2 bg-red-100 text-red-700 font-bold text-[10px] px-2 py-0.5 rounded-md">
                                    CYBERPROTECT
                                </span>

                            </div>

                        </div>

                        {{-- NOTIF HIJAU --}}
                        <div class="px-5 py-4 flex gap-4 border-b border-gray-100">

                            <div class="w-10 h-10 rounded-full bg-green-100 flex items-center justify-center flex-shrink-0">
                                <i class="fa-solid fa-check text-green-600 text-sm"></i>
                            </div>

                            <div class="flex-1">

                                <h3 class="text-sm font-bold text-gray-800 mb-0.5">
                                    Pembayaran QRIS Berhasil
                                </h3>

                                <p class="text-gray-600 text-xs leading-relaxed">
                                    Dana pembayaran sebesar <span class="font-bold text-gray-800">Rp 60.500</span> telah berhasil diterima.
                                </p>

                                <span class="inline-block mt-2 bg-green-100 text-green-700 font-bold text-[10px] px-2 py-0.5 rounded-md">
                                    KASIR POS
                                </span>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- MODAL LOGOUT --}}
            <div id="logoutModal"
                class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">

                <div class="bg-white w-full max-w-sm rounded-3xl p-8 shadow-2xl">

                    <div class="text-center">

                        <div class="w-20 h-20 mx-auto rounded-full bg-blue-50 flex items-center justify-center mb-5">
                            <i class="fa-solid fa-right-from-bracket text-4xl text-[#0B2D73]"></i>
                        </div>

                        <h2 class="text-2xl font-bold text-gray-800 mb-3">
                            Konfirmasi Log Out
                        </h2>

                        <p class="text-gray-500 mb-8 leading-relaxed text-sm">
                            Apakah Anda yakin ingin keluar dari
                            <br>
                            <span class="font-semibold text-gray-700">
                                CyberProtect UMKM?
                            </span>
                        </p>

                        <div class="space-y-3">

                            <a href="{{ route('logout') }}"
                                class="w-full bg-[#0B2D73] hover:bg-[#133a8d] text-white font-semibold py-3 rounded-xl flex items-center justify-center gap-2 transition-all">
                                <i class="fa-solid fa-arrow-right-from-bracket"></i>
                                YA, LOG OUT
                            </a>

                            <button id="closeLogoutModal"
                                class="w-full bg-gray-300 hover:bg-gray-400 text-gray-700 font-semibold py-3 rounded-xl transition-all">
                                TIDAK, KEMBALI
                            </button>

                        </div>

                    </div>

                </div>

            </div>

        </header>

        {{-- CONTENT --}}
        <div class="grid grid-cols-12 gap-6">

            {{-- LEFT --}}
            <div class="col-span-12 lg:col-span-7 space-y-6">

                {{-- CARD --}}
                <div class="grid grid-cols-1 md:grid-cols-2 gap-5">

                    {{-- DATA PELANGGAN --}}
                    <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6">

                        <h3 class="text-2xl font-black text-gray-800 mb-6">
                            Data Pelanggan
                        </h3>

                        <div class="space-y-5">

                            <div>

                                <label class="block text-sm font-semibold text-gray-600 mb-2">
                                    Nama Pelanggan
                                </label>

                                <input type="text"
                                    placeholder="Cari atau masukkan nama"
                                    class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">

                            </div>

                            <div>

                                <label class="block text-sm font-semibold text-gray-600 mb-2">
                                    Loyalty ID
                                </label>

                                <div class="flex gap-3">

                                    <input type="text"
                                        placeholder="Cari ID"
                                        class="flex-1 border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">

                                    <button
                                        class="w-12 rounded-xl bg-blue-500 hover:bg-blue-600 text-white transition-all">
                                        <i class="fa-solid fa-plus"></i>
                                    </button>

                                </div>

                            </div>

                        </div>

                    </div>

                    {{-- INPUT PRODUK --}}
                    <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6">

                        <h3 class="text-2xl font-black text-gray-800 mb-6">
                            Input Produk
                        </h3>

                        <div class="space-y-5">

                            <div>

                                <label class="block text-sm font-semibold text-gray-600 mb-2">
                                    Scan/Pilih Produk
                                </label>

                                <div class="relative">

                                    <input type="text"
                                        placeholder="Masukkan barcode"
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">

                                    <i class="fa-solid fa-magnifying-glass absolute right-4 top-4 text-gray-400"></i>

                                </div>

                            </div>

                            <div class="flex gap-3 items-end">

                                <div class="flex-1">

                                    <label class="block text-sm font-semibold text-gray-600 mb-2">
                                        Kategori
                                    </label>

                                    <select
                                        class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-blue-500">
                                        <option>Semua Kategori</option>
                                    </select>

                                </div>

                                <button id="btn-buka-produk"
    class="bg-[#0B2D73] hover:bg-[#143d93] text-white px-5 py-3 rounded-xl font-semibold transition-all">
    <i class="fa-solid fa-cart-plus mr-2"></i>
    Tambah
</button>


                            </div>

                        </div>

                    </div>

                </div>

                {{-- DETAIL ITEM --}}
                <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6">

                    <h3 class="text-4xl font-black text-gray-800 mb-6">
                        Detail Item Terpilih
                    </h3>

                    <div class="border border-gray-300 rounded-2xl overflow-hidden">

                        <table class="w-full">

                            <thead class="bg-gray-100">

                                <tr class="text-gray-700 text-center">

                                    <th class="py-4">Item</th>
                                    <th>Harga Satuan</th>
                                    <th>Qty</th>
                                    <th>Diskon (%)</th>

                                </tr>

                            </thead>

                            <tbody>

                                <tr class="border-t border-gray-300">

                                    <td class="p-5">

                                        <p class="font-bold text-lg">
                                            Chocolate Cake
                                        </p>

                                        <p class="text-gray-400 text-sm mt-1">
                                            SKU: 3000
                                        </p>

                                    </td>

                                    <td class="text-center">
                                        Rp 15.000
                                    </td>

                                    <td>

                                        <div class="flex justify-center">

                                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">

                                                <button class="w-10 h-10 hover:bg-gray-100">
                                                    -
                                                </button>

                                                <div class="w-10 text-center font-bold">
                                                    1
                                                </div>

                                                <button class="w-10 h-10 hover:bg-gray-100">
                                                    +
                                                </button>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="text-center">

                                        <span class="border border-gray-300 rounded-lg px-3 py-2">
                                            0%
                                        </span>

                                    </td>

                                </tr>

                                <tr class="border-t border-gray-300">

                                    <td class="p-5">

                                        <p class="font-bold text-lg">
                                            Brown Sugar Latte
                                        </p>

                                        <p class="text-gray-400 text-sm mt-1">
                                            SKU: 4001
                                        </p>

                                    </td>

                                    <td class="text-center">
                                        Rp 20.000
                                    </td>

                                    <td>

                                        <div class="flex justify-center">

                                            <div class="flex items-center border border-gray-300 rounded-lg overflow-hidden">

                                                <button class="w-10 h-10 hover:bg-gray-100">
                                                    -
                                                </button>

                                                <div class="w-10 text-center font-bold">
                                                    2
                                                </div>

                                                <button class="w-10 h-10 hover:bg-gray-100">
                                                    +
                                                </button>

                                            </div>

                                        </div>

                                    </td>

                                    <td class="text-center">

                                        <span class="border border-gray-300 rounded-lg px-3 py-2">
                                            0%
                                        </span>

                                    </td>

                                </tr>

                            </tbody>

                        </table>

                    </div>

                    {{-- TOTAL --}}
                    <div class="flex justify-end mt-6">

                        <div class="text-right space-y-2">

                            <div class="flex justify-between gap-12 text-gray-500">
                                <span>Subtotal</span>
                                <span class="font-bold text-gray-700">Rp 55.000</span>
                            </div>

                            <div class="flex justify-between gap-12 text-gray-500">
                                <span>PPN (10%)</span>
                                <span class="font-bold text-gray-700">Rp 5.500</span>
                            </div>

                            <div
                                class="bg-blue-100 border border-blue-300 rounded-2xl px-6 py-5 mt-3">

                                <p class="font-bold text-gray-700">
                                    TOTAL AKHIR
                                </p>

                                <p class="text-4xl font-black text-[#0B2D73]">
                                    Rp 60.500
                                </p>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            {{-- RIGHT --}}
            <div class="col-span-12 lg:col-span-5">

                <div class="bg-white rounded-[24px] border border-gray-200 shadow-sm p-6 h-full">

                    <div class="flex justify-between items-center mb-4">

                        <h3 class="text-2xl font-black text-gray-800">
                            Ringkasan Invoice
                        </h3>

                        <span
                            class="bg-blue-100 text-blue-700 px-4 py-1 rounded-full text-sm font-bold">
                            DRAFT
                        </span>

                    </div>

                    <p class="text-gray-400 mb-5">
                        INV/2023/X/02421
                    </p>

                    <div
                        class="border border-gray-300 rounded-2xl p-5 text-center text-gray-400 mb-5">
                        Barang yang sudah dibeli tidak dapat ditukar atau dikembalikan tanpa struk asli
                    </div>

                    <div class="space-y-3 border-b border-gray-300 pb-5 mb-5">

                        <div class="flex justify-between">
                            <span>1x Chocolate Cake</span>
                            <span class="font-bold">Rp 15.000</span>
                        </div>

                        <div class="flex justify-between">
                            <span>2x Brown Sugar Latte</span>
                            <span class="font-bold">Rp 40.000</span>
                        </div>

                    </div>

                    {{-- PEMBAYARAN --}}
                    <div>

                        <label class="block font-bold text-gray-700 mb-3">
                            Metode Pembayaran
                        </label>

                        <div class="grid grid-cols-2 gap-4">

                            <button id="cashBtn"
                                class="payment-btn border border-gray-300 rounded-xl py-3 font-bold flex items-center justify-center gap-2 transition-all">
                                <i class="fa-solid fa-money-bill-wave"></i>
                                Cash
                            </button>

                            <button id="qrisBtn"
                                class="payment-btn bg-blue-100 border border-blue-500 text-blue-700 rounded-xl py-3 font-bold flex items-center justify-center gap-2 transition-all">
                                <i class="fa-solid fa-qrcode"></i>
                                QRIS
                            </button>

                        </div>

                    </div>

                    {{-- NOMINAL --}}
                    <div class="mt-5">

                        <label class="block font-bold text-gray-700 mb-2">
                            Nominal Bayar
                        </label>

                        <input type="text"
                            value="Rp 60.500"
                            class="w-full border border-gray-300 rounded-xl px-4 py-3 bg-gray-100">

                    </div>

                    {{-- KEMBALIAN --}}
                    <div
                        class="bg-green-100 border border-green-300 rounded-xl px-4 py-3 mt-5 flex justify-between text-green-700 font-bold">

                        <span>Kembalian:</span>
                        <span>Rp 0</span>

                    </div>

                    {{-- BUTTON PROSES PEMBAYARAN --}}
                    <button id="prosesPembayaranBtn"
                        class="w-full bg-[#0B2D73] hover:bg-[#143d93] text-white font-bold py-4 rounded-2xl mt-6 transition-all">
                        Proses Pembayaran - Rp 60.500
                    </button>

                </div>

            </div>

        </div>

    </main>

    {{-- MODAL LOGOUT KEDUA (BAWAH) --}}
    <div id="logoutModal"
        class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm flex items-center justify-center z-50">

        <div class="bg-white w-[500px] rounded-[36px] p-10 shadow-2xl text-center">

            <h2 class="text-4xl font-black text-gray-800 mb-8">
                Konfirmasi Log Out
            </h2>

            <div class="mb-8">
                <i class="fa-solid fa-right-from-bracket text-7xl text-[#0B2D73]"></i>
            </div>

            <p class="text-gray-600 text-xl leading-relaxed mb-10">
                Apakah Anda yakin ingin keluar dari
                <br>
                <span class="font-bold text-gray-800">
                    CyberProtect UMKM?
                </span>
            </p>

            <div class="space-y-4">

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit"
                        class="w-full bg-[#0B2D73] hover:bg-[#143d93] text-white py-4 rounded-full font-bold text-xl transition-all">
                        <i class="fa-solid fa-right-from-bracket mr-2"></i>
                        YA, LOG OUT
                    </button>
                </form>

                <button id="closeLogoutModal"
                    class="w-full bg-gray-400 hover:bg-gray-500 text-white py-4 rounded-full font-bold text-xl transition-all">
                    <i class="fa-solid fa-rotate-left mr-2"></i>
                    TIDAK, KEMBALI
                </button>

            </div>

        </div>

    </div>

    {{-- MODAL PEMBAYARAN BERHASIL (VERSI BESAR + SCROLL + TOMBOL X) --}}
    <div id="paymentSuccessModal"
        class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">

        <div class="bg-white w-full max-w-md rounded-2xl p-6 shadow-2xl flex flex-col max-h-[85vh] relative animate-fade-in">

            <button type="button" id="closeSuccessModalBtnX"
                class="absolute top-4 right-4 text-gray-400 hover:text-gray-600 transition-colors p-2 rounded-full hover:bg-gray-100">
                <i class="fa-solid fa-xmark text-xl"></i>
            </button>

            <div class="overflow-y-auto flex-1 pr-2 text-slate-800 my-4 custom-scrollbar" id="printArea">
                
                <div class="text-center mb-6 pt-2">
                    <div class="flex justify-center mb-2">
                        <i class="fa-solid fa-utensils text-3xl text-slate-400"></i>
                    </div>
                    <h4 class="font-black text-xl tracking-tight text-slate-900">Nama UMKM</h4>
                    <p class="text-xs text-slate-500 mt-1">Alamat UMKM</p>
                </div>
                
                <div class="text-sm grid grid-cols-[100px_1fr] gap-y-2 text-slate-900 border-b border-slate-100 pb-4">
                    <div class="text-slate-400">No</div>
                    <div class="text-right font-semibold">INV/2023/X/02421</div>
                    
                    <div class="text-slate-400">Tanggal</div>
                    <div class="text-right">24-10-2023 14:20</div>
                    
                    <div class="text-slate-400">Kasir</div>
                    <div class="text-right">Username User</div>
                    
                    <div class="text-slate-400">Pelanggan</div>
                    <div class="text-right">Nama Pelanggan</div>
                    
                    <div class="text-slate-400">Pembayaran</div>
                    <div class="text-right font-bold text-blue-700">QRIS</div>
                </div>
                
                <div class="text-sm space-y-4 pt-4">
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="font-bold text-slate-900 text-base">Chocolate Cake</div>
                            <div class="text-slate-400 text-xs mt-0.5">Rp 15.000 × 1</div>
                        </div>
                        <div class="font-bold text-slate-900 text-base">Rp 15.000</div>
                    </div>
                    
                    <div class="flex justify-between items-start">
                        <div>
                            <div class="font-bold text-slate-900 text-base">Brown Sugar Latte</div>
                            <div class="text-slate-400 text-xs mt-0.5">Rp 20.000 × 2</div>
                        </div>
                        <div class="font-bold text-slate-900 text-base">Rp 40.000</div>
                    </div>
                </div>
                
                <div class="border-t border-dashed border-slate-300 my-5"></div>
                
                <div class="text-sm grid grid-cols-2 gap-y-2 text-slate-600 pb-4">
                    <div>Subtotal</div>
                    <div class="text-right text-slate-900 font-medium">Rp 55.000</div>
                    
                    <div>PPN (10%)</div>
                    <div class="text-right text-slate-900 font-medium">Rp 5.500</div>
                    
                    <div class="font-black text-slate-900 text-lg pt-2 border-t border-slate-100 mt-1">Total</div>
                    <div class="text-right font-black text-xl text-[#0B2D73] pt-2 border-t border-slate-100 mt-1">Rp 60.500</div>
                    
                    <div class="text-slate-400 pt-1">Bayar</div>
                    <div class="text-right text-slate-900 font-medium pt-1">Rp 60.500</div>
                    
                    <div class="text-slate-400">Kembalian</div>
                    <div class="text-right text-slate-900 font-medium">Rp 0</div>
                </div>
                
            </div>
            
            <div class="flex gap-4 pt-3 border-t border-slate-100 bg-white">
                <button type="button" onclick="window.print()"
                    class="flex-1 bg-white hover:bg-slate-50 text-slate-700 border border-slate-300 font-bold py-3 rounded-xl text-sm flex items-center justify-center gap-2 transition-all shadow-sm">
                    <i class="fa-solid fa-print"></i>
                    Cetak Struk
                </button>
                <button type="button" id="closeSuccessModalBtn"
                    class="flex-1 bg-[#0B2D73] hover:bg-[#143d93] text-white font-bold py-3 rounded-xl text-sm transition-all text-center">
                    + Transaksi Baru
                </button>
            </div>

        </div>
    </div>
    <script>

    // =========================
    // PAYMENT BUTTON
    // =========================
    const cashBtn = document.getElementById('cashBtn');
    const qrisBtn = document.getElementById('qrisBtn');

    function setActive(button){

        [cashBtn, qrisBtn].forEach(btn => {

            btn.classList.remove(
                'bg-blue-100',
                'border-blue-500',
                'text-blue-700'
            );

            btn.classList.add(
                'border-gray-300',
                'text-gray-700'
            );

        });

        button.classList.remove('border-gray-300');

        button.classList.add(
            'bg-blue-100',
            'border-blue-500',
            'text-blue-700'
        );

    }

    cashBtn.addEventListener('click', () => {
        setActive(cashBtn);
    });

    qrisBtn.addEventListener('click', () => {
        setActive(qrisBtn);
    });


    // =========================
    // PROFILE DROPDOWN
    // =========================
    const profileBtn = document.getElementById('profileBtn');
    const profileDropdown = document.getElementById('profileDropdown');

    profileBtn.addEventListener('click', function(e){
        e.stopPropagation();
        notifDropdown.classList.add('hidden'); // Tutup notif jika profil dibuka
        profileDropdown.classList.toggle('hidden');
    });


    // =========================
    // LOGOUT MODAL
    // =========================
    const logoutBtn = document.getElementById('logoutBtn');
    const logoutModal = document.getElementById('logoutModal');
    const closeLogoutModal = document.getElementById('closeLogoutModal');

    logoutBtn.addEventListener('click', function(){
        profileDropdown.classList.add('hidden');
        logoutModal.classList.remove('hidden');
    });

    closeLogoutModal.addEventListener('click', function(){
        logoutModal.classList.add('hidden');
    });


    // =========================
    // NOTIF DROPDOWN & TANDAI DIBACA
    // =========================
    const notifBtn = document.getElementById('notifBtn');
    const notifDropdown = document.getElementById('notifDropdown');
    const markAsReadBtn = document.getElementById('markAsReadBtn');
    const notifBadge = document.getElementById('notifBadge');

    notifBtn.addEventListener('click', function(e){
        e.stopPropagation();
        profileDropdown.classList.add('hidden'); // Tutup profil jika notif dibuka
        notifDropdown.classList.toggle('hidden');
    });

    // Event ketika "Tandai dibaca" diklik
    markAsReadBtn.addEventListener('click', function(e){
        e.stopPropagation();
        
        // Sembunyikan dropdown notifikasi keluar
        notifDropdown.classList.add('hidden');
        
        // Opsional: Sembunyikan/hilangkan dot merah penanda notifikasi baru
        if(notifBadge) {
            notifBadge.classList.add('hidden');
        }
    });


    // =========================
    // PEMBAYARAN SUKSES MODAL (NEW)
    // =========================
    const prosesPembayaranBtn = document.getElementById('prosesPembayaranBtn');
    const paymentSuccessModal = document.getElementById('paymentSuccessModal');
    const closeSuccessModalBtn = document.getElementById('closeSuccessModalBtn');

    prosesPembayaranBtn.addEventListener('click', function() {
        paymentSuccessModal.classList.remove('hidden');
    });

    closeSuccessModalBtn.addEventListener('click', function() {
        paymentSuccessModal.classList.add('hidden');
    });

    // Tambahkan ini agar tombol X bisa menutup modal
    closeSuccessModalBtnX.addEventListener('click', function() {
        paymentSuccessModal.classList.add('hidden');
    });


    // =========================
    // CLOSE ALL DROPDOWNS SAAT KLIK LUAR
    // =========================
    document.addEventListener('click', function(e){

        if(
            !profileBtn.contains(e.target) &&
            !profileDropdown.contains(e.target)
        ){
            profileDropdown.classList.add('hidden');
        }

        if(
            !notifBtn.contains(e.target) &&
            !notifDropdown.contains(e.target)
        ){
            notifDropdown.classList.add('hidden');
        }

    });

</script>
{{-- MODAL PILIH PRODUK (REPLIKA PERSIS SCREENSHOT 332 FIGMA) --}}
<div id="productGridModal" class="hidden fixed inset-0 bg-black/40 backdrop-blur-sm z-50 flex items-center justify-center p-4">
    
    <div class="bg-white w-full max-w-5xl rounded-[32px] p-8 shadow-2xl flex flex-col relative max-h-[90vh]">
        
        <button type="button" id="btn-close-produk-x" class="absolute top-6 right-8 text-gray-400 hover:text-gray-600 p-2 rounded-full hover:bg-gray-100 transition-all">
            <i class="fa-solid fa-xmark text-xl"></i>
        </button>

        <h3 class="text-2xl font-black text-gray-800 mb-6">Pilih Produk</h3>

        <div class="flex flex-col md:flex-row justify-between items-start md:items-center gap-4 mb-6">
            <div class="relative w-full md:w-80">
                <i class="fa-solid fa-magnifying-glass absolute left-4 top-3.5 text-gray-400"></i>
                <input type="text" id="searchProdukInput" placeholder="Cari nama produk..." 
                    class="w-full pl-11 pr-4 py-2.5 bg-gray-50 border border-gray-200 rounded-xl text-sm focus:outline-none focus:ring-2 focus:ring-blue-500 text-gray-700">
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="button" data-kategori="all" class="btn-kat-filter aktif bg-[#0B2D73] text-white font-bold px-5 py-2 rounded-xl text-xs transition-all shadow-sm">All</button>
                <button type="button" data-kategori="dessert" class="btn-kat-filter bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2 rounded-xl text-xs transition-all">Dessert</button>
                <button type="button" data-kategori="coffee" class="btn-kat-filter bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2 rounded-xl text-xs transition-all">Coffee</button>
                <button type="button" data-kategori="food" class="btn-kat-filter bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2 rounded-xl text-xs transition-all">Food</button>
                <button type="button" data-kategori="snack" class="btn-kat-filter bg-gray-100 hover:bg-gray-200 text-gray-700 font-bold px-5 py-2 rounded-xl text-xs transition-all">Snack</button>
            </div>
        </div>

        <div class="overflow-y-auto flex-1 pr-2 grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-6 my-2" id="grid-produk-container">
            
            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="chocolate cake" data-kat="dessert">
                <div class="bg-amber-50/50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-700/80 text-4xl">
                    <i class="fa-solid fa-cake-candles"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Chocolate Cake</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 20</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 15.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="cheese cake" data-kat="dessert">
                <div class="bg-amber-50/50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-600 text-4xl">
                    <i class="fa-solid fa-cheese"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Cheese Cake</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 20</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 20.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="strawberry pudding" data-kat="dessert">
                <div class="bg-red-50/50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-red-400 text-4xl">
                    <i class="fa-solid fa-ice-cream"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Strawberry Pudding</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 15</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 12.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="macaron pack" data-kat="dessert">
                <div class="bg-pink-50/50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-pink-500 text-4xl">
                    <i class="fa-solid fa-cookie-bite"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Macaron Pack</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 8</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 25.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="brown sugar latte" data-kat="coffee">
                <div class="bg-amber-50/60 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-800/70 text-4xl">
                    <i class="fa-solid fa-mug-hot"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Brown Sugar Latte</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 30</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 20.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="espresso single" data-kat="coffee">
                <div class="bg-slate-50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-slate-700 text-4xl">
                    <i class="fa-solid fa-glass-water"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Espresso Single</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 40</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 10.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="cappuccino" data-kat="coffee">
                <div class="bg-stone-100 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-stone-600 text-4xl">
                    <i class="fa-solid fa-mug-saucer"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Cappuccino</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 25</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 18.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="caramel macchiato" data-kat="coffee">
                <div class="bg-orange-50/60 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-700 text-4xl">
                    <i class="fa-solid fa-cup-straw"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Caramel Macchiato</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 15</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 24.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="nasi goreng umkm" data-kat="food">
                <div class="bg-orange-50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-orange-500 text-4xl">
                    <i class="fa-solid fa-bowl-rice"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Nasi Goreng</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 15</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 25.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="mie goreng spesial" data-kat="food">
                <div class="bg-yellow-50/80 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-yellow-600 text-4xl">
                    <i class="fa-solid fa-wheat-awn"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Mie Goreng Spesial</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 30</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 18.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="ayam geprek" data-kat="food">
                <div class="bg-red-50/50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-red-600 text-4xl">
                    <i class="fa-solid fa-drumstick-bite"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Ayam Geprek</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 22</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 22.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="beef burger" data-kat="food">
                <div class="bg-amber-50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-800 text-4xl">
                    <i class="fa-solid fa-hamburger"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Beef Burger</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 10</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 28.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="french fries" data-kat="snack">
                <div class="bg-yellow-50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-yellow-600 text-4xl">
                    <i class="fa-solid fa-cookie"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">French Fries</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 25</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 14.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="croissant plain" data-kat="snack">
                <div class="bg-amber-50/40 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-700 text-4xl">
                    <i class="fa-solid fa-bread-slice"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Croissant Plain</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 12</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 17.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="roti bakar cokelat" data-kat="snack">
                <div class="bg-orange-50/50 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-900 text-4xl">
                    <i class="fa-solid fa-cubes-stacked"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Roti Bakar Cokelat</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 15</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 15.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

            <div class="item-produk-card bg-white border border-gray-100 rounded-3xl p-5 shadow-sm flex flex-col text-center" data-nama="nachos cheese" data-kat="snack">
                <div class="bg-yellow-50/60 w-full aspect-square rounded-2xl flex items-center justify-center mb-4 text-amber-500 text-4xl">
                    <i class="fa-solid fa-plate-wheat"></i>
                </div>
                <h5 class="font-bold text-gray-800 text-base mb-1">Nachos Cheese</h5>
                <p class="text-xs text-gray-400 mb-2">Stok: 18</p>
                <p class="font-extrabold text-blue-600 text-base mb-4">Rp 19.000</p>
                <button type="button" class="w-full border border-blue-500 text-blue-600 hover:bg-blue-50 py-2 rounded-xl text-xs font-bold transition-all">Pilih</button>
            </div>

        </div>

        <div class="flex justify-end pt-4 border-t border-gray-100 mt-4">
            <button type="button" id="btn-selesai-produk" class="bg-[#0B2D73] hover:bg-[#143d93] text-white font-black px-12 py-3 rounded-xl text-sm transition-all shadow-md">
                SELESAI
            </button>
        </div>

    </div>
</div>

{{-- LOGIC JAVASCRIPT UNTUK MEMBUKA MODAL & FILTER KATEGORI --}}
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const btnBukaProduk = document.getElementById('btn-buka-produk');
        const productGridModal = document.getElementById('productGridModal');
        const btnCloseProdukX = document.getElementById('btn-close-produk-x');
        const btnSelesaiProduk = document.getElementById('btn-selesai-produk');
        
        const katButtons = document.querySelectorAll('.btn-kat-filter');
        const itemCards = document.querySelectorAll('.item-produk-card');
        const searchInput = document.getElementById('searchProdukInput');

        // Fungsi Buka Modal ketika tombol "Tambah" di-klik
        if(btnBukaProduk) {
            btnBukaProduk.addEventListener('click', function() {
                productGridModal.classList.remove('hidden');
            });
        }

        // Fungsi Tutup Modal via Tombol X atau Tombol SELESAI
        [btnCloseProdukX, btnSelesaiProduk].forEach(btn => {
            if(btn) {
                btn.addEventListener('click', function() {
                    productGridModal.classList.add('hidden');
                });
            }
        });

        // Logika Menyaring Menu Otomatis (Filter Kategori & Kolom Pencarian)
        function filterMenu() {
            // Ditambahkan pengaman agar jika belum ada class .aktif, defaultnya adalah 'all'
            const activeKatEl = document.querySelector('.btn-kat-filter.aktif');
            const activeKat = activeKatEl ? activeKatEl.getAttribute('data-kategori') : 'all';
            
            const searchKeyword = searchInput ? searchInput.value.toLowerCase().trim() : '';

            itemCards.forEach(card => {
                const cardKat = card.getAttribute('data-kat');
                const cardNama = card.getAttribute('data-nama');

                const matchKat = (activeKat === 'all' || cardKat === activeKat);
                const matchSearch = cardNama ? cardNama.includes(searchKeyword) : true;

                if (matchKat && matchSearch) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });
        }

        // Klik Tombol Kategori -> Ganti Kategori Aktif
        katButtons.forEach(btn => {
            btn.addEventListener('click', function() {
                katButtons.forEach(b => {
                    b.classList.remove('bg-[#0B2D73]', 'text-white', 'aktif');
                    b.classList.add('bg-gray-100', 'text-gray-700');
                });

                this.classList.remove('bg-gray-100', 'text-gray-700');
                this.classList.add('bg-[#0B2D73]', 'text-white', 'aktif');

                filterMenu();
            });
        });

        // Ketik di Kolom Pencarian -> Otomatis Filter
        if(searchInput) {
            searchInput.addEventListener('input', filterMenu);
        }
    });
</script>
</body>
</html>