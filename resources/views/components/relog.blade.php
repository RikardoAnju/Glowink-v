<body class="bg-white">
    <div class="relative bg-white max-w-full">
        <div class="flex items-stretch"> 
            <!-- Menggunakan items-stretch agar elemen div memiliki tinggi penuh -->
            <div class="w-6/12 bg-[#A0CADB]"> 
            {{-- <div class="w-6/12 h-full bg-[#A0CADB] inset-0 flex items-center justify-center">  --}}
                <!-- Mengatur elemen gambar -->
                <a href="#" class="flex items-center text-gray-900 rounded-lg dark:hover:bg-gray-100 group">
                    <img class="max-w-full h-auto cursor-pointer ml-2" src="{{ asset('images/logo.png') }}" alt=""> 
                    <!-- Menggunakan max-w-full dan h-auto agar gambar menyesuaikan ukuran div -->
                </a>
            </div>
            <!-- Mengatur elemen div hitam di sebelah kanan -->
            <div class="w-6/12 bg-white inset-0">
                <section class=" dark:bg-gray-900">
                <div class="flex flex-col items-center justify-center inset-x-0 h-80 w-96 mx-auto md:h-screen lg:py-0">

@yield('content')