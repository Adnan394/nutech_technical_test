@extends('layouts.app')

@section('content')
<div class="mx-5 mt-5">
    <h3><a href="{{ route('produks.index') }}" class="text-decoration-none text-secondary">Daftar Produk</a> > Tambah produk</h3>
    <div class="card" style="width: 100%;">
        <form action="{{ route('produks.store') }}" method="POST" class="p-5" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <div class="col-4">
                    <label for="" class="form-label">Kategori Barang</label>
                    <select name="category" class="form-select" id="">
                        <option value="">Pilih Kategori</option>
                        @foreach ($category as $item)
                            <option value="{{ $item->id }}">{{ $item->nama }}</option>
                        @endforeach
                    </select>
                    @error('category')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <label for="" class="form-label">Nama Produk</label>
                    <input type="text" name="name" class="form-control">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="" class="form-label">Harga Beli</label>
                    <input type="number" name="harga_beli" id="harga_beli" class="form-control">
                    @error('harga_beli')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <label for="" class="form-label">Harga Jual</label>
                    <input type="number" name="harga_jual" id="harga_jual" class="form-control">
                    @error('harga_jual')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col">
                    <label for="" class="form-label">Stok</label>
                    <input type="number" name="stok" class="form-control">
                    @error('stok')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="row mb-3">
                <div class="col">
                    <label for="" class="form-label">Upload Gambar</label>
                    <div class="custom-file-upload text-center border p-3 rounded">
                        <label for="image-upload" class="d-block">
                            <img src="https://via.placeholder.com/200x200.png?text=Upload+Image" alt="Upload Icon" class="img-thumbnail mb-2" style="width: 200px; height: 200px;">
                            <p class="text-secondary">Upload Gambar</p>
                        </label>
                        <input type="file" name="image" id="image-upload" class="d-none" accept="image/*">
                        @error('image')
                            <small class="text-danger">{{ $message }}</small>
                        @enderror
                    </div>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        let harga_beli = document.getElementById('harga_beli');
        let harga_jual = document.getElementById('harga_jual');
        let price = 0;

        harga_beli.addEventListener('input', function() {
            let beli = parseFloat(this.value) || 0;
            price = Math.round(beli + (30 * beli / 100));
            harga_jual.value = price;
        });

        // Preview image
        const imageInput = document.getElementById('image-upload');
        const imagePreview = document.querySelector('.custom-file-upload img');
        imageInput.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    imagePreview.src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    });
</script>
@endsection
