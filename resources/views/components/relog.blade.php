<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- FONTS -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/ionicons@4.5.10-0/dist/ionicons.js"></script>
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Italianno&display=swap" rel="stylesheet">
    {{-- <script src="{{ asset('js/darkmode.js') }}"></script> --}}
    <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
    </script>
    {{-- ICON --}}
    <link rel="shortcut icon" href="{{ ('logo.png') }}">
    <title>GLOWINK</title>
</head>

<body class="bg-white">
    <div class="relative bg-white max-w-full shadow-xl">
        <div class="flex items-stretch"> 
            <!-- Menggunakan items-stretch agar elemen div memiliki tinggi penuh -->
            <div class="w-6/12 bg-[#A0CADB]"> 
            {{-- <div class="w-6/12 h-full bg-[#A0CADB] inset-0 flex items-center justify-center">  --}}
                <!-- Mengatur elemen gambar -->
                <a href="#" class="flex items-center text-gray-900 rounded-lg dark:hover:bg-gray-100 group">
                    <img class="max-w-full h-auto cursor-pointer ml-12 mt-16" src="{{ asset('images/logo.png') }}" alt=""> 
                    <!-- Menggunakan max-w-full dan h-auto agar gambar menyesuaikan ukuran div -->
                </a>
            </div>
            <!-- Mengatur elemen div hitam di sebelah kanan -->
            <div class="w-6/12 bg-white inset-0">
                <section class=" dark:bg-gray-900">
                <div class="flex flex-col items-center justify-center inset-x-0 h-80 w-96 mx-auto md:h-screen lg:py-0">