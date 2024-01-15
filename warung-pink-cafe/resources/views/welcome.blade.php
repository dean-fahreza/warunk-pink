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

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.theme.default.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>

<body>
    @include('sweetalert::alert')
    @include('components.splashscreen')
    <section style="background-color: white; height: 100vh;">
        <div style="min-height: 100vhd" class="overflow-x-hidden">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-sm-8 col-md-6 col-lg-6 col-xl-4">
                    <div>
                        <a class="cart-point text-decoration-none text-black fs-4" style="position: absolute;" href="{{ route('cart') }}"><i class="bi bi-cart"></i></a>
                        <img class="w-100 h-auto" src="{{ asset('assets/user/banner.png') }}" alt="" srcset="">
                    </div>
                    <div class="py-2 px-3" style="background: #FF4B91; min-height:80vh">
                        <form action="{{ route('search') }}" method="get">
                            <div class="input-group px-2 my-2">
                                <input name="search" class="form-control border-end-0 rounded-2 border" type="search"
                                    placeholder="Cari Menu Makanan" id="example-search-input">
                                <span class="input-group-append">
                                    <button
                                        class="btn btn-outline-secondary bg-white border-start-0 border-bottom-0 border rounded-1 ms-n5"
                                        type="button">
                                        <i class="bi bi-search"></i>
                                    </button>
                                </span>
                            </div>
                        </form>
                        <div class="row d-flex justify-content-center mt-4">
                            <a href="{{ route('category') }}?kategori=Paketan" class="btn"
                                style="background: white; width: 20%; font-size:14px;">
                                <img class="w-100 h-auto py-1"
                                    src="{{ asset('assets/user/fluent_food-16-filled.png') }}" alt="">
                                Paketan
                            </a>
                            <a href="{{ route('category') }}?kategori=Nasi" class="btn ms-2"
                                style="background: white; width: 20%">
                                <img class="w-100 h-auto py-1" src="{{ asset('assets/user/bxs_bowl-rice.png') }}"
                                    alt="">
                                Nasi
                            </a>
                            <a href="{{ route('category') }}?kategori=Mie" class="btn ms-2"
                                style="background: white; width: 20%">
                                <img class="w-100 h-auto py-1" src="{{ asset('assets/user/game-icons_noodles.png') }}"
                                    alt="">
                                Mie
                            </a>
                            <a href="{{ route('category') }}?kategori=Snack" class="btn ms-2"
                                style="background: white; width: 20%">
                                <img class="w-100 h-auto py-1"
                                    src="{{ asset('assets/user/streamline_food-popcorn-cook-corn-movie-snack-cooking-nutrition-bake.png') }}"
                                    alt="">
                                Snack
                            </a>
                            <a href="{{ route('category') }}?kategori=Kopi" class="btn mt-3"
                                style="background: white; width: 20%">
                                <img class="w-100 h-auto py-1" src="{{ asset('assets/user/Frame 21109.png') }}" alt="">
                                Kopi
                            </a>
                            <a href="{{ route('category') }}?kategori=Teh" class="btn mt-3 ms-2"
                                style="background: white; width: 20%">
                                <img class="w-100 h-auto py-1 mt-3" src="{{ asset('assets/user/Frame 21108.png') }}"
                                    alt="">
                                Teh
                            </a>
                            <a href="{{ route('category') }}?kategori=Soft Drink" class="btn mt-3 ms-2"
                                style="background: white; width: 20%">
                                <img class="w-100 h-auto py-1"
                                    src="{{ asset('assets/user/pepicons-pop_soft-drink.png') }}" alt="">
                                Soft Drink
                            </a>
                            <a href="{{ route('category') }}?kategori=Juice" class="btn mt-3 ms-2"
                                style="background: white; width: 20%">
                                <img class="w-100 h-auto py-1"
                                    src="{{ asset('assets/user/icon-park-outline_juice.png') }}" alt="">
                                Juice
                            </a>
                        </div>
                        <div class="row px-4 my-4">
                            @forelse ($menu as $menu)
                            <div class="card mb-3 py-2" style="width: 100%">
                                @csrf
                                <div class="d-flex">
                                    <div style="width: 30%" class="me-2">
                                        <button class="btn mt-1" data-bs-toggle="modal"
                                        data-gambar="{{ asset('storage/photo/'.$menu->gambar) }}" data-harga="Rp. {{ number_format($menu->harga,0,',','.') }}" data-nama="{{ $menu->nama }}" data-deskripsi="{{ $menu->deskripsi }}" data-menuid="{{ $menu->id }}"  data-bs-target="#cardDetail"><img
                                        class="w-100" style="height: 80px;" src="{{ asset('storage/photo/'. $menu->gambar) }}"
                                        alt="" srcset=""></button>
                                    </div>
                                    <div style="width: 70%">
                                        <form action="{{ route('addcart') }}" method="post">
                                            @csrf
                                            <h5>{{ $menu->nama }}</h5>
                                            <p>Rp. {{ number_format($menu->harga,0,',','.') }} </p>
                                            <input type="hidden" name="menu_id" value="{{ $menu->id }}">
                                            <input type="hidden" name="jumlah" value="1">
                                            @if($menu->tersedia)
                                                <button class="btn btn-secondary w-100" type="submit">Tambah</button>
                                            @else
                                                <h6 class="text-danger fw-bold">Persediaan Habis</h6>
                                            @endif
                                        </form>
                                    </div>
                                </div>
                            </div>
                            @empty

                            @endforelse
                        </div>
                        <div class="modal fade" id="cardDetail" tabindex="-1" aria-labelledby="exampleModalLabel"
                            aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="card text-white" style="width: 100%; background:#FF4B91;">
                                        <img style="height: 300px; object-fit:cover;" id="gambarmodal" src="{{ asset('assets/admin/background.png') }}" class="card-img-top bg-white" alt="...">
                                        <div class="card-body">
                                            <form action="{{ route('addcart') }}" method="post">
                                                @csrf
                                                <input type="hidden" name="jumlah" value="1">
                                                <div class="d-flex justify-content-between">
                                                    <h5 id="namamodal">Card title</h5>
                                                    <h5 id="hargamodal">Card title</h5>
                                                </div>
                                                <input id="menuidmodal" type="hidden" name="menu_id">
                                                <p id="deskripsimodal" class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                                <button type="submit" class="btn btn-primary w-100">Pesan</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
    <script>
        $("button[data-bs-target='#cardDetail']").on('click',function(){
            $('#gambarmodal').attr('src',$(this).attr('data-gambar'))
            $('#namamodal').html($(this).attr('data-nama'))
            $('#hargamodal').html($(this).attr('data-harga'))
            $('#deskripsimodal').html($(this).attr('data-deskripsi'))
            $('#menuidmodal').val($(this).attr('data-menuid'))
        })
   </script>
</body>

</html>
