@extends('layout.app')

@section('title', 'Data Pesanan Dikemas')

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
      Data Pesanan Dikemas
  </h1>
  <div id="recipients" class="p-8 mt-3 lg:mt-1 rounded shadow bg-white overflow-x-auto">
      <table id="example" class="stripe hover" style="width:100%;">
          <thead>
              <tr>
                  <th class="px-4 py-2 w-16">No</th>
                  <th class="px-4 py-2 w-48">Tanggal Pesanan</th>
                  <th class="px-4 py-2 w-48">Invoice</th>
                  <th class="px-4 py-2 w-32">Member</th>
                  <th class="px-4 py-2 w-24">Total</th>
                  <th class="px-4 py-2 w-32">Aksi</th>
              </tr>
          </thead>
          <tbody id="kategoriTableBody">
              <!-- Data dari API akan dimasukkan di sini -->
              <tr id="loadingRow">
                  <td colspan="6" class="text-center">Memuat data...</td>
              </tr>
          </tbody>
      </table>
  </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
$(document).ready(function() {
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

    function fetchDataAndPopulateTable() {
        const token = localStorage.getItem('token');
        console.log("Token:", token); // Log untuk melihat token
        $.ajax({
            url: '/api/pesanan/dikemas',
            headers: {
                "Authorization": 'Bearer ' + token
            },
            success: function(response) {
                console.log("API Response:", response); // Tambahkan log untuk melihat respons API
                var data = response.data;
                if (!data || data.length === 0) {
                    console.log("Data is empty"); // Log jika data kosong
                    $('#kategoriTableBody').html('<tr><td colspan="6" class="text-center">Tidak ada data yang tersedia.</td></tr>');
                } else {
                    var row = '';
                    data.forEach(function(val, index) {
                        row += '<tr>' +
                            '<td class="px-4 py-2 w-16">' + (index + 1) + '</td>' +
                            '<td class="px-4 py-2 w-48 break-all">' + formatDate(val.created_at) + '</td>' +
                            '<td class="px-4 py-2 w-48 break-all">' + val.invoice + '</td>' +
                            '<td class="px-4 py-2 w-32 break-all">' + (val.member ? val.member.nama_member : 'Tidak ada data anggota') + '</td>' +
                            '<td class="px-4 py-2 w-24 break-all">' + rupiah(val.grand_total) + '</td>' +
                            '<td class="px-4 py-2 w-32 flex items-center gap-2">' +
                            '<button data-id="' + val.id + '" class="bg-green-500 hover:bg-green-600 text-white font-bold py-1 px-1 rounded btn-aksi">Kirim</button>' +
                            '</td>' +
                            '</tr>';
                    });

                    $('#kategoriTableBody').html(row);
                }
            },
            error: function(xhr, status, error) {
                console.error("API Error:", status, error); // Tambahkan log untuk melihat jika terjadi error pada API
            }
        });
    }

    // Panggil fetchDataAndPopulateTable() saat dokumen siap
    fetchDataAndPopulateTable();

    // Tambahkan event listener untuk tombol konfirmasi
    $(document).on('click', '.btn-aksi', function() {
        const id = $(this).data('id');
        const token = localStorage.getItem('token');
        console.log("Confirming ID:", id); // Log untuk melihat ID yang dikonfirmasi
        $.ajax({
            url : '/api/pesanan/ubah_status/' + id,
            type : 'POST',
            data : {
                status : 'Dikirim'
            },
            headers: {
                "Authorization": 'Bearer ' + token
            },
            success : function(data){
                console.log("Status updated for ID:", id); // Tambahkan log untuk melihat ID yang berhasil diupdate
                // Perbarui tabel setelah berhasil mengonfirmasi
                fetchDataAndPopulateTable();
            },
            error: function(xhr, status, error) {
                console.error("Update Status Error:", status, error); // Tambahkan log untuk melihat jika terjadi error pada update status
            }
        });
    });
});

</script>

@endsection
