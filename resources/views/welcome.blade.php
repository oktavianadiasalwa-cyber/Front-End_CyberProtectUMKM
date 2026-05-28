<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CyberProtect UMKM</title>

    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-[#1E1E1E] flex justify-center items-center min-h-screen">

    <div class="bg-white w-[400px] h-[550px] rounded-[20px] shadow-2xl p-10 text-center flex flex-col justify-between">

        <div class="mt-8">
            <h1 class="text-3xl font-bold text-[#0A2C6D]">
                CyberProtect UMKM
            </h1>

            <h2 class="mt-14 text-xl font-semibold text-gray-800 leading-snug px-2">
                Level Up Bisnis Anda dengan Perlindungan Digital Berkelas
            </h2>
        </div>

        <div class="mb-6">
            <a href="{{ route('login.user') }}" class="block w-full bg-blue-600 text-white py-3 rounded-lg font-semibold hover:bg-blue-700 transition-colors text-center shadow-md">
                MASUK SEBAGAI USER
            </a>

            <button class="w-full bg-[#001F5B] text-white py-3 rounded-lg mt-4 font-semibold hover:bg-[#001744] transition-colors shadow-md-dark">
                MASUK SEBAGAI ADMIN
            </button>
        </div>

    </div>

</body>
</html>