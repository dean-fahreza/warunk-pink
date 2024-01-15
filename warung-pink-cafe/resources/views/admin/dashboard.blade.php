@extends('layouts.app')

@section('content')

<div class="container mt-4">
    <div class="row">
        <h4>Status</h4>
    </div>
    <div class="row">
        <div class="owl-carousel owl-theme">
            @forelse ($order as $list)
            <div class="item">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Order #{{ $list->id }}</h5>
                        <p class="card-text">Status : {{ $list->status }}</p>
                    </div>
                </div>
            </div>
            @empty
            <div class="item">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">Order Tidak Ada</h5>
                        <p class="card-text">Status : -</p>
                    </div>
                </div>
            </div>
            @endforelse
        </div>
    </div>
</div>

<div class="container mt-4">
    <div class="row">
        <h4>Order List</h4>
    </div>
    <div class="row">
        @forelse ($order->where('status','Process') as $data)
            <div class="col-sm-12 my-2 col-md-12 col-lg-6 col-xl-4">
                <div class="card" style="width: 25vwd">
                    <div class="card-body">
                        <div class="d-flex justify-content-between">
                            <div>
                                <h5 class="card-title">Order #{{ $data->id }}</h5>
                                <p class="text-secondary">{{ Carbon\Carbon::parse($data->created_at)->locale('id')->settings(['formatFunction' => 'translatedFormat'])->format('j F Y, h:i:s A') }}</p>
                            </div>
                            <div>
                                <p class="card-title">Table: {{ $data->meja }}</p>
                            </div>
                        </div>
                        <div class="row">
                            @foreach ($data->detail as $detail)
                            <div class="col-4">
                                <img class="w-100 h-auto" src="{{ asset('storage/photo/' . $detail->menu->gambar) }}" alt="" srcset="">
                            </div>
                            <div class="col-8">
                                <h5>{{ $detail->menu->nama }}</h5>
                                <input type="text" style="height: 50px;" class="form-control" value="{{ $detail->catatan }}" readonly>
                                <div class="d-flex justify-content-between">
                                    <div>
                                        <p>Rp. {{ number_format($detail->menu->harga,0,',','.') }}</p>
                                    </div>
                                    <div>
                                        <p>Qty: {{ $detail->jumlah }}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                            <hr>
                            <div class="row">
                                <div class="col-6">
                                    <p>Total:<br>Rp. {{ number_format($data->total,0,',','.') }}</p>
                                </div>
                                <div class="col-6">
                                    <div class="d-flex justify-content-end">
                                        <form action="{{ route('order.update',$data->id) }}" method="post">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="status" value="Completed">
                                            <button type="submit" class="btn btn-warning"><i
                                                class="bi bi-check-lg"></i></button>
                                        </form>
                                        <form action="{{ route('order.update',$data->id) }}" method="post">
                                            @csrf
                                            @method("PUT")
                                            <input type="hidden" name="status" value="Uncompleted">
                                            <button type="submit" class="btn btn-danger mx-2"><i
                                                class="bi bi-x"></i></button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-sm-12 my-2 col-md-12 col-lg-6 col-xl-4">
                <div class="card" style="width: 25vwd">
                    <div class="card-body">
                        <h5>Tidak Ada</h5>
                    </div>
                </div>
            </div>
        @endforelse
    </div>
</div>
@endsection
