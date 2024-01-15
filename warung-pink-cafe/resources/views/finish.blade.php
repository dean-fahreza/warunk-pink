<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Warung Pink Cafe</title>
    <link rel="shortcut icon" href="{{ asset('assets/admin/logo.png') }}" type="image/x-icon">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.theme.default.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('sweetalert::alert')
    <section style="background-color: white; height: 100vh;" >
        <div style="min-height: 100vhd" class="overflow-x-hidden">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4">
                    <div class="py-2 px-3" style="background: #FF4B91; min-height:100vh">
                        <div class="row d-flex justify-content-center pt-5">
                            <img style="width: 200px" class="h-auto" src="{{ asset('assets/admin/logo.png') }}" alt="" srcset="">
                            <h2 class="text-white fw-bold text-center" style="font-size:64px">Yeay!</h2>
                            <h4 class="text-center fw-bold text-black">Thank You<br>For Your Order</h4>
                            <p class="text-center text-black mt-2">
                                Your order #{{ $order->id }} has been succesfully registered.<br>
                                Please check all orders to make sure they are correct!
                            </p>
                            <h5 class="mt-2 text-center fw-bold text-white">
                                See Detail
                            </h5>
                        </div>
                        <h5 class="px-2 text-black">Meja: {{ $order->meja }}</h5>
                        <div style="min-height: 30vh">
                        @foreach ($order->detail as $data)

                        <div class="d-flex justify-content-between my-3 px-2">
                            <div class="d-flex">
                                <div class="px-2 bg-white text-black align-item" style="width: 25px; height: 25px;">
                                    {{ $loop->iteration }}
                                </div>
                                <span class="text-white ms-2">{{ $data->menu->nama }}</span>
                            </div>
                            <div>
                                <span class="text-white">Rp. {{ number_format($data->menu->harga,0,',','.') }}</span>
                            </div>
                        </div>
                        @endforeach
                        </div>
                        <hr class="text-white border-2">
                        <div class="d-flex px-2 my-2 text-white justify-content-between">
                            <p class="fw-bold">Total Harga</p>
                            <p class="fw-bold">Rp. {{ number_format($order->total,0,',','.') }}</p>
                        </div>
                        <div class="px-2 my-2">
                            <a href="{{ route('home') }}" class="btn btn-primary w-100">Kembali Memesan</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>

</body>

</html>
