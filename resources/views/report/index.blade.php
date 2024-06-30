@extends('layout.app')

@section('title', 'Laporan Pesanan')

@section('content')
<style>
  #example {
      border-collapse: collapse;
  }
  #example th,
  #example td {
      border: 1px solid #e2e8f0; /* Atur warna garis sesuai kebutuhan */
      padding: 8px; /* Atur jarak antara isi dan batas sel */
  }
</style>

<div class="container mx-auto px-4 py-8">
  <h1 class="font-sans font-bold text-indigo-500 text-xl md:text-2xl">
      Laporan Pesanan
  </h1>
  <div class="my-4">
    <form>
        <div class="mb-4">
            <label for="dari" class="block text-sm font-medium text-gray-700">Dari</label>
            <input type="date" name="dari" id="dari" class="mt-1 block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
            value="{{ request()->input('dari') }}">
        </div>
        <div class="mb-4">
            <label for="sampai" class="block text-sm font-medium text-gray-700">Sampai</label>
            <input type="date" name="sampai" id="sampai" class="mt-1 block w-1/2 px-3 py-2 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            value="{{ request()->input('sampai') }}">
        </div>
        <div class="mb-4">
            <button type="submit" class="w-40 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Submit</button>
        </div>
    </form>
  </div>
  @if (request()->input('dari') && request()->input('sampai'))

  <div id="recipients" class="p-4 mt-3 lg:mt-1 rounded shadow bg-white overflow-x-auto">
      <table id="example" class="min-w-full divide-y divide-gray-200">
          <thead>
              <tr>
                  <th class="px-4 py-2">No</th>
                  <th class="px-4 py-2">Nama Barang</th>
                  <th class="px-4 py-2">Harga</th>
                  <th class="px-4 py-2">Jumlah Dibeli</th>
                  <th class="px-4 py-2">Pendapatan</th>
                  <th class="px-4 py-2">Total Qty</th>
              </tr>
          </thead>
          <tbody id="kategoriTableBody">
              <!-- Data dari API akan dimasukkan di sini -->
          </tbody>
      </table>
  </div>
  @endif
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
  $(document).ready(function() {
const dari = '{{ request()->input('dari') }}';
const sampai = '{{ request()->input('sampai') }}';
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
// Fungsi untuk memformat angka menjadi rupiah
function rupiah(angka){
    const format = angka.toString().split('').reverse().join('');
    const convert = format.match(/\d{1,3}/g);
    return 'Rp' + convert.join('.').split('').reverse().join('');
}
// Fungsi untuk mengambil data dari API dan mengisi tabel
function fetchDataAndPopulateTable() {
    const token = localStorage.getItem('token');
    $.ajax({
        url: '/api/reports?dari=' + dari + '&sampai=' + sampai,
        headers: {
            "Authorization": 'Bearer ' + token
        },
        success: function(response) {
            var data = response.data;
            var row = '';
            data.forEach(function(val, index) {
                var totalQty = val.jumlah_dibeli * val.total_qty; // Perhitungan total qty
                row += '<tr>' +
                    '<td class="px-4 py-2">' + (index + 1) + '</td>' +
                    '<td class="px-4 py-2 break-all">' + val.nama_barang + '</td>' +
                    '<td class="px-4 py-2 break-all">' + rupiah(val.harga) + '</td>' +
                    '<td class="px-4 py-2 break-all">' + val.jumlah_dibeli + '</td>' +
                    '<td class="px-4 py-2 break-all">' + rupiah(val.pendapatan) + '</td>' +
                    '<td class="px-4 py-2 break-all">' + totalQty + '</td>' + // Menggunakan totalQty yang baru dihitung
                '</tr>';
            });
            $('#kategoriTableBody').html(row);
        }
    });
}
// Panggil fungsi untuk memasukkan data ke dalam tabel secara awal
fetchDataAndPopulateTable();
});
</script>

@endsection