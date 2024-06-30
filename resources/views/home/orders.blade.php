@extends('layout.home')

@section('content')
<div class="container relative">
    <div class="row">
        <div class="ecommerce col-xs-12">
            <div class="scroll-area">
                <h2>My Payments</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nama</th>
                            <th>Nominal</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($payments as $index => $payment)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $payment->created_at }}</td>
                                <td>{{ $payment->nama_member }}</td>
                                <td>Rp.{{ number_format($payment->total) }}</td>
                                <td>{{ $payment->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div class="scroll-area">
                <h2>My Orders</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal</th>
                            <th>Nominal</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $index => $order)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $order->created_at }}</td>
                                <td>Rp.{{ number_format($order->grand_total) }}</td>
                                <td>{{ $order->status }}</td>
                                <td>
                                    @if (!in_array($order->status, ['baru', 'dikomfirmasi', 'dikemas']))
                                        <form action="/pesanan_diterima" method="POST" class="form-diterima">
                                            @csrf
                                            <input type="hidden" name="id_order" value="{{ $order->id }}">
                                            <button type="submit" class="btn btn-success btn-diterima">Diterima</button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
