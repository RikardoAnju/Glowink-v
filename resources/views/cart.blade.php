@include('components.navbar')
<br>
{{-- Judul my cart --}}
<div class="text-center">
  <div class="flex items-center justify-center h-8 py-4">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
      <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 1 0-7.5 0v4.5m11.356-1.993 1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 0 1-1.12-1.243l1.264-12A1.125 1.125 0 0 1 5.513 7.5h12.974c.576 0 1.059.435 1.119 1.007ZM8.625 10.5a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm7.5 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Z" />
    </svg>
    <p class="text-2xl font-black text-gray-900 dark:text-white mr-2">My Cart
    </p>
  </div>
</div>
<div class="relative overflow-x-auto shadow-2xl sm:rounded-lg w-11/12 px-4 py-4 mx-auto mt-8 mb-4 bg-white border rounded-lg ">
  {{-- tabel my cart --}}
  <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
      <tr>
        <th scope="col" class="p-2">
          <div class="flex items-center">
            <input id="checkbox-all-search" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-all-search" class="sr-only">checkbox
            </label>
          </div>
        </th>
        <th scope="col" class="px-6 py-3">
          Preview
        </th>
        <th scope="col" class="px-4 py-3">
          Product Name
        </th>
        <th scope="col" class="px-4 py-3">
          Price
        </th>
        <th scope="col" class="px-4 py-3">
          Quantity
        </th>
        <th scope="col" class="px-4 py-3">
          Action
        </th>
      </tr>
    </thead>
    {{-- isian tabel my cart --}}
    <tbody>
      <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
        <td class="w-4 p-4">
          <div class="flex items-center">
            <input id="checkbox-table-search-1" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 rounded focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 dark:focus:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
            <label for="checkbox-table-search-1" class="sr-only">checkbox
            </label>
          </div>
        </td>
        {{-- gambar produk --}}
        
          <td class="p-2 px-0">
          <a href="/detailproduk">
            <div class="w-36 aspect-[1/1] bg-slate-600 rounded-lg">
            <img src="{{ asset('images/lipstick.png')}}" class="rounded-md" id="foto-produk">
          </div>
        </a>
        </td>
        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
          XXXXXXXXXXXXXXXXXXXX
        </td>
        <td class="px-6 py-4 font-semibold text-gray-900 dark:text-white">
          Rp 96.000
        </td>
        <td class="px-6 py-4">
          <form class="max-w-xs mx-auto">
            <div class="relative flex items-center max-w-[8rem]">
              <button type="button" id="decrement-button" data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                <svg class="w-2 h-2 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                </svg>
              </button>
              <input type="text" id="quantity-input" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full py-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required />
              <button type="button" id="increment-button" data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                  <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                </svg>
              </button>
            </div>
          </form>
        </td>
        <td class="px-6 py-4">
          <button type="button" class="relative justify-center p-0.5 mb-2 text-white bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-2 py-2 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6">
              <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
            </svg>
          </button>
        </td>
      </tr>
    </tbody>
  </table>
</div>
{{-- total harga --}}
<footer class="fixed bottom-0 left-0 z-20 w-full p-2 bg-white border-t border-gray-200 shadow md:flex md:items-center md:justify-between md:p-2 dark:bg-gray-800 dark:border-gray-600">
  <span class="text-xs text-gray-400 sm:text-center dark:text-gray-400">
    <a href="https://flowbite.com/" class="hover:underline">
    </a>
  </span>
  <ul class="flex flex-wrap items-center mt-2 text-sm text-gray-500 dark:text-gray-400 sm:mt-0">
    <li>
      <a href="#" class="hover:underline me-2 md:me-4">3 Selected
      </a>
    </li>
    <li>
      <a href="#" class="hover:underline me-2 md:me-4">Total Price
      </a>
    </li>
    <li>
      <button type="button" class="transition ease-in-out delay-150 hover:-translate-y-1 hover:scale-110 hover:bg-indigo-500 duration-300 
      bg-gradient-to-r from-red-200 via-red-300 to-yellow-200 hover:bg-gradient-to-bl focus:ring-4 
      focus:outline-none focus:ring-red-100 dark:focus:ring-red-400 font-extrabold rounded-lg px-6 py-2 text-center">Checkout
      </button>
    </li>
  </ul>
</footer>