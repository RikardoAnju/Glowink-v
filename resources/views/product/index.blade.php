@extends('layout.app')

@section('title', 'Produk')

@section('content')
<div class="container mx-auto px-2 w-full">
    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
        Data Produk
    </h1>

    <div class="container mx-auto px-2 w-full">
      <div class="flex justify-end mb-4">
          <a href="#modal-from" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block modal-tambah">
              Tambah Data
          </a>
     </div>

    <div id="recipients" class="p-8 mt-3 lg:mt-1 rounded shadow bg-white overflow-x-auto">
      <table id="example" class="stripe hover min-w-full"> <!-- Menambahkan kelas min-w-full pada tabel -->
          <thead>
              <tr>
                  <th class="px-4 py-2 w-10">No</th> 
                  <th class="px-4 py-2 w-48">Kategori</th> 
                  <th class="px-4 py-2 w-48">Subkategori</th> 
                  <th class="px-4 py-2 w-48">Nama Barang</th> 
                  <th class="px-4 py-2 w-48">Harga</th> 
                  <th class="px-4 py-2 w-48">Sku</th> 
                  <th class="px-4 py-2 w-48">Bahan</th> 
                  <th class="px-4 py-2 w-48">Ukuran</th> 
                  <th class="px-4 py-2 w-48">Stok</th> 
                  <th class="px-4 py-2 w-48">Manfaat</th> 
                  <th class="px-4 py-2 w-64">Deskripsi</th> 
                  <th class="px-4 py-2 w-24">Gambar</th> 
                  <th class="px-4 py-2 w-32">Aksi</th> 
              </tr>
          </thead>
          <tbody id="kategoriTableBody">
              <!-- Data from API will be inserted here -->
          </tbody>
      </table>
  </div>

</div>

<!-- Modal Tambah Data -->
<div id="addDataModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form id="addDataForm">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
              <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                Tambah Data Produk
              </h3>

              <div class="mt-2">
                <select name="id_kategori" id="id_kategori" class="form-control mt-1 block w-full">
                  @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                  @endforeach
              </select>
              
              <!-- Bagian Subkategori -->
              <select name="id_subkategori" id="id_subkategori" class="form-control mt-1 block w-full">
                  @foreach ($subcategories as $category)
                      <option value="{{ $category->id }}">{{ $category->nama_subkategori }}</option>
                  @endforeach
              </select>
                <div class="mb-4">
                  <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
                  <input type="text" name="nama_barang" id="nama_barang" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Nama Barang">
                </div>
                <div class="mb-4">
                  <label for="harga" class="block text-sm font-medium text-gray-700">Harga:</label>
                  <input type="number" name="harga" id="harga"  class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Harga Barang">
                </div>
                <div class="mb-4">
                  <label for="sku" class="block text-sm font-medium text-gray-700">Sku:</label>
                  <input type="text" name="sku" id="sku" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Sku Barang">
                </div>
                <div class="mb-4">
                  <label for="bahan" class="block text-sm font-medium text-gray-700">Bahan:</label>
                  <input type="text" name="bahan" id="bahan"  class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang">
                </div>
                <div class="mb-4">
                  <label for="ukuran" class="block text-sm font-medium text-gray-700">Ukuran:</label>
                  <input type="text" name="ukuran" id="ukuran"  class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang">
                </div>
                <div class="mb-4">
                  <label for="stok" class="block text-sm font-medium text-gray-700">Stok:</label>
                  <input type="number" name="stok" id="stok"  class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang">
                </div>
                <div class="mb-4">
                  <label for="manfaat" class="block text-sm font-medium text-gray-700">Manfaat:</label>
                  <input type="text" name="manfaat" id="manfaat"  class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang">
                </div>

                <div class="mb-4">
                  <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                  <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
                </div>
                <div class="mb-4">
                  <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                  <input type="file" name="gambar" id="gambar" accept="image/*" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
          <button type="button" id="closeAddModalButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!--modal konfirmasi di tambahkan-->

<div id="successAddConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
              Berhasil Ditambahkan
            </h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Data berhasil ditambahkan.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="confirmSuccessAddButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
          OK
        </button>
      </div>
    </div>
  </div>
</div>

<!--- modal konfirmasi data telah di hapus-->
<div id="deleteConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-red-100 sm:mx-0 sm:h-10 sm:w-10">
            <svg class="h-6 w-6 text-red-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856a2 2 0 001.789-2.895L13.789 4.105A2 2 0 0012.001 2a2 2 0 00-1.789 1.105L3.211 15.105a2 2 0 001.789 2.895z" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
              Konfirmasi Penghapusan
            </h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Apakah Anda yakin ingin menghapus data ini?
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="confirmDeleteButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-red-600 text-base font-medium text-white hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500 sm:ml-3 sm:w-auto sm:text-sm">
          Hapus
        </button>
        <button type="button" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm btn-batal">
          Batal
        </button>
      </div>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Data Berhasil Dihapus -->
<div id="successDeleteConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
              Berhasil Dihapus
            </h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Data berhasil dihapus.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="confirmSuccessDeleteButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
          OK
        </button>
      </div>
    </div>
  </div>
</div>


<!-- Modal Edit Data -->
<div id="editDataModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form id="editDataForm" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
              <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                Edit data SubKategori
              </h3>
              <div class="mt-2">

                <select name="id_kategori" id="id_kategori" class="form-control mt-1 block w-full" required>
                  <option value="">Pilih Kategori</option>
                  @foreach ($categories as $category)
                      <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                  @endforeach
              </select>
              
              <!-- Bagian Subkategori -->
              
              <select name="id_subkategori" id="id_subkategori" class="form-control mt-1 block w-full">
                @foreach ($subcategories as $category)
                    <option value="{{ $category->id }}">{{ $category->nama_subkategori }}</option>
                @endforeach
            </select>

              <div class="mb-4">
                  <label for="nama_barang" class="block text-sm font-medium text-gray-700">Nama Barang:</label>
                  <input type="text" name="nama_barang" id="nama_barang" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Harga Barang" required>
              </div>
              <div class="mb-4">
                  <label for="harga" class="block text-sm font-medium text-gray-700">Harga:</label>
                  <input type="number" name="harga" id="harga" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Harga Barang" required>
              </div>
              
              
              <div class="mb-4">
                  <label for="sku" class="block text-sm font-medium text-gray-700">SKU:</label>
                  <input type="text" name="sku" id="sku" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan SKU Barang" required>
              </div>
              
              <div class="mb-4">
                  <label for="bahan" class="block text-sm font-medium text-gray-700">Bahan:</label>
                  <input type="text" name="bahan" id="bahan" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang" required>
              </div>
              <div class="mb-4">
                  <label for="ukuran" class="block text-sm font-medium text-gray-700">Ukuran:</label>
                  <input type="text" name="ukuran" id="ukuran" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang" required>
              </div>
              <div class="mb-4">
                  <label for="stok" class="block text-sm font-medium text-gray-700">Stok:</label>
                  <input type="number" name="stok" id="stok" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang" required>
              </div>
              <div class="mb-4">
                  <label for="manfaat" class="block text-sm font-medium text-gray-700">Manfaat:</label>
                  <input type="text" name="manfaat" id="manfaat" class="mt-1 p-2 border border-gray-300 rounded-md w-full" placeholder="Masukkan Stok Barang" required>
              </div>
              
                <div class="mb-4">
                  <label for="deskripsi" class="block text-sm font-medium text-gray-700">Deskripsi</label>
                  <textarea name="deskripsi" id="deskripsi" rows="3" class="mt-1 p-2 border border-gray-300 rounded-md w-full"></textarea>
                </div>
                <div class="mb-4">
                  <label for="gambar" class="block text-sm font-medium text-gray-700">Gambar</label>
                  <input type="file" name="gambar" id="gambar" accept="image/*" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <button type="submit" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-blue-600 text-base font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 sm:ml-3 sm:w-auto sm:text-sm">Simpan</button>
          <button type="button" id="closeEditModalButton" class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">Batal</button>
        </div>
      </form>
    </div>
  </div>
</div>

<!-- Modal Konfirmasi Berhasil Diubah -->
<div id="successEditConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
        <div class="sm:flex sm:items-start">
          <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-green-100 sm:mx-0 sm:h-10 sm:w-10">
            <svg class="h-6 w-6 text-green-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
          </div>
          <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
              Berhasil Diubah
            </h3>
            <div class="mt-2">
              <p class="text-sm text-gray-500">
                Data berhasil diubah.
              </p>
            </div>
          </div>
        </div>
      </div>
      <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
        <button type="button" id="confirmSuccessEditButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
          OK
        </button>
      </div>
    </div>
  </div>
</div>



<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
  $(document).ready(function () {
      var ERROR_MESSAGE = "An error occurred while processing your request.";  // Definisikan variabel ERROR_MESSAGE

      var table = $('#example').DataTable({
          responsive: true,
          paging: false,
          searching: false,
          language: {
              emptyTable: "Tidak ada data yang tersedia dalam tabel",
              zeroRecords: "Tidak ada data yang cocok dengan pencarian",
          },
          scrollY: "50vh",
          scrollCollapse: true,
          info: false,
          ordering: false
      });

      function populateTable(data) {
          var row = '';
          data.forEach(function (val, index) {
              var categoryName = val.category ? val.category.nama_kategori : 'N/A';
              var subcategoryName = val.subcategory ? val.subcategory.nama_subkategori : 'N/A';
              row += '<tr>' +
                  '<td class="px-4 py-2 w-16">' + (index + 1) + '</td>' +
                  '<td class="px-4 py-2 w-48 break-all">' + categoryName + '</td>' +
                  '<td class="px-4 py-2 w-48 break-all">' + subcategoryName + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.nama_barang + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.harga + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.sku + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.bahan + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.ukuran + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.stok + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.manfaat + '</td>' +
                  '<td class="px-4 py-2 w-64 break-all">' + val.deskripsi + '</td>' +
                  '<td class="px-4 py-2 w-24"><img src="/' + val.gambar + '" width="250" height="auto"></td>' +
                  '<td class="px-4 py-2 w-10 flex items-center gap-2">' +
                  '<a href="#" data-id="' + val.id + '" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-2 rounded modal-ubah">Edit</a>' +
                  '<button data-id="' + val.id + '" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-2 rounded btn-hapus">Hapus</button>' +
                  '</td>' +
                  '</tr>';
          });
          $('#kategoriTableBody').html(row);
      }

      // Fungsi untuk mengambil data dari server dan memperbarui tabel
      function fetchDataAndPopulateTable() {
          $.ajax({
              url: '/api/products',
              success: function (response) {
                  populateTable(response.data);
              },
              error: function (xhr, status, error) {
                  console.error(ERROR_MESSAGE, xhr, status, error);
                  console.log(xhr.responseText);
              }
          });
      }

      // Memanggil fungsi untuk mengisi tabel saat dokumen siap
      fetchDataAndPopulateTable();

      // Event handler untuk tombol hapus
      $(document).on('click', '.btn-hapus', function () {
          var id = $(this).data('id');
          $('#deleteConfirmationModal').removeClass('hidden');

          $('#confirmDeleteButton').off('click').on('click', function () {
              $.ajax({
                  url: '/api/products/' + id,
                  type: 'DELETE',
                  success: function () {
                      $('#deleteConfirmationModal').addClass('hidden');
                      $('#successDeleteConfirmationModal').removeClass('hidden');
                      setTimeout(function () {
                          $('#successDeleteConfirmationModal').addClass('hidden');
                      }, 2000);
                      fetchDataAndPopulateTable();
                  },
                  error: function (xhr, status, error) {
                      console.error(ERROR_MESSAGE, xhr, status, error);
                      console.log(xhr.responseText);
                  }
              });
          });

          $('.btn-batal').off('click').on('click', function () {
              $('#deleteConfirmationModal').addClass('hidden');
          });
      });

      // Event handler untuk tombol edit
      $(document).on('click', '.modal-ubah', function () {
          var id = $(this).data('id');
          $.ajax({
              url: '/api/products/' + id,
              type: 'GET',
              success: function (response) {
                  $('#editDataForm input[name="id_kategori"]').val(response.id_kategori);
                  $('#editDataForm input[name="nama_barang"]').val(response.nama_barang);
                  $('#editDataForm input[name="harga"]').val(response.harga);
                  $('#editDataForm input[name="bahan"]').val(response.bahan);
                  $('#editDataForm input[name="ukuran"]').val(response.ukuran);
                  $('#editDataForm input[name="stok"]').val(response.stok);
                  $('#editDataForm input[name="manfaat"]').val(response.manfaat);
                  $('#editDataForm select[name="id_subkategori"]').val(response.id_subkategori);
                  $('#editDataForm textarea[name="deskripsi"]').val(response.deskripsi);
                  $('#editDataForm').attr('action', '/api/products/' + id);
                  $('#editDataModal').removeClass('hidden');
              },
              error: function (xhr, status, error) {
                  console.error(ERROR_MESSAGE, xhr, status, error);
                  console.log(xhr.responseText);
              }
          });
      });

      // Event handler untuk form edit
      $('#editDataForm').on('submit', function (e) {
          e.preventDefault();
          var formData = new FormData($(this)[0]);
          $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function () {
                  $('#editDataModal').addClass('hidden');
                  $('#successEditConfirmationModal').removeClass('hidden');
                  setTimeout(function () {
                      $('#successEditConfirmationModal').addClass('hidden');
                  }, 2000);
                  fetchDataAndPopulateTable();
              },
              error: function (xhr, status, error) {
                  console.error(ERROR_MESSAGE, xhr, status, error);
                  console.log(xhr.responseText);
              }
          });
      });

      // Event handler untuk tombol tambah
      $(document).on('click', '.modal-tambah', function () {
          $('#addDataModal').removeClass('hidden');
      });

      // Event handler untuk form tambah
      $('#addDataForm').on('submit', function (e) {
          e.preventDefault();
          var formData = new FormData($(this)[0]);
          $.ajax({
              url: '/api/products',
              type: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function () {
                  $('#addDataModal').addClass('hidden');
                  $('#successAddConfirmationModal').removeClass('hidden');
                  setTimeout(function () {
                      $('#successAddConfirmationModal').addClass('hidden');
                  }, 2000);
                  $('#addDataForm')[0].reset();
                  fetchDataAndPopulateTable();
              },
              error: function (xhr, status, error) {
                  console.error(ERROR_MESSAGE, xhr, status, error);
                  console.log(xhr.responseText);
              }
          });
      });

      // Event handler untuk tombol tutup modal tambah
      $('#closeAddModalButton').on('click', function () {
          $('#addDataModal').addClass('hidden');
      });

      // Event handler untuk tombol tutup modal edit
      $('#closeEditModalButton').on('click', function () {
          $('#editDataModal').addClass('hidden');
      });

      // Event handler untuk tombol konfirmasi sukses edit
      $('#confirmSuccessEditButton').on('click', function () {
          $('#successEditConfirmationModal').addClass('hidden');
      });

      // Event handler untuk tombol konfirmasi sukses hapus
      $('#confirmSuccessDeleteButton').on('click', function () {
          $('#successDeleteConfirmationModal').addClass('hidden');
      });
  });
</script>

  

@endsection
