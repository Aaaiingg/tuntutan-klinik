<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>e-Tuntutan MBKT</title>
        @vite('resources/css/app.css')
    </head>
    <body class="antialiased bg-gray-800 text-black">
        <div class="relative flex items-top justify-center min-h-screen sm:items-center py-4 sm:pt-0">
            <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
                <div class="flex justify-center mb-8 space-x-10">
                    <div class="w-96 bg-white rounded-lg p-6 text-center">
                        <h1 class="text-xl font-bold mb-4">Selamat Datang ke sistem e-Tuntutan</h1>
                        <p class="mb-2">Menguruskan tuntutan pembayaran Tuntutan klinik dengan lebih cekap</p>
                        <p class="text-sm text-black">Makluman: sistem ini hanya untuk kegunaan kakitangan MBKT sahaja</p>
                    </div>
                    
                    <div class="w-96 flex items-center justify-center">
                        <img src="{{ asset('images/mbkt.png') }}" alt="MBKT Logo" class="w-60 rounded shadow-lg">
                    </div>
                </div>

                <div class="flex justify-center space-x-8 mt-6">
                    <a href="{{ route('login') }}" class="bg-white hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                        Log Masuk
                    </a>
                    <a href="{{ route('register') }}" class="bg-white hover:bg-gray-700 text-black font-bold py-2 px-4 rounded">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
