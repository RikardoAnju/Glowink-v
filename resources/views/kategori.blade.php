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

    {{-- CLASS PRODUCT --}}
     <h1 class="text-4xl font-bold tracking-tight text-gray-900 uppercase text-center italic">face wash</h1>
     <br>
    <div class="bg-white rounded-lg max-w-6xl">
  <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
   
    <div class="mt-0 m-8 grid grid-cols-1 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8 ">
    
        {{-- product --}}
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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
        
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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
        
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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
        
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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
        
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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
        
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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
        
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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
        
        <div class="card p-3 m-3 shadow group relative bg-[#A0CADB]">
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