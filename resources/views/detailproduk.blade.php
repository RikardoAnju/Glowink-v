@include('components.navbar')

@section('content')


{{-- <div class="bg-white rounded-lg max-w-6xl mx-auto"> --}}
    {{-- <div class="max-w-4xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8"> --}}
        {{-- <div id="gallery" class="relative max-w-2xl h-96" data-carousel="slide">
            <!-- Carousel wrapper -->
            <div class="relative h-full overflow-hidden rounded-lg">
                <!-- Item 1 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/banner2.jpg') }}" alt="">
                </div>
                <!-- Item 2 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item="active">
                    <img src="{{ asset('images/banner1.jpg') }}" class="absolute block w-full h-full object-cover" alt="">
                </div>
                <!-- Item 3 -->
                <div class="hidden duration-700 ease-in-out" data-carousel-item>
                    <img src="{{ asset('images/banner3.jpg') }}" class="absolute block w-full h-full object-cover" alt="">
                </div>
            </div>
            <!-- Slider controls -->
            <button type="button" class="absolute top-0 start-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-prev>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 1 1 5l4 4"/>
                    </svg>
                    <span class="sr-only">Previous</span>
                </span>
            </button>
            <button type="button" class="absolute top-0 end-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none" data-carousel-next>
                <span class="inline-flex items-center justify-center w-10 h-10 rounded-full bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
                    <svg class="w-4 h-4 text-white dark:text-gray-800 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 9 4-4-4-4"/>
                    </svg>
                    <span class="sr-only">Next</span>
                </span>
            </button> --}}

{{-- <div class="row gx-4 gx-lg-5">
<div class="col-md-5 d-flex h-100">
 
<img class="h-auto max-w-md aspect-square" src="{{ asset('images/banner1.jpg') }}" alt="image description">
 --}}
 <div class="flex w-11/12 px-4 py-4 mx-auto mt-8 mb-4 bg-white border rounded-lg shadow-xl">
        <div class="w-2/3 p-2">
            <div class="w-full aspect-[1.1/1] bg-slate-600 rounded-lg">
                <img class="" id="foto-produk">
            </div>
            <div class="">

            </div>
        </div>
        <div class="w-1/3 p-3">
            <p class="mb-2 text-6xl font-extrabold" id="nama-produk">Emina Bright Stuff Face Wash Cleaning</p></p>
            <hr class="mb-2">
            <br>
            <p class="text-2xl font-semibold" id="harga-produk">Rp 99.000</p>
            <p class="text-lg text-gray-900 dark:text-white" id="">Stock</p>
            <div class="mt-4 text-xl font-medium">
    <div class="flex flex-wrap gap-4">
        <button type="button" class="relative justify-center p-0.5 mb-2 text-white bg-red-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Buy now
        </button>
        <a href="/cart">
            <button class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-cyan-500 to-blue-500 group-hover:from-cyan-500 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-cyan-200 dark:focus:ring-cyan-800">
            <span class="relative flex items-center px-2 py-2 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0">
                <img src="{{ asset('images/cart.png') }}" class="w-4 h-4" alt="icon">
                <span class="ml-2">Add to Cart</span>
            </span>
        </button>
        </a>
    </div>
</div>
</div>
</div>
<div class="flex w-11/12 px-4 py-4 mx-auto mb-8 bg-white border rounded-lg shadow-xl">
    <div class="w-5/5 pl-4">
        
        <p class="mb-4 text-2xl font-semibold italic text-slate-500">Description</p>
        <hr>
        {{-- <div class="w-2/5">
            <div class="w-full px-6">
                <table class="w-full border-separate border-spacing-y-4" id="">
                    <tr class="py-2">
                        <td class="w-2/12 font-light text-sm">Categories</td>
                        <td>:</td>
                        <td class="font-light text-sm">fw</td>
                    </tr>
                    <tr class="py-2">
                        <td class="w-2/12 font-light text-sm">Netto</td> <td>:</td>
                        <td class="font-light text-sm">fw</td>
                    </tr>
                </table>
                <p class="mb-4 text-base font-normal">Lorem ipsum dolor, sit amet consectetur adipisicing elit. Praesentium, et quasi at, ut sed aperiam ipsa vitae dignissimos repellendus non molestias. Temporibus, dolores. Optio sapiente impedit eveniet placeat ea dolor.</p>
            </div>
        </div> --}}
        

<div class="relative overflow-x-auto">
    <table class="w-full text-xs text-left rtl:text-right text-gray-500 dark:text-gray-400">
        <thead class="text-sm text-gray-900 uppercase dark:text-gray-400">
            <tr>
                <th scope="col" class="px-6 py-3">
                    Description
                </th>
                <th scope="col" class="px-6 py-3">
                    Ingridients
                </th>
                <th scope="col" class="px-6 py-3">
                    How to Use
                </th>
            </tr>
        </thead>
        <tbody>
            <tr class="bg-white dark:bg-gray-800">
                <th scope="row" class="px-6 py-4">
                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Quam, commodi facere. Quod, doloribus minima. Quod aliquid reprehenderit, voluptatum, doloribus quos ipsa excepturi, amet nam maiores quae possimus odio placeat rerum?
                </th>
                <td class="px-6 py-4">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Itaque saepe fuga quasi perspiciatis harum maiores fugiat dolores nam at iste obcaecati asperiores numquam facere repellendus, eligendi aperiam provident deserunt! Veniam.
                </td>
                <td class="px-6 py-4">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Magni deleniti dolorum excepturi possimus, eveniet amet consequatur, distinctio enim voluptatum quas in maiores necessitatibus soluta aperiam quasi nulla. Sequi, autem dolores?
                </td>
            </tr>
            </tr>
        </tbody>
    </table>
</div>

    </div>
    </div>

    </div>



        </div>

    </div>


{{-- @include('components.footer') --}}
