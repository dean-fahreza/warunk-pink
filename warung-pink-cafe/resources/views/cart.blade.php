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
                    <div class="py-2 px-3" style="background: #FF4B91; min-height:105vh">
                        <a class="text-white fs-4 px-2 fw-medium" href="{{ route('home') }}" style="text-decoration:none"><i class="bi bi-arrow-left"></i>&nbsp;&nbsp;  Keranjang</a>
                        <div class="row mt-5 px-2">
                            <div style="min-height: 80vh">
                                @forelse ($cart as $cart)
                                @if($loop->iteration != 1)
                                <hr class="text-white my-2 border-2">
                                @endif
                                <div class="d-flex">
                                    <div class="w-25">
                                        <img class="w-100 h-auto bg-white" src="{{ $cart->attributes->gambar ? asset('storage/photo/'. $cart->attributes->gambar) : asset('assets/admin/logo.png') }}" alt="" srcset="">
                                    </div>
                                    <div class="w-75 ps-4 text-white">
                                        <h4>{{ $cart->name }}</h4>
                                        <button type="button" class="btn btn-sm btn-light" data-catatan='{{ $cart->attributes->catatan }}' data-menuid='{{ $cart->id }}' data-bs-toggle="modal" data-bs-target="#cartCatatan">
                                            Catatan
                                        </button>
                                        <div class="d-flex justify-content-between">
                                            <div class="d-flex mt-2">
                                                <form action="{{ route('editqty') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="jumlah" value="-1">
                                                    <input type="hidden" name="menu_id" value="{{ $cart->id }}">
                                                    <button type="submit" class="btn btn-secondary" data-decrease>-</button>
                                                </form>
                                                <input class="rounded-2 bg-white mx-1" style="text-align:center; padding: 0px 0px; width:40px" data-value type="text" value="{{ $cart->quantity }}" disabled />
                                                <form action="{{ route('editqty') }}" method="post">
                                                    @csrf
                                                    <input type="hidden" name="jumlah" value="1">
                                                    <input type="hidden" name="menu_id" value="{{ $cart->id }}">
                                                    <button class="btn btn-secondary" data-increase>+</button>
                                                </form>
                                            </div>
                                            <h5>Rp. {{ number_format($cart->price*$cart->quantity,0,',','.') }}</h5>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <div class="px-2">
                                    <h5 class="text-white">Tidak Ada Item</h5>
                                </div>
                                @endforelse
                            </div>
                            <!-- Modal -->
                            <div class="modal fade" id="cartCatatan" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <form action="{{ route('editcatatan') }}" method="post">
                                        @csrf
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Catatan</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <input type="hidden" id="menuidcatatan" name="menu_id">
                                                <textarea class="form-control" name="catatan" id="textcatatan" cols="30" rows="10">

                                                </textarea>
                                            </div>
                                            <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Simpan Catatan</button>
                                        </div>
                                    </form>
                                </div>
                                </div>
                            </div>
                            @if(!$cart->isEmpty())
                                <div class="sticky">
                                    <a href="{{ route('confirm') }}" class="btn btn-primary w-100 fw-medium py-2">Pesan</a>
                                </div>
                            @endif
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
         $("button[data-bs-target='#cartCatatan']").on('click',function(){
            $('#textcatatan').html($(this).attr('data-catatan'))
            $('#menuidcatatan').val($(this).attr('data-menuid'))
        })


        $(function() {
            $('[data-decrease]').click(decrease);
            $('[data-increase]').click(increase);
            $('[data-value]').change(valueChange);
        });

        function decrease() {
            var value = $(this).parent().find('[data-value]').val();
            if(value > 1) {
                value--;
                $(this).parent().find('[data-value]').val(value);
            }
        }

        function increase() {
            var value = $(this).parent().find('[data-value]').val();
            if(value < 100) {
                value++;
                $(this).parent().find('[data-value]').val(value);
            }
        }

        function valueChange() {
            var value = $(this).val();
            if(value == undefined || isNaN(value) == true || value <= 0) {
                $(this).val(1);
            } else if(value >= 101) {
                $(this).val(100);
            }
        }
    </script>
</body>

</html>
