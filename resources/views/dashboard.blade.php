<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- CSS Only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
@include('components.navbar')
<br>
  <div class="max-w-6xl mx-auto">
    {{-- BANNER IKLAN --}}
	<div id="default-carousel" class="relative" data-carousel="static">
        <div class="overflow-hidden relative min-h-80 rounded-lg sm:min-h-96 xl:min-h-56 2xl:min-h-96">
            <div class="hidden duration-700 ease-in-out d-block w-100" data-carousel-item>
                <span class="absolute top-1/2 left-1/2 text-2xl font-semibold text-white -translate-x-1/2 -translate-y-1/2 sm:text-3xl ">Primer Slide</span>
                <img src="https://flowbite.com/docs/images/carousel/carousel-1.svg" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out d-block w-100" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-2.svg" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
           
            <div class="hidden duration-700 ease-in-out d-block w-100" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-3.svg" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
            <div class="hidden duration-700 ease-in-out d-block w-100" data-carousel-item>
                <img src="https://flowbite.com/docs/images/carousel/carousel-3.svg" class="block absolute top-1/2 left-1/2 w-full -translate-x-1/2 -translate-y-1/2" alt="...">
            </div>
        </div>
        
        <div class="flex absolute bottom-5 left-1/2 z-30 space-x-3 -translate-x-1/2">
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 1" data-carousel-slide-to="0"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 2" data-carousel-slide-to="1"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
            <button type="button" class="w-3 h-3 rounded-full" aria-current="false" aria-label="Slide 3" data-carousel-slide-to="2"></button>
        </div>
       
        <button type="button" class="flex absolute top-0 left-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-prev>
            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30  group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path></svg>
                <span class="hidden">Anterior</span>
            </span>
        </button>
        <button type="button" class="flex absolute top-0 right-0 z-30 justify-center items-center px-4 h-full cursor-pointer group focus:outline-none" data-carousel-next>
            <span class="inline-flex justify-center items-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 0 group-focus:ring-4 group-focus:ring-white  group-focus:outline-none">
                <svg class="w-5 h-5 text-white sm:w-6 sm:h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path></svg>
                <span class="hidden">Siguiente</span>
            </span>
        </button>
    </div>
    <br><br>

    {{-- CLASS PRODUCT --}}
    <div class="bg-white rounded-lg max-w-6xl">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
    <h2 class="text-2xl font-bold tracking-tight text-gray-900 text-center italic">For You Dear</h2>
    <div class="mt-0 m-8 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 ">
    
        {{-- product --}}
        <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>

    <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>

    <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>

    <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>

    <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>

    <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>

    <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>

    <div class="card p-3 m-3 shadow group relative">
        <div class="aspect-h-2 aspect-w-3 w-full overflow-hidden rounded-md bg-gray-200 lg:aspect-none group-hover:opacity-75 lg:h-54">
            <img src="{{ asset('images\\glowinkgambar1.jpeg') }}" class="aspect-square" card image cap">
        </div>
        <div class="mt-4 flex justify-between">
            <div> 
                <h3 class="text-xs text-gray-700">
                    <a href="#">
                        <span aria-hidden="true" class="absolute inset-0"></span>
                        Emina Bright Stuff Face Wash
                    </a>
                    <p class="mt-1 text-xs text-gray-500">Face Wash</p>
                    <p class="text-xs font-medium text-gray-900">Rp 55.000</p>
                </h3>
            </div>
        </div>
    </div>


    


    </div>
  </div>
    </div>
      <br>

@include('components.footer')
    <!-- Javascript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>