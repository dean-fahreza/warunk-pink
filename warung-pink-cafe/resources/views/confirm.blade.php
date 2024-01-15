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
                    <form action="{{ route('transaksi') }}" method="post">
                        @csrf
                        <div class="py-2 px-3" style="background: #FF4B91; min-height:90vh">
                            <a class="text-white fs-4 px-2 fw-medium" href="{{ route('home') }}" style="text-decoration:none"><i class="bi bi-arrow-left"></i>&nbsp;&nbsp;  Keranjang</a>
                            <div class="row mt-5 px-2">
                                <div style="min-height: 80vh">
                                    <div class="d-flex justify-content-between text-white">
                                        <p class="text-left fw-medium">Rangkuman Pesanan</p>
                                        <p class="text-right fw-medium">Harga Pesanan</p>
                                    </div>
                                    <hr class="text-white mt-0">
                                    @php
                                        $total = 0
                                    @endphp
                                    @foreach ($cart as $cart)
                                    @php
                                        $total = $total + ($cart->price * $cart->quantity)
                                    @endphp
                                    <div class="d-flex justify-content-between my-2">
                                        <div class="d-flex">
                                            <div class="px-2 bg-white text-black align-item" style="width: 25px; height:25px;">
                                                {{ $loop->iteration }}
                                            </div>
                                            <span style="font-size: 14px" class="text-white ms-2">{{ $cart->name }} - {{ $cart->quantity }} Item</span>
                                        </div>
                                        <div>
                                            <span class="text-white" style="text-align: right;">Rp. {{ number_format($cart->price*$cart->quantity,0,',','.') }}</span>
                                        </div>
                                    </div>
                                    @endforeach
                                    <div class="mb-3 mt-4">
                                        <label for="exampleFormControlInput1" class="form-label text-white">No. Meja</label>
                                        <input name="meja" type="number" class="form-control" placeholder="cth: 1" min="0">
                                    </div>
                                    <div class="mb-3 mt-4">
                                        <label class="form-label text-white">Metode Pembayaran</label>
                                        <select class="form-control" name="metode" id="metodepembayaran">
                                            <option disabled selected>Pilih Metode Pembayaran</option>
                                            <option value="Tunai">Tunai</option>
                                            <option value="Transfer">Transfer</option>
                                        </select>
                                    </div>
                                    <div class="mb-3 mt-4" id="panduan">
                                        <label class="form-label text-white">Panduan Pembayaran</label>
                                        <div class="bg-white pb-0 pt-3 px-2 rounded-2 text-black">
                                            <div class="d-flex justify-content-between">
                                                <div>
                                                    Mandiri Virtual Account
                                                </div>
                                                <div>
                                                    <img src="{{ asset('assets/user/bank.png') }}" alt="" srcset="">
                                                </div>
                                            </div>
                                            <div class="mt-2 mb-4">
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <label for="" class="text-secondary">Nomor Virtual Account</label>
                                                        <p id="nomorva" class="fw-medium">8870883147797809</p>
                                                    </div>
                                                    <div>
                                                        <button class="btn fw-medium" onclick="copycopy(8870883147797809)" text-black fw-medium">Salin <i class="bi bi-copy fw-medium"></i></button>
                                                    </div>
                                                </div>
                                                <div class="d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <label for="" class="text-secondary">Total Pembayaran</label>
                                                        <p id="harga" class="fw-medium">Rp. {{ number_format($total,0,',','.') }}</p>
                                                    </div>
                                                    <div>
                                                        <button class="btn text-black fw-medium" onclick="copycopy('{{ $total }}')">Salin <i class="bi bi-copy fw-medium"></i></button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mb-3 mt-4" id="panduan-tunai">
                                        <label class="form-label text-white">Panduan Pembayaran</label>
                                        <div class="bg-white pb-4 pt-3 px-2  rounded-2 text-black">
                                            <div>
                                                Silahkan Lakukan Pembayaran Ke Kasir Dan Tunjukkan Transaksi Ordernya
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="screen-bottom bg-white mr-0 px-3 py-2" height:100px; ">
                            <div class="d-flex justify-content-between">
                                <p class="fw-medium">Total Harga</p>
                                <p class="fw-medium">Rp. {{ number_format($total,0,',','.') }}</p>
                                <input type="hidden" name="total" value="{{ $total }}">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Pesan</button>
                        </div>
                    </form>
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
    <script>
        $('#panduan').hide();
        $('#panduan-tunai').hide();

        $('#metodepembayaran').on('change', function () {
            if(this.value == 'Transfer'){
                $('#panduan').show()
                $('#panduan-tunai').hide();
            }else {
                $('#panduan').hide()
                $('#panduan-tunai').show();
            }
            //ways to retrieve selected option and text outside handler
            console.log('Changed option value ' + this.value);
            console.log('Changed option text ' + $(this).find('option').filter(':selected').text());
        });

        function copycopy(nomorva) {
            navigator.clipboard.writeText(nomorva);
        }
    </script>
</body>

</html>
