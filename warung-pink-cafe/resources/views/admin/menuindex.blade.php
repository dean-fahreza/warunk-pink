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
                                <th>No.</th>
                                <th>Nama</th>
                                <th>Persedian</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($menu as $menu)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $menu->nama }}</td>
                                <td>
                                    <div class="d-flex">
                                        <div>
                                            <form action="{{ route('menu.tersedia',$menu->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="tersedia" value="1">
                                                <button type="submit" class="btn btn-success">Tersedia</button>
                                            </form>
                                        </div>
                                        <div class="mx-2">
                                            <form action="{{ route('menu.tersedia',$menu->id) }}" method="post">
                                                @csrf
                                                <input type="hidden" name="tersedia" value="0">
                                                <button type="submit" class="btn btn-danger">Kosong</button>
                                            </form>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <button type="button" class="btn btn-light" data-menuid="{{ $menu->id }}" data-nama="{{ $menu->nama }}" data-deskripsi="{{ $menu->deskripsi }}" data-harga="{{ $menu->harga }}" data-kategori="{{ $menu->category }}" data-bs-toggle="modal" data-bs-target="#menuIndex{{ $menu->id }}">
                                        Edit
                                    </button>
                                </td>
                                <div class="modal fade" id="menuIndex{{ $menu->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Menu</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('menuadmin.update') }}" method="post" enctype="multipart/form-data">
                                            <div class="modal-body">
                                                @csrf
                                                <input type="hidden" name="menu_id" id="menuidedit" value="{{ $menu->id }}">
                                                <div class="mb-3 row">
                                                    <label for="inputPassword" class="col-form-label">Nama Menu :</label>
                                                    <div class="">
                                                      <input id="namaedit" value="{{ $menu->nama }}"  type="text" name="nama" class="form-control" placeholder="Masukkan Nama Menu" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputPassword" class="col-form-label">Deskripsi Menu :</label>
                                                    <div class="">
                                                        <textarea class="form-control" name="deskripsi" id="deskripsiedit" cols="30" rows="10" placeholder="Masukkan Deskripsi Menu" required>{{ $menu->deskripsi }}</textarea>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputPassword" class="col-form-label">Gambar Menu :</label>
                                                    <div class="">
                                                        <input type="file" id="gambaredit" name="gambar" class="form-control" placeholder="Masukkan Gambar Menu">
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    <label for="inputPassword" class="col-form-label">Harga Menu :</label>
                                                    <div class="">
                                                        <input type="number" id="hargaedit" name="harga" value="{{ $menu->harga }}" class="form-control" placeholder="Masukkan Harga Menu" min="0" required>
                                                    </div>
                                                </div>
                                                <div class="mb-3 row">
                                                    @php
                                                        $kategori = $menu->category;
                                                    @endphp
                                                    <label for="inputPassword" class="col-form-label">Kategori Menu : </label>
                                                    <div class="">
                                                        <select name="kategori[]" class="form-select dt-select2"  data-placeholder="Pilih Kategori Menu" multiple required>
                                                            <option {{ $kategori->where('kategori','Paketan')->first() ? 'selected' : ''  }}>Paketan</option>
                                                            <option {{ $kategori->where('kategori','Nasi')->first() ? 'selected' : ''  }}>Nasi</option>
                                                            <option {{ $kategori->where('kategori','Mie')->first() ? 'selected' : ''  }}>Mie</option>
                                                            <option {{ $kategori->where('kategori','Snack')->first() ? 'selected' : ''  }}>Snack</option>
                                                            <option {{ $kategori->where('kategori','Kopi')->first() ? 'selected' : ''  }}>Kopi</option>
                                                            <option {{ $kategori->where('kategori','Teh')->first() ? 'selected' : ''  }}>Teh</option>
                                                            <option {{ $kategori->where('kategori','Soft Drink')->first() ? 'selected' : ''  }}>Soft Drink</option>
                                                            <option {{ $kategori->where('kategori','Juice')->first() ? 'selected' : ''  }}>Juice</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Paketan')->first() ? 'selected' : ''  }}>Sandingan Paketan</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Nasi')->first() ? 'selected' : ''  }}>Sandingan Nasi</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Mie')->first() ? 'selected' : ''  }}>Sandingan Mie</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Snack')->first() ? 'selected' : ''  }}>Sandingan Snack</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Kopi')->first() ? 'selected' : ''  }}>Sandingan Kopi</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Teh')->first() ? 'selected' : ''  }}>Sandingan Teh</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Soft Drink')->first() ? 'selected' : ''  }}>Sandingan Soft Drink</option>
                                                            <option {{ $kategori->where('kategori','Sandingan Juice')->first() ? 'selected' : ''  }}>Sandingan Juice</option>
                                                            <option {{ $kategori->where('kategori','Pedas')->first() ? 'selected' : ''  }}>Pedas</option>
                                                            <option {{ $kategori->where('kategori','Dingin')->first() ? 'selected' : ''  }}>Dingin</option>
                                                            <option {{ $kategori->where('kategori','Manis')->first() ? 'selected' : ''  }}>Manis</option>
                                                            <option {{ $kategori->where('kategori','Pahit')->first() ? 'selected' : ''  }}>Pahit</option>
                                                            <option {{ $kategori->where('kategori','Panas')->first() ? 'selected' : ''  }}>Panas</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                <button type="submit" class="btn btn-primary">Edit Menu</button>
                                            </div>
                                        </form>
                                    </div>
                                    </div>
                                </div>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
