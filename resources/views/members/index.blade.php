@extends('layout.app')

@section('title', 'Data Members')

@section('content')

<div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2">
    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
        Data Member
    </h1>

    <div class="flex justify-end mb-4">
        <a href="#modal-from" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded inline-block modal-tambah">
            Tambah Data
        </a>
    </div>

    <!-- Bagian untuk menampilkan jumlah member -->
    <div class="mb-4">
        <span class="text-gray-700">Jumlah Member Terdaftar: </span><span id="totalMembers" class="font-bold text-indigo-500">0</span>
    </div>

    <div id="recipients" class="p-8 mt-3 lg:mt-1 rounded shadow bg-white overflow-x-auto">
        <table id="example" class="stripe hover border-collapse border border-gray-300" style="width:100%;">
            <thead>
                <tr class="border border-gray-300">
                    <th class="px-2 py-2 w-10 border border-gray-300">No</th>
                    <th class="px-1 py-2 w-20 border border-gray-300">Nama member</th>
                    <th class="px-2 py-4 w-20 border border-gray-300">No Hp</th>
                    <th class="px-14 py-2 w-24 border border-gray-300">Email</th>
                    <th class="px-14 py-2 w-24 border border-gray-300">Password</th>
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
                Tambah Data Member
              </h3>
              <div class="mt-2">
                <div class="mb-4">
                  <label for="nama_member" class="block text-sm font-medium text-gray-700">Nama Member</label>
                  <input type="text" name="nama_member" id="nama_member" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="mb-4">
                  <label for="no_hp" class="block text-sm font-medium text-gray-700">No Hp</label>
                  <input type="text" id="no_hp" name="no_hp" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="mb-4">
                  <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                  <input type="email" name="email" id="email" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
                </div>
                <div class="mb-4">
                  <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                  <input type="password" name="password" id="password" class="mt-1 p-2 border border-gray-300 rounded-md w-full">
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

<!-- Modal Konfirmasi Berhasil -->
<div id="successConfirmationModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
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
          <button type="button" id="confirmSuccessButton" class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-green-600 text-base font-medium text-white hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500 sm:ml-3 sm:w-auto sm:text-sm">
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
  
      // buat memasukan data ke tabel
      function fetchDataAndPopulateTable() {
          $.ajax({
              url: '/api/members',
              success: function(response) {
                  var data = response.data;
                  var row = '';
                  data.forEach(function(val, index) {
                      row += '<tr>' +
                          '<td class="px-4 py-2 w-16 border border-gray-300">' + (index + 1) + '</td>' +
                          '<td class="px-4 py-2 w-48 border border-gray-300 break-all">' + val.nama_member + '</td>' +
                          '<td class="px-2 py-1 w-64 border border-gray-300 break-all">' + val.no_hp + '</td>' +
                          '<td class="px-4 py-2 w-64 border border-gray-300 break-all">' + val.email + '</td>' +
                          '<td class="px-4 py-2 w-64 border border-gray-300 break-all">' + val.password + '</td>' +
                          '</tr>';
                  });
                  $('#kategoriTableBody').html(row);
                  // Update jumlah member terdaftar
                  $('#totalMembers').text(data.length);
              }
          });
      }
  
      // Panggil fungsi untuk memuat tabel secara awal
      fetchDataAndPopulateTable();
  
      // Event handler untuk menampilkan modal tambah data
      $(document).on('click', '.modal-tambah', function () {
          $('#addDataModal').removeClass('hidden');
      });
  
      // Event handler untuk menutup modal tambah data
      $('#closeAddModalButton').on('click', function () {
          $('#addDataModal').addClass('hidden');
      });
  
      // Event handler untuk submit form tambah data
      $('#addDataForm').on('submit', function (e) {
          e.preventDefault();
          var formData = new FormData($(this)[0]);
          $.ajax({
              url: '/api/members',
              type: 'POST',
              data: formData,
              cache: false,
              contentType: false,
              processData: false,
              success: function () {
                  $('#addDataModal').addClass('hidden');
                  $('#successAddConfirmationModal').removeClass('hidden');
                  // Sembunyikan modal sukses setelah 2 detik
                  setTimeout(function () {
                      $('#successAddConfirmationModal').addClass('hidden');
                  }, 2000);
                  // Muat ulang dan perbarui tabel setelah menambahkan data baru
                  fetchDataAndPopulateTable();
              },
              error: function () {
                  console.log('Error in adding new record');
              }
          });
      });
  
      // Event handler untuk menutup modal sukses tambah data
      $('#confirmSuccessAddButton').on('click', function () {
          $('#successAddConfirmationModal').addClass('hidden');
      });
  
      // Event handler untuk menutup modal sukses hapus data
      $('#confirmSuccessButton').on('click', function () {
          $('#successConfirmationModal').addClass('hidden');
      });
  });
  </script>
  @endsection
  