@extends('layout.app')

@section('title', 'Data Payment')

@section('content')
<div class="container mx-auto px-2 w-full">
    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
        Data Payment
    </h1>

    <div id="recipients" class="p-8 mt-3 lg:mt-1 rounded shadow bg-white overflow-x-auto">
        <table id="example" class="stripe hover w-full">
            <thead>
                <tr>
                    <th class="px-4 py-2 w-16">No</th>
                    <th class="px-4 py-2 w-35">Tanggal</th>
                    <th class="px-2 py-2 w-40">Order</th>
                    <th class="px-14 py-2 w-20">Jumlah</th>
                    <th class="px-6 py-2 w-64">No Rekening</th> 
                    <th class="px-4 py-2 w-64">Atas Nama</th> 
                    <th class="px-1 py-2 w-64">Status</th> 
                    <th class="px-10 py-5 w-14">Aksi</th>
                </tr>
            </thead>
            <tbody id="kategoriTableBody">
                <!-- Data dari API akan dimasukkan di sini -->
            </tbody>
        </table>
    </div> 
</div>

<!-- Modal Form Pembayaran -->
<div id="editDataForm" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
  <div class="flex items-center justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity" aria-hidden="true"></div>
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen" aria-hidden="true">&#8203;</span>
    <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full" role="dialog" aria-modal="true" aria-labelledby="modal-headline">
      <form id="editDataForm " method="POST" action="#">
        @csrf
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
          <div class="sm:flex sm:items-start">
            <div class="mx-auto flex-shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-100 sm:mx-0 sm:h-10 sm:w-10">
              <svg class="h-6 w-6 text-blue-600" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
              </svg>
            </div>
            <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left">
              <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-headline">
                Form Pembayaran
              </h3>
              <div class="mt-2">
                <div class="mb-4">
                  <label for="tanggal" class="block text-sm font-medium text-gray-700">Tanggal</label>
                  <input type="text" name="tanggal" id="tanggal" class="mt-1 p-2 border border-gray-300 rounded-md w-full" readonly>
                </div>
                <div class="mb-4">
                  <label for="jumlah" class="block text-sm font-medium text-gray-700">Jumlah</label>
                  <input type="text" name="jumlah" id="jumlah" class="mt-1 p-2 border border-gray-300 rounded-md w-full"  readonly>
                </div>
                <div class="mb-4">
                  <label for="no_rekening" class="block text-sm font-medium text-gray-700">No Rekening</label>
                  <input type="text" name="no_rekening" id="no_rekening" class="mt-1 p-2 border border-gray-300 rounded-md w-full"  readonly>
                </div>
                <div class="mb-4">
                  <label for="atas_nama" class="block text-sm font-medium text-gray-700">Atas Nama</label>
                  <input type="text" name="atas_nama" id="atas_nama" class="mt-1 p-2 border border-gray-300 rounded-md w-full"  readonly>
                </div>
                <div class="mb-4">
                  <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                  <select name="status" id="status" class="form-control mt-1 p-2 border border-gray-300 rounded-md w-full">
                    <option value="diterima">DITERIMA</option>
                    <option value="ditolak">DITOLAK</option>
                    <option value="menunggu">MENUNGGU</option>
                  </select>
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

<!-- Include jQuery and DataTables library -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
  $(document).ready(function() {
  // Inisialisasi DataTable
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

  // Fungsi untuk memasukkan data ke dalam tabel
  function fetchDataAndPopulateTable() {
    $.ajax({
      url: '/api/payments',
      success: function(response) {
        var data = response.data;
        var row = '';
        data.forEach(function(val, index) {
          var tgl = new Date(val.created_at);
          var tgl_lengkap = `${tgl.getDate()}-${tgl.getMonth() + 1}-${tgl.getFullYear()}`; // Mengubah bulan menjadi +1 karena indeks bulan dimulai dari 0
          row += '<tr class="table-row">' +
            '<td class="px-4 py-2 w-16">' + (index + 1) + '</td>' +
            '<td class="px-4 py-2 w-48 break-all">' + tgl_lengkap + '</td>' +
            '<td class="px-4 py-2 w-64 break-all">' + val.id_order + '</td>' +
            '<td class="px-4 py-2 w-24 break-all">' + val.jumlah + '</td>' +
            '<td class="px-4 py-2 w-64 break-all">' + val.no_rekening + '</td>' +
            '<td class="px-4 py-2 w-64 break-all">' + val.atas_nama + '</td>' +
            '<td class="px-4 py-2 w-64 break-all">' + val.status + '</td>' +
            '<td class="px-4 py-2 w-32 flex items-center gap-2">' +
            '<button class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-2 rounded modal-ubah" data-id="' + val.id + '">Edit</button>' +
            '</td>' +
            '</tr>';
        });
        $('#kategoriTableBody').html(row);
      },
      error: function(xhr) {
        console.log('Error fetching data: ' + xhr.responseText);
      }
    });
  }

  // Panggil fungsi untuk memuat dan mengisi kembali tabel pada awalnya
  fetchDataAndPopulateTable();

  // Event untuk menangani klik tombol "Edit"
$(document).on('click', '.modal-ubah', function(e) {
    e.preventDefault();
    var id = $(this).data('id');
    $.ajax({
        url: '/api/payments/' + id,
        type: 'GET',
        success: function(response) {
            var data = response.data;
            var tgl = new Date(data.created_at);
            var tgl_lengkap = `${tgl.getDate()}-${tgl.getMonth() + 1}-${tgl.getFullYear()}`;
            $('#editDataForm input[name="tanggal"]').val(tgl_lengkap);
            $('#editDataForm input[name="jumlah"]').val(data.jumlah);
            $('#editDataForm input[name="no_rekening"]').val(data.no_rekening);
            $('#editDataForm input[name="atas_nama"]').val(data.atas_nama);
            $('#editDataForm select[name="status"]').val(data.status);
            $('#editDataForm').attr('data-id', id);
            $('#editDataForm').removeClass('hidden');
        },
        error: function(xhr) {
            console.log('Error fetching record for edit: ' + xhr.responseText);
        }
    });
});

$('#editDataForm').on('submit', function(e) {
    e.preventDefault();
    var id = $(this).attr('data-id');
    var status = $('#status').val(); // Tangkap nilai "status"
    var formData = $(this).serialize();

    // Periksa apakah status tidak kosong
    if (!status) {
        console.log('Status field is required.');
        return;
    }

    // Tambahkan nilai "status" ke dalam data yang dikirimkan
    formData += '&status=' + status;

    $.ajax({
        url: '/api/payments/' + id,
        type: 'PUT',
        data: formData,
        success: function(response) {
            // Tampilkan modal konfirmasi
            $('#successEditConfirmationModal').removeClass('hidden');
            // Perbarui tabel setelah berhasil mengubah status
            fetchDataAndPopulateTable();
            // Sembunyikan modal edit form
            $('#editDataForm').addClass('hidden');
        },
        error: function(xhr) {
            console.log('Error updating record: ' + xhr.responseText);
        }
    });
});


  // Event untuk menutup modal "Edit"
  $('#closeAddModalButton').on('click', function(e) {
    e.preventDefault();
    $('#editDataForm').addClass('hidden');
  });

  // Event untuk menutup modal konfirmasi setelah berhasil diubah
  $('#confirmSuccessEditButton').on('click', function(e) {
    e.preventDefault();
    $('#successEditConfirmationModal').addClass('hidden');
  });
});

</script>
@endsection
