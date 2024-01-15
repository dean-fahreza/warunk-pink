@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row">
        <h4>Order History</h4>
    </div>
    <div class="row py-2">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example" class="display" style="width:100%">
                        <thead>
                            <tr>
                                <th>ID Order</th>
                                <th>No Meja</th>
                                <th>Tanggal</th>
                                <th>Status</th>
                                <th>Pembayaran</th>
                                <th>Total</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($order as $order)
                            <tr>
                                <td>#{{ $order->id }}</td>
                                <td>{{ $order->meja }}</td>
                                <td>{{ Carbon\Carbon::parse($order->created_at)->format('j F Y') }}</td>
                                <td>{{ $order->status }}</td>
                                <td>{{ $order->jenis_pembayaran }}</td>
                                <td>Rp. {{ number_format($order->total,0,',','.') }}</td>
                                <td><button type="button" class="btn btn-outline-secondary" data-bs-toggle="modal"
                                        data-detail="{{ $order->detail }}" data-meja="{{ $order->meja }}" data-tanggal="{{ Carbon\Carbon::parse($order->tanggal)->format('j F Y') }}"
                                        data-jenispembayaran="{{ $order->jenis_pembayaran }}"
                                        data-total="Rp. {{ number_format($order->total,0,',','.') }}"
                                        data-bs-target="#staticBackdrop">
                                        Lihat
                                    </button>
                                </td>
                            </tr>

                            @endforeach
                            <!-- Modal -->
                            <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static"
                                data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header align-items-baseline">
                                            <h1 class="modal-title fs-5" id="meja">Modal title<br> <span id="tanggal">Tanggal</span></h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>

                                        </div>

                                        <div class="modal-body" id="listing">
                                        </div>
                                        <hr>
                                        <div class="d-flex justify-content-between px-3">
                                            <p>Jenis Pembayaran</p>
                                            <p id="jenis_pembayaran"></p>
                                        </div>
                                        <div class="d-flex justify-content-between px-3">
                                            <p>Total Harga</p>
                                            <p id="total"></p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
