@extends('layout.app')

@section('title')
    Tentang
@endsection

@section('content')
<div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2 mt-4 mb-4 overflow-hidden">
    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
        Data Kategori
    </h1>
    <div class="bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:align-middle w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
        <form id="addDataForm" class="max-h-full overflow-y-auto" style="max-height: 80vh;" method="POST" enctype="multipart/form-data" action="/tentang/{{ $about->id }}">
          @csrf
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                <div class="sm:flex sm:items-start">
                    <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
                        <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
                        </svg>
                    </div>
                    <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                        <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                            Tambah Data Kategori
                        </h3>
                        <div class="mt-2 w-full">
                            <div class="mb-4 w-full">
                                <label for="judul_website" class="block text-sm font-medium text-gray-700">Judul Website</label>
                                <input type="text" name="judul_website" id="judul_website" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Judul Website" 
                                required value="{{ isset($about) ? $about->judul_website : '' }}">
                            </div>
                            @if(isset($about))
                                <img src="/uploads/{{ $about->logo }}" alt="" width="200">
                            @endif
                            <div class="mb-4 w-full">
                                <label for="logo" class="block text-sm font-medium text-gray-700">Logo</label>
                                <input type="file" name="logo" id="logo" accept="image/*" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Logo">
                            </div>
                            <div class="mb-4 w-full">
                                <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                                <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Deskripsi"
                                required>{{ isset($about) ? $about->deskripsi : '' }}</textarea>
                            </div>
                            <div class="mb-4 w-full">
                                <label for="alamat" class="block text-sm font-medium text-gray-700">Alamat</label>
                                <input type="text" name="alamat" id="alamat" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Alamat"
                                required value="{{ isset($about) ? $about->alamat : '' }}">
                            </div>
                            <div class="mb-4 w-full">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="text" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Example@gmail.com"
                                required value="{{ isset($about) ? $about->email : '' }}">
                            </div>
                            <div class="mb-4 w-full">
                                <label for="telepon" class="block text-sm font-medium text-gray-700">Telepon</label>
                                <input type="text" name="telepon" id="telepon" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Telepon"
                                required value="{{ isset($about) ? $about->telepon : '' }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Submit</button>
                <button type="button" id="closeAddModalButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
            </div>
        </form>
    </div>
</div>

@endsection
