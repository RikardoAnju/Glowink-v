@extends('layout.app')

@section('title', 'Data Pesanan')

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

    .dropdown-container {
        position: relative;
        display: inline-block;
    }

    .dropdown-toggle {
        background-color: #3490dc;
        color: white;
        padding: 8px 12px;
        border: none;
        cursor: pointer;
        border-radius: 4px;
        transition: background-color 0.3s;
        width: 100px; /* Tetapkan lebar tetap */
        text-align: center;
    }

    .dropdown-toggle:hover {
        background-color: #2779bd;
    }

    .dropdown-content {
        position: absolute;
        background-color: #ffffff;
        min-width: 160px;
        box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
        z-index: 1;
        display: none;
        border: 1px solid #ccc;
        border-radius: 4px;
        overflow: hidden;
        top: 100%; /* Letakkan di bawah tombol */
        left: 0; /* Jaga agar dropdown berada di dalam kontainer */
    }

    .dropdown-content form {
        margin: 0;
    }

    .dropdown-content a {
        color: black;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        transition: background-color 0.3s;
    }

    .dropdown-content a:hover {
        background-color: #f9f9f9;
    }

    .dropdown-container:hover .dropdown-content {
        display: block;
    }
</style>

<div class="container w-full md:w-4/5 xl:w-3/5 mx-auto px-2">
    <h1 class="flex items-center font-sans font-bold break-normal text-indigo-500 px-2 py-8 text-xl md:text-2xl">
        Data Pesanan
</h1>
   <!-- Form pencarian --> 
    <form action="{{ route('orders.index') }}" method="GET" class="mb-4">
      <div class="flex items-center border-b border-b-2 border-gray-500 py-2">
          <input type="text" name="keyword" value="{{ $keyword ?? '' }}" placeholder="Cari berdasarkan nama barang, status, atau invoice" class="appearance-none bg-transparent border-none w-full text-gray-700 mr-3 py-1 px-2 leading-tight focus:outline-none">
          <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">Cari</button>
      </div>
    </form>
   <!-- Tabel data -->
    <div id="recipients" class="p-8 mt-3 lg:mt-1 rounded shadow bg-white overflow-hidden">
        <table id="example" class="stripe hover" style="width:100%;">
            <thead>
                <tr>
                    <th class="px-4 py-2 w-16">No</th>
                    <th class="px-4 py-2 w-48">Tanggal Pesanan</th>
                    <th class="px-4 py-2 w-48">Invoice</th>
                    <th class="px-4 py-2 w-32">Member</th>
                    <th class="px-4 py-2 w-32">Nama Barang</th>
                    <th class="px-4 py-2 w-24">Total</th>
                    <th class="px-4 py-2 w-32">Status</th>
                    <th class="px-4 py-2 w-32">Aksi</th>
                </tr>
            </thead>
            <tbody id="kategoriTableBody">
                @foreach($orders as $index => $order)
                <tr>
                    <td class="px-4 py-2 w-16">{{ $index + 1 }}</td>
                    <td class="px-4 py-2 w-48">{{ $order->created_at }}</td>
                    <td class="px-4 py-2 w-48">{{ $order->invoice }}</td>
                    <td class="px-4 py-2 w-32">{{ $order->member->nama_member ?? '' }}</td>
                    <td class="px-4 py-2 w-32">{{ $order->nama_barang ?? '' }}</td>
                    <td class="px-4 py-2 w-24">{{ number_format($order->grand_total, 0, ',', '.') }}</td>
                    <td class="px-4 py-2 w-32">{{ $order->status }}</td>
                    <td class="px-4 py-2 w-32">
                        <div class="dropdown-container">
                            <button class="dropdown-toggle">Update</button>
                            <div class="dropdown-content">
                                <form action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <select name="status" class="form-select block w-full focus:outline-none focus:ring-0 focus:border-gray-300">
                                        <option value="Dikonfirmasi" {{ $order->status == 'Dikonfirmasi' ? 'selected' : '' }}>Dikonfirmasi</option>
                                        <option value="Dikemas" {{ $order->status == 'Dikemas' ? 'selected' : '' }}>Dikemas</option>
                                        <option value="Dikirim" {{ $order->status == 'Dikirim' ? 'selected' : '' }}>Dikirim</option>
                                       
                                    
                                    </select>
                                    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-1 px-2 rounded mt-1">Simpan</button>
                                </form>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>

<script>
    $(document).ready(function() {
        $('#example').DataTable({
            responsive: true,
            paging: false,
            searching: false,
            language: {
                emptyTable: "Tidak ada data yang tersedia dalam tabel",
                zeroRecords: "Tidak ada data yang cocok dengan pencarian",
            },
            info: false,
            ordering: false
        });
        
    });
</script>

@endsection
