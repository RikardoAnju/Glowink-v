@extends('layout.app')

@section('title', 'Data Subkategori')

@section('content')
<div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2">
    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
        Data Subkategori
    </h1>

    <div class="flex justify-end mb-4">
        <a href="#modal-from" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block modal-tambah">
            Tambah Data
        </a>
    </div>

    <div id="recipients" class="p-8 mt-3 lg:mt-1 rounded shadow bg-white overflow-x-auto">
        <table id="example" class="stripe hover" style="width:100%;">
            <thead>
                <tr>
                   <th class="px-4 py-2 w-10">No</th>
                    <th class="px-4 py-2">Nama Kategori</th>
                    <th class="px-4 py-2 w-48">Nama SubKategori</th>
                    <th class="px-1 py-2 w-64">Deskripsi</th>
                    <th class="px-5 py-2 w-30">Gambar</th>
                    <th class="px-4 py-2 w-32">Aksi</th>
                </tr>
            </thead>
            <tbody id="kategoriTableBody">
                <!-- Data dari API akan dimasukkan di sini -->
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
                Tambah Data SubKategori
              </h3>
              <div class="mt-2">
                <div class="mb-4">
                  <label for="nama_subkategori" class="block text-sm font-medium text-gray-700">Nama Subkategori</label>
                  <input type="text" name="nama_subkategori" id="nama_subkategori" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="form-group">
                  <label for="id_kategori" class="block">Kategori</label>
                  <select name="id_kategori" id="id_kategori" class="form-control mt-1 block w-full">
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                      @endforeach
                  </select>
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
                <div class="form-group">
                  <label for="id_kategori" class="block">Kategori</label>
                  <select name="id_kategori" id="id_kategori" class="form-control mt-1 block w-full">
                      @foreach ($categories as $category)
                          <option value="{{ $category->id }}">{{ $category->nama_kategori }}</option>
                      @endforeach
                  </select>
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
  $(document).ready(function() {
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

      // Function untuk mengambil dan mengisi tabel dengan data
      function fetchDataAndPopulateTable() {
          $.ajax({
              url: '/api/subcategories',
              success: function(response) {
                  var data = response.data;
                  var row = '';

                  data.forEach(function(val, index) {
                      var categoryName = val.category ? val.category.nama_kategori : 'N/A';
                      row += '<tr>' +
                          '<td class="px-4 py-2 w-16">' + (index + 1) + '</td>' +
                          '<td class="px-4 py-2 w-48 break-all">' + val.nama_subkategori + '</td>' +
                          '<td class="px-4 py-2 w-48 break-all">' + categoryName + '</td>' +
                          '<td class="px-4 py-2 w-64 break-all">' + val.deskripsi + '</td>' +
                          '<td class="px-4 py-2 w-24"><img src="/' + val.gambar + '" width="250" height="auto"></td>' +
                          '<td class="px-4 py-2 w-32 flex items-center gap-2">' +
                          '<a href="#" data-id="' + val.id + '" class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-2 rounded modal-ubah">Edit</a>' +
                          '<button data-id="' + val.id + '" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-2 rounded btn-hapus">Hapus</button>' +
                          '</td>' +
                          '</tr>';
                  });

                  $('#kategoriTableBody').html(row);
              }
          });
      }

      // Panggil fungsi untuk mengisi tabel pada awalnya
      fetchDataAndPopulateTable();

      // Event handler untuk tombol hapus
     // Event handler untuk tombol hapus
$(document).on('click', '.btn-hapus', function () {
    var id = $(this).data('id');
    $('#deleteConfirmationModal').removeClass('hidden');

    $('#confirmDeleteButton').off('click').on('click', function () {
        $.ajax({
            url: '/api/subcategories/' + id,
            type: 'DELETE',
            success: function () {
                $('#deleteConfirmationModal').addClass('hidden');
                $('#successDeleteConfirmationModal').removeClass('hidden');
                setTimeout(function () {
                    $('#successDeleteConfirmationModal').addClass('hidden');
                }, 2000);
                fetchDataAndPopulateTable();
            },
            error: function () {
                console.log('Error dalam menghapus rekaman');
            }
        });
    });

    $('.btn-batal').off('click').on('click', function () {
        $('#deleteConfirmationModal').addClass('hidden');
    });
});

// Event handler untuk tombol OK pada modal konfirmasi berhasil dihapus
$('#confirmSuccessDeleteButton').on('click', function () {
    $('#successDeleteConfirmationModal').addClass('hidden');
});

      // Event handler untuk menampilkan modal tambah
      $(document).on('click', '.modal-tambah', function () {
          $('#addDataModal').removeClass('hidden');
      });

      // Event handler untuk menutup modal tambah
      $('#closeAddModalButton').on('click', function () {
          $('#addDataModal').addClass('hidden');
      });

      $('#closeEditModalButton').on('click', function () {
          $('#editDataModal').addClass('hidden');
      });

      // Submit handler untuk add form
      $('#addDataForm').on('submit', function (e) {
          e.preventDefault();
          var formData = new FormData($(this)[0]);
          $.ajax({
              url: '/api/subcategories',
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
                  // Reset formulir setelah menambahkan data
                  $('#addDataForm')[0].reset();
                  fetchDataAndPopulateTable();
              },
              error: function () {
                  console.log('Error dalam menambahkan rekaman baru');
              }
          });
      });

      // Submit handler untuk edit form

      $(document).on('click', '.modal-ubah', function () {
    var id = $(this).data('id');


    $.ajax({
        url: '/api/subcategories/' + id,
        type: 'GET',
        success: function (response) {
            // Isi formulir edit data dengan data yang diambil
            $('#editDataForm input[name="id_kategori"]').val(response.nama_subkategori);
            $('#editDataForm select[name="id_kategori"]').val(response.id_kategori);
            $('#editDataForm textarea[name="deskripsi"]').val(response.deskripsi);
            $('#editDataForm').attr('action', '/api/subcategories/' + id);
            $('#editDataModal').removeClass('hidden');
        },
        error: function () {
            console.log('Error in fetching record for edit');
        }
    });
});

// Submit handler untuk form edit data
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
            $('#successEditConfirmationModal').removeClass('hidden'); // Tampilkan modal konfirmasi berhasil diubah
            // Sembunyikan modal sukses setelah 2 detik
            setTimeout(function () {
                $('#successEditConfirmationModal').addClass('hidden');
            }, 2000);
            // Muat ulang dan isi kembali tabel setelah pengubahan data
            fetchDataAndPopulateTable();
        },
        error: function () {
            console.log('Error in editing the record');
        }
    });
});

// Event handler untuk tombol OK pada modal konfirmasi berhasil diubah
$('#confirmSuccessEditButton').on('click', function () {
    $('#successEditConfirmationModal').addClass('hidden');
});
      
  });
</script>

@endsection
