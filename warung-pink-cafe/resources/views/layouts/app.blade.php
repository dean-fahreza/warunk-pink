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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Or for RTL support -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.rtl.min.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.carousel.css') }}">
    <link rel="stylesheet" href="{{ asset('scripts/owlcaraousel/owl.theme.default.css') }}">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.css" />
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">

    <script src="https://code.jquery.com/jquery-2.2.4.js"
        integrity="sha256-iT6Q9iMJYuQiMWNd9lDyBUStIq/8PuOW33aOqmvFpqI=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
        integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.js"></script>
    <script src="{{ asset('scripts/owlcaraousel/owl.carousel.js') }}"></script>
</head>

<body>
    @include('sweetalert::alert')
    <div class="container mt-3">
        <nav class="navbar navbar-expand-lg bg-white">
            <div class="container-fluid">
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                        <li class="nav-item">
                            <button class="btn btn-secondary" type="button" data-bs-toggle="offcanvas"
                                data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i
                                    class="bi bi-three-dots"></i></button>
                        </li>
                    </ul>
                    <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item dropdown">

                                <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                                    aria-expanded="false">
                                    <img class="w-25 rounded-5"
                                        src="https://ui-avatars.com/api/?name={{ Auth::user()->name }}" alt=""
                                        srcset="">
                                    {{ Auth::user()->name }}
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf
                                            <a class="dropdown-item" href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                        this.closest('form').submit();">Logout</a>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
        <div class="offcanvas offcanvas-start" data-bs-scroll="true" data-bs-backdrop="false" tabindex="-1"
            id="offcanvasScrolling" aria-labelledby="offcanvasScrollingLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="offcanvasScrollingLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body">
                <div class="row px-4">
                    <div class="col-lg-12">
                        <div class="d-flex justify-content-center">
                            <img src="{{ asset('assets/admin/logo.png') }}" alt="" srcset="">
                        </div>
                    </div>
                    <div>
                        <h4 class="text-center">Warung Pink</h4>
                    </div>
                    <div class="row mt-3">
                        <a href="{{ route('dashboard') }}" class="btn text-white py-2 rounded-3 " style="background: #457695">Order List</a>
                        <a href="{{ route('history') }}" class="btn text-white py-2 rounded-3 my-2" style="background: #457695">Order History</a>
                        <a href="{{ route('menuadmin') }}" class="btn text-white py-2 rounded-3" style="background: #457695">Tambah Menu</a>
                        <a href="{{ route('daftarmenu') }}" class="btn text-white py-2 rounded-3 my-2" style="background: #457695">Menu List</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @yield('content')

    <script>
        $('.owl-carousel').owlCarousel({
            loop: true,
            margin: 300,
            autoHeight: true,
            nav: false,
            dots: false,
            responsive: {
                0: {
                    items: 1
                },
                600: {
                    items: 3
                },
                1000: {
                    items: 5
                }
            }
        })

        $( '#multiple-select-field' ).select2( {
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );
        $('.dt-select2').select2({
            theme: "bootstrap-5",
            width: $( this ).data( 'width' ) ? $( this ).data( 'width' ) : $( this ).hasClass( 'w-100' ) ? '100%' : 'style',
            placeholder: $( this ).data( 'placeholder' ),
            closeOnSelect: false,
        } );

        new DataTable('#example', {
            lengthMenu: [
                [10, 25, 50, -1],
                [10, 25, 50, 'All']
            ],
        });


        $("button[data-bs-target='#staticBackdrop']").on('click',function(){
            console.log("testtt")
            let listing = document.getElementById('listing');
            let detail = JSON.parse($(this).attr('data-detail'));
            console.log(detail)
            for(let i = 0; i < detail.length;i++){
                var ul = document.createElement("ul");
                ul.setAttribute('style','font-size: 14px;');
                listing.appendChild(ul);
                var l1 = document.createElement("li");
                l1.innerHTML = detail[i]['menu']['nama'] + "\t - " +  "Catatan : " + detail[i]['catatan'] + "\t - Rp. " + detail[i]['menu']['harga']
                ul.appendChild(l1);
            }
            $('#meja').html("Meja : " + $(this).attr('data-meja') + "<br>");
            span = document.createElement("span");
            span.innerHTML = "Tanggal : "+$(this).attr('data-tanggal')
            $('#meja').append(span)
            $('#jenis_pembayaran').html($(this).attr('data-jenispembayaran'));
            $('#total').html($(this).attr('data-total'));
        });


        // $("button[data-bs-target='#menuIndex']").on('click',function(){
        //     console.log($(this).attr('data-kategori'))
        //     console.log("awdawdwa");
        //     let kategori = JSON.parse($(this).attr('data-kategori'))
        //     let kategorifix = []
        //     for(let i = 0; i < kategori.length;i++){
        //         kategorifix.push(kategori[i]['kategori'])
        //     }
        //     $("#multiple-select-field1").val(kategorifix);
        //     $('#namaedit').val($(this).attr('data-nama'));
        //     $('#deskripsiedit').val($(this).attr('data-deskripsi'));
        //     $('#hargaedit').val($(this).attr('data-harga'));
        //     $('#menuidedit').val($(this).attr('data-menuid'));
        // });
    </script>
</body>

</html>
