<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Document</title>
</head>
<body>
<div class="w-1/2 px-1 mt-3 ">
   <button class="w-full  bg-gray-900 dark:bg-gray-600 text-white py-3 px-1 rounded-md font-bold hover:bg-gray-800 dark:hover:bg-gray-700"><img src="images/add.png" alt="" class="ml-auto">Add Product</button>
</div>
<button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 mt-2 ms-3 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
   <span class="sr-only">Open sidebar</span>
  
</button>

<aside id="logo-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
   <div class="h-full px-3 py-4 overflow-y-auto bg-gray-50 dark:bg-gray-800">
      <a href="https://flowbite.com/" class="flex items-center ps-2.5 mb-5">
         <img src="images/logo.png" class="h12.5 me-3 sm:h-12.5" alt="Flowbite Logo" />
         <hr>
      </a>
      <ul class="space-y-2 font-medium">
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
               <svg class="w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400 group-hover:text-gray-900 dark:group-hover:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                  <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z"/>
                  <path d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z"/>
               </svg>
               <span class="ms-3">Dashboard</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="images/user.png" class="h7.5 me-3 sm:h-7" alt="Flowbite Logo" />
               <span class="flex-1 ms-3 whitespace-nowrap">Profile</span>
               
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="images/produk.png" class="h7.5 me-3 sm:h-7" alt="Flowbite Logo" />
               <span class="flex-1 ms-3 whitespace-nowrap">Product</span>
               
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="images/order.png" class="h7.5 me-3 sm:h-7" alt="Flowbite Logo" />
               </svg>
               <span class="flex-1 ms-3 whitespace-nowrap">Order</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="images/delivery.png" class="h7.5 me-3 sm:h-7" alt="Flowbite Logo" />
               <span class="flex-1 ms-3 whitespace-nowrap">Delivery</span>
            </a>
         </li>
         <li>
            <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <img src="images/logout.png" class="h7.5 me-3 sm:h-7" alt="Flowbite Logo" />
               <span class="flex-1 ms-3 whitespace-nowrap">Logout</span>
            </a>
         </li>
        
      </ul>
   </div>
</aside>
<div class="p-4 sm:ml-64 ">
   



<!-- ✅ Grid Section - Starts Here 👇 -->
<section id="Projects"
    class="w-fit mx-auto grid grid-cols-1 lg:grid-cols-3 md:grid-cols-2 justify-items-center justify-center gap-y-20 gap-x-14 mt-10 mb-5">

    
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    <div class="w-72 bg-white shadow-md rounded-xl duration-500 hover:scale-105 hover:shadow-xl">
        <a href="#">
            <img src="https://images.unsplash.com/photo-1646753522408-077ef9839300?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwcm9maWxlLXBhZ2V8NjZ8fHxlbnwwfHx8fA%3D%3D&auto=format&fit=crop&w=500&q=60"
                    alt="Product" class="h-80 w-72 object-cover rounded-t-xl" />
            <div class="px-5 py-5 gap-9 w-72">
                <span class="text-gray-400 mr-3 uppercase text-xs">Brand</span>
                <p class="text-lg font-bold text-black truncate block capitalize">Product Name</p>
                <div class="flex items-center">
                   <a href="#" class="flex items-center justify-center rounded-md bg-blue-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Detail</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-green-500 px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Ubah</a>
                   <a href="#" class="flex items-center justify-center rounded-md bg-red-500   px-5 py-2.5 text-center text-sm font-medium text-white hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-blue-300">Hapus</a>
                   </div>
                  
                   </div>
        </a>
    </div>
    

  
    
</section>







</div>



</body>
</html>