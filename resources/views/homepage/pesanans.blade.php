@extends('layout.homepage')

@section ('title', 'Orders')

@section('Content')
<!-- Checkout -->
<section class="section-wrap checkout pb-70">
    <div class="container relative">
        <div class="row">

            <div class="ecommerce col-xs-12">
                <h2>My Payments</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Nominal Transfer</th>
                        <th>Status</th>
                    </thead>
                    <tbody>
                        @foreach ($pembayarans as $index => $pembayaran)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$pembayaran->created_at}}</td>
                            <td>Rp. {{number_format($pembayaran->jumlah)}}</td>
                            <td>{{$pembayaran->status}}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                <h2>My Orders</h2>
                <table class="table table-ordered table-hover table-striped">
                    <thead>
                        <th>No</th>
                        <th>Tanggal</th>
                        <th>Grand Total</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </thead>
                    <tbody>
                        @foreach ($pesanans as $index => $pesanan)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$pesanan->created_at}}</td>
                            <td>Rp. {{number_format($pesanan->grand_total)}}</td>
                            <td>{{$pesanan->status}}</td>
                            <td>
                                <form action="/pesanan_selesai/{{$pesanan->id}}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">SELESAI</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

            </div> <!-- end ecommerce -->

        </div> <!-- end row -->
    </div> <!-- end container -->
</section> <!-- end checkout -->
@endsection