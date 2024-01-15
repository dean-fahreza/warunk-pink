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
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.theme.default.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('sweetalert::alert')
    <section style="background-color: white; height: 100vh;">
        <div style="min-height: 100vhd" class="overflow-x-hidden">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4">
                    <div class="py-2 px-3" style="background: #FF4B91; min-heigh:100vh">
                        <a class="text-white fs-4 px-2 fw-medium" href="{{ route('home') }}"
                            style="text-decoration:none"><i class="bi bi-arrow-left"></i>&nbsp;&nbsp;
                            {{ Request('search') }} {{ Request('kategori') }}</a>
                        <p class="text-white px-2 fs-5 fw-medium mt-5">Menu Dengan
                            {{ Request('search') ? 'Kata ' . Request('search') : '' }}{{ Request('kategori') ? 'Katagori ' . Request('kategori') : '' }}
                        </p>
                        <div class="row px-4 my-4">
                            @if(Request('search'))
                            @forelse ($menu as $data)
                            <div class="card mb-3 py-2" style="width: 100%">
                                <div class="d-flex">
                                    <div style="width: 30%" class="me-2">
                                        <button class="btn mt-1" data-bs-toggle="modal"
                                            data-gambar="{{ asset('storage/photo/'.$data->gambar) }}"
                                            data-harga="Rp. {{ number_format($data->harga,0,',','.') }}"
                                            data-nama="{{ $data->nama }}" data-deskripsi="{{ $data->deskripsi }}"
                                            data-menuid="{{ $data->id }}" data-bs-target="#cardDetail"><img
                                                class="w-100" style="height: 80px;"
                                                src="{{ asset('storage/photo/'. $data->gambar) }}" alt=""
                                                srcset=""></button>
                                    </div>
                                    <div style="width: 70%">
                                        <form action="{{ route('addcart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $data->id }}">
                                            <input type="hidden" name="jumlah" value="1">
                                            <h5>{{ $data->nama }}</h5>
                                            <p>Rp. {{ number_format($data->harga,0,',','.') }} </p>
                                            @if($data->tersedia)
                                            <button class="btn btn-secondary w-100" type="submit">Tambah</button>
                                            @else
                                            <h6 class="text-danger fw-bold">Persediaan Habis</h6>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card mb-3 py-2" style="width: 100%">
                                <div class="d-flex">
                                    <div style="width: 30%" class="me-2">
                                        <img class="w-100 h-auto" src="{{ asset('assets/admin/logo.png') }}" alt=""
                                            srcset="">
                                    </div>
                                    <div style="width: 70%">
                                        <h5>Tidak Ada</h5>
                                        <p>Rp. - </p>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                            @elseif(Request('kategori'))
                            @forelse ($menu as $data)
                            <div class="card mb-3 py-2" style="width: 100%">
                                <div class="d-flex">
                                    <div style="width: 30%" class="me-2">
                                        <button class="btn mt-1" data-bs-toggle="modal"
                                            data-gambar="{{ asset('storage/photo/'.$data->menu->gambar) }}"
                                            data-harga="Rp. {{ number_format($data->menu->harga,0,',','.') }}"
                                            data-nama="{{ $data->menu->nama }}"
                                            data-deskripsi="{{ $data->menu->deskripsi }}"
                                            data-menuid="{{ $data->menu->id }}" data-bs-target="#cardDetail"><img
                                                class="w-100" style="height: 80px;"
                                                src="{{ asset('storage/photo/'. $data->menu->gambar) }}" alt=""
                                                srcset=""></button>
                                    </div>
                                    <div style="width: 70%">
                                        <form action="{{ route('addcart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $data->menu->id }}">
                                            <input type="hidden" name="jumlah" value="1">
                                            <h5>{{ $data->menu->nama }}</h5>
                                            <p>Rp. {{ number_format($data->menu->harga,0,',','.') }} </p>
                                            @if($data->menu->tersedia)
                                            <button class="btn btn-secondary w-100" type="submit">Tambah</button>
                                            @else
                                            <h6 class="text-danger fw-bold">Persediaan Habis</h6>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card mb-3 py-2" style="width: 100%">
                                <div class="d-flex">
                                    <div style="width: 30%" class="me-2">
                                        <img class="w-100 h-auto" src="{{ asset('assets/admin/logo.png') }}" alt=""
                                            srcset="">
                                    </div>
                                    <div style="width: 70%">
                                        <h5>Tidak Ada</h5>
                                        <p>Rp. - </p>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                            @endif
                            <div class="modal fade" id="cardDetail" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="card text-white" style="width: 100%; background:#FF4B91;">
                                            <img style="height: 300px; object-fit:cover;" id="gambarmodal"
                                                src="{{ asset('assets/admin/background.png') }}"
                                                class="card-img-top bg-white" alt="...">
                                            <div class="card-body">
                                                <form action="{{ route('addcart') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="jumlah" value="1">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 id="namamodal">Card title</h5>
                                                        <h5 id="hargamodal">Card title</h5>
                                                    </div>
                                                    <input id="menuidmodal" type="hidden" name="menu_id">
                                                    <p id="deskripsimodal" class="card-text">Some quick example text to
                                                        build on the card title and make up the bulk of the card's
                                                        content.</p>
                                                    <button type="submit" class="btn btn-primary w-100">Pesan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @if(Request('kategori') && !$sandingan->isEmpty())
                        <p class="text-white px-2 fs-5 fw-medium mt-5">Menu Dengan Sandingan
                        </p>
                        <div class="row px-4 my-4">
                            @forelse ($sandingan as $datas)
                            <div class="card mb-3 py-2" style="width: 100%">
                                <div class="d-flex">
                                    <div style="width: 30%" class="me-2">
                                        <button class="btn mt-1" data-bs-toggle="modal"
                                            data-gambar="{{ asset('storage/photo/'.$datas->menu->gambar) }}"
                                            data-harga="Rp. {{ number_format($datas->menu->harga,0,',','.') }}"
                                            data-nama="{{ $datas->menu->nama }}"
                                            data-deskripsi="{{ $datas->menu->deskripsi }}"
                                            data-menuid="{{ $datas->menu->id }}" data-bs-target="#cardDetail"><img
                                                class="w-100" style="height: 80px;"
                                                src="{{ asset('storage/photo/'. $datas->menu->gambar) }}" alt=""
                                                srcset=""></button>
                                    </div>
                                    <div style="width: 70%">
                                        <form action="{{ route('addcart') }}" method="post">
                                            @csrf
                                            <input type="hidden" name="menu_id" value="{{ $datas->menu->id }}">
                                            <input type="hidden" name="jumlah" value="1">
                                            <h5>{{ $datas->menu->nama }}</h5>
                                            <p>Rp. {{ number_format($datas->menu->harga,0,',','.') }} </p>
                                            @if($datas->menu->tersedia)
                                            <button class="btn btn-secondary w-100" type="submit">Tambah</button>
                                            @else
                                            <h6 class="text-danger fw-bold">Persediaan Habis</h6>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card mb-3 py-2" style="width: 100%">
                                <div class="d-flex">
                                    <div style="width: 30%" class="me-2">
                                        <img class="w-100 h-auto" src="{{ asset('assets/admin/logo.png') }}" alt=""
                                            srcset="">
                                    </div>
                                    <div style="width: 70%">
                                        <h5>Tidak Ada</h5>
                                        <p>Rp. - </p>
                                    </div>
                                </div>
                            </div>
                            @endforelse
                            <div class="modal fade" id="cardDetail" tabindex="-1" aria-labelledby="exampleModalLabel"
                                aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="card text-white" style="width: 100%; background:#FF4B91;">
                                            <img style="height: 300px; object-fit:cover;" id="gambarmodal"
                                                src="{{ asset('assets/admin/background.png') }}"
                                                class="card-img-top bg-white" alt="...">
                                            <div class="card-body">
                                                <form action="{{ route('addcart') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="jumlah" value="1">
                                                    <div class="d-flex justify-content-between">
                                                        <h5 id="namamodal">Card title</h5>
                                                        <h5 id="hargamodal">Card title</h5>
                                                    </div>
                                                    <input id="menuidmodal" type="hidden" name="menu_id">
                                                    <p id="deskripsimodal" class="card-text">Some quick example text to
                                                        build on the card title and make up the bulk of the card's
                                                        content.</p>
                                                    <button type="submit" class="btn btn-primary w-100">Pesan</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
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
    <script>
        $("button[data-bs-target='#cardDetail']").on('click', function () {
            $('#gambarmodal').attr('src', $(this).attr('data-gambar'))
            $('#namamodal').html($(this).attr('data-nama'))
            $('#hargamodal').html($(this).attr('data-harga'))
            $('#deskripsimodal').html($(this).attr('data-deskripsi'))
            $('#menuidmodal').val($(this).attr('data-menuid'))
        })

    </script>
</body>

</html>
