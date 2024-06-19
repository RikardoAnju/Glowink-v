@extends('layout.app')

@section('title', 'Data Pesanan Baru')

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

<div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2">
  <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
      Data Pesanan Baru
  </h1>
  <div id="recipients" class="p-8 mt-3 lg:mt-1 rounded shadow bg-white overflow-x-auto">
      <table id="example" class="stripe hover" style="width:100%;">
          <thead>
              <tr>
                  <th class="px-4 py-2 w-16">No</th>
                  <th class="px-4 py-2 w-48">Tanggal Pesanan</th>
                  <th class="px-4 py-2 w-48">Invoice</th>
                  <th class="px-4 py-2 w-32">Member</th>
                  <th class="px-4 py-2 w-32">Nama Barang</th>
                  <th class="px-4 py-2 w-24">Total</th>
                  <th class="px-4 py-2 w-32">Aksi</th>
              </tr>
          </thead>
          <tbody id="kategoriTableBody">
              <!-- Data dari API akan dimasukkan di sini -->
          </tbody>
      </table>
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
  
        function rupiah(angka){
          const format = angka.toString().split('').reverse().join('');
          const convert = format.match(/\d{1,3}/g);
          return 'Rp' + convert.join('.').split('').reverse().join('');
        }
  
        function formatDate(date) {
          var dateObj = new Date(date);
          var day = dateObj.getDate();
          var month = dateObj.getMonth() + 1; // January is 0!
          var year = dateObj.getFullYear();
          return year + "-" + (month < 10 ? "0" + month : month) + "-" + (day < 10 ? "0" + day : day);
        }
  
          const token = localStorage.getItem('token');
          $.ajax({
              url: '/api/pesanan/baru',
              headers: {
                  "Authorization": 'Bearer ' + token
              },
              success: function(response) {
                  var data = response.data;
                  var row = '';
                  data.forEach(function(val, index) {
                      var namaBarang = val.nama_barang ? val.nama_barang : '';
                      row += '<tr>' +
                          '<td class="px-4 py-2 w-16">' + (index + 1) + '</td>' +
                          '<td class="px-4 py-2 w-48 break-all">' + formatDate(val.created_at) + '</td>' +
                          '<td class="px-4 py-2 w-48 break-all">' + val.invoice + '</td>' +
                          '<td class="px-4 py-2 w-32 break-all">' + (val.member ? val.member.nama_member : '') + '</td>' +
                          '<td class="px-4 py-2 w-32 break-all">' + namaBarang + '</td>' +
                          '<td class="px-4 py-2 w-24 break-all">' + rupiah(val.grand_total) + '</td>' +
                          '<td class="px-4 py-2 w-32 flex items-center gap-2">' +
                          '<button data-id="' + val.id + '" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-1 rounded btn-aksi">Konfirmasi</button>' +
                          '</td>' +
                          '</tr>';
                  });
  
                  $('#kategoriTableBody').html(row);

                  // Memindahkan inisialisasi event click ke sini agar bisa menggunakan variabel token
                  $(document).on( 'click', '.btn-aksi' ,function() {
                    const id = $(this).data('id')

                    $.ajax({
                      url : '/api/pesanan/ubah_status/' + id,
                      type : 'POST',
                      data : {
                        status : 'Dikonfirmasi'
                      },
                      headers: {
                        "Authorization": 'Bearer ' + token // Menambahkan spasi setelah 'Bearer'
                      },
                      success : function(data){
                        location.reload();
                      }
                    })
                  })
              }
          });
      }
  
      // Panggil fungsi untuk memasukkan data ke dalam tabel secara awal
      fetchDataAndPopulateTable();
  });
  
</script>

@endsection
