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
    {{-- <script src="{{ asset('js/darkmode.js') }}"></script> --}}
    <script>
    // On page load or when changing themes, best to add inline in `head` to avoid FOUC
    if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark')
    }
    </script>
    <script src="../path/to/flowbite/dist/flowbite.min.js"></script>
    {{-- ICON --}}
    <link rel="shortcut icon" href="{{ ('logo.png') }}">
    <title>GLOWINK</title>
</head>

<body class="font-[Poppins] bg-[#A0CADB] h-screen dark:bg-slate-500">
    {{-- NAVBAR --}}
    <header class="bg-white dark:bg-gray-900 border-b border-gray-500">
        <nav class="flex justify-between items-center w-[92%] mx-auto h-16 dark:text-white">
        {{-- <nav class="bg-white dark:bg-gray-900 fixed w-full z-20 top-0 start-0 border-b border-gray-200 dark:border-gray-600"> --}}
            {{-- icon menu --}}
            <div class="flex items-center"><a href="#">
                <img src="{{ asset('images/list.png') }}" type="button" class="w-6 cursor-pointer ml-1" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation" aria-controls="drawer-navigation"></img></a>
            <!-- menu component -->
            <div id="drawer-navigation" class="fixed top-0 left-0 z-40 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white w-80 dark:bg-gray-800" tabindex="-1" aria-labelledby="drawer-navigation-label">
    <h2 id="drawer-navigation-label" class="text-2xl font-semibold text-gray-500 uppercase dark:text-gray-400">Categories</h2>
    <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-6 h-8 absolute top-2.5 end-2.5 inline-flex items-center justify-center dark:hover:bg-gray-600 dark:hover:text-white" >
      {{-- <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14"> --}}
        {{-- problem menu ilang --}}
      <svg class="w-3 h-3" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
         <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
      </svg>
      <span class="sr-only">Close menu</span>
   </button>
  <div class="py-4 overflow-y-auto">
      <ul class="space-y-2 font-medium">
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/facewash.png') }}" alt="">
               <span class="ms-2">Face Wash</span>
            </a>
         </li>

          <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/toner.png') }}" alt="">
               <span class="ms-2">Toner</span>
            </a>
         </li>

          <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/lotion.png') }}" alt="">
               <span class="ms-2">Moisturizer</span>
            </a>
         </li>

          <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/sunscreen.png') }}" alt="">
               <span class="ms-2">Sunscreen</span>
            </a>
         </li>

          <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/primer.png') }}" alt="">
               <span class="ms-2">Primer</span>
            </a>
         </li>

          <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/foundation.png') }}" alt="">
               <span class="ms-2">Cushion</span>
            </a>
         </li>

          <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/foundation (1).png') }}" alt="">
               <span class="ms-2">Foundation</span>
            </a>
         </li>

          <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
            <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/blush-on.png') }}" alt="">
               <span class="ms-2">Blush On</span>
            </a>
         </li>
         
         <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
           <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/eyeshadow.png') }}" alt="">
              <span class="ms-2">Eye Shadow</span>
           </a>
        </li>
         <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
           <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/lipstick.png') }}" alt="">
              <span class="ms-2">Lip</span>
           </a>
        </li>
         <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
           <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/brush.png') }}" alt="">
              <span class="ms-2">Brush</span>
           </a>
        </li>
         <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
           <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/peeling.png') }}" alt="">
              <span class="ms-2">Peeling</span>
           </a>
        </li>
         <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
           <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/masker.png') }}" alt="">
              <span class="ms-2">Masker</span>
           </a>
        </li>
         <li>
           <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-100 group">
           <img class="w-8 cursor-pointer ml-2" src="{{ asset('images/body-lotion.png') }}" alt="">
              <span class="ms-2">Body Lotion</span>
           </a>
        </li>
      </ul>
   </div>
</div>
                {{-- icon logo --}}
                <a href="/">
                  <img class="w-10 cursor-pointer ml-4" src="{{ asset('images/logo.png') }}" alt="images">
            </div>
                </a>

            {{-- search box --}}
            <form class="mx-auto relative" action="/cari-produk" method="get">
               <label for="default-search" class="sr-only">Search</label>
               <div class="relative">
                  <input type="search" id="default-search" class="italic block w-full md:w-[500px] mb-2 pl-10 text-sm  text-gray-900 border border-gray-300 rounded focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Find Your Skincare" required />
                  <svg class="absolute left-3 top-2.5 w-4 h-4 xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                     <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                  </svg>
               </div>
            </form>

            <div class="flex items-center gap-6 my-hydrated md-hydrated">
               <a href="/cart"><img class="w-6 cursor-pointer ml-2" src="{{ asset('images/cart.png') }}" alt=""></a>
               {{-- packed logo --}}
               <a href=""><img class="w-6 cursor-pointer ml-2" src="{{ asset('images/user.png') }}" aria-labelledby="dropdownNavbarLink" alt=""></a>
                
                  <div>
                     <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                     <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                     <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                  </button>
               </div>
            </div>

      </div>

<script>
    var themeToggleDarkIcon = document.getElementById("theme-toggle-dark-icon");
var themeToggleLightIcon = document.getElementById("theme-toggle-light-icon");

// Change the icons inside the button based on previous settings
if (
    localStorage.getItem("color-theme") === "dark" ||
    (!("color-theme" in localStorage) &&
        window.matchMedia("(prefers-color-scheme: dark)").matches)
) {
    themeToggleLightIcon.classList.remove("hidden");
} else {
    themeToggleDarkIcon.classList.remove("hidden");
}

var themeToggleBtn = document.getElementById("theme-toggle");

themeToggleBtn.addEventListener("click", function () {
    // toggle icons inside button
    themeToggleDarkIcon.classList.toggle("hidden");
    themeToggleLightIcon.classList.toggle("hidden");

    // if set via local storage previously
    if (localStorage.getItem("color-theme")) {
        if (localStorage.getItem("color-theme") === "light") {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        } else {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        }

        // if NOT set via local storage previously
    } else {
        if (document.documentElement.classList.contains("dark")) {
            document.documentElement.classList.remove("dark");
            localStorage.setItem("color-theme", "light");
        } else {
            document.documentElement.classList.add("dark");
            localStorage.setItem("color-theme", "dark");
        }
    }
});
    </script>
        </nav>
    </header>
    {{-- NAVBAR END --}}

    @yield('content')

    
</body>

</html>