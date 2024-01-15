@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <form action="{{ route('menuadmin.store') }}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="row mb-5">
            <h4>Tambah Menu</h4>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Nama Menu :</label>
            <div class="col-sm-6">
              <input type="text" name="nama" class="form-control" placeholder="Masukkan Nama Menu" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Deskripsi Menu :</label>
            <div class="col-sm-6">
                <textarea class="form-control" name="deskripsi" id="" cols="30" rows="10" placeholder="Masukkan Deskripsi Menu" required></textarea>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Gambar Menu :</label>
            <div class="col-sm-6">
                <input type="file" name="gambar" class="form-control" placeholder="Masukkan Gambar Menu" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Harga Menu :</label>
            <div class="col-sm-6">
                <input type="number" name="harga" class="form-control" placeholder="Masukkan Harga Menu" min="0" required>
            </div>
        </div>
        <div class="mb-3 row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Kategori Menu :</label>
            <div class="col-sm-6">
                <select name="kategori[]" class="form-select" id="multiple-select-field" data-placeholder="Pilih Kategori Menu" multiple required>
                    <option>Paketan</option>
                    <option>Nasi</option>
                    <option>Mie</option>
                    <option>Snack</option>
                    <option>Kopi</option>
                    <option>Teh</option>
                    <option>Soft Drink</option>
                    <option>Juice</option>
                    <option>Sandingan Paketan</option>
                    <option>Sandingan Nasi</option>
                    <option>Sandingan Mie</option>
                    <option>Sandingan Snack</option>
                    <option>Sandingan Kopi</option>
                    <option>Sandingan Teh</option>
                    <option>Sandingan Soft Drink</option>
                    <option>Sandingan Juice</option>
                    <option>Pedas</option>
                    <option>Dingin</option>
                    <option>Manis</option>
                    <option>Pahit</option>
                    <option>Panas</option>
                </select>
            </div>
        </div>
        <div class="d-flex justify-content-center">
            <button type="submit" class="btn btn-primary px-4 py-2">Tambah</button>
        </div>
    </form>
</div>

@endsection
