@extends('layouts.app')

@section('content')
<div class="m-5">
    <h3>Daftar Produk</h3>
    <div class="d-flex my-3 gap-3 justify-content-between">
        <div class="d-flex gap-3">
            <input type="search" name="search" id="search" class="form-control" placeholder="Search Produk">
            <select name="category" id="category" class="form-select">
                @if ($category_selected != 'all')
                    <option value="{{ $category_selected }}" selected>{{ \App\Models\Category_produk::find($category_selected)->nama }}</option>
                @endif
                <option value="all">All</option>
                @foreach ($category as $item)
                    <option value="{{ $item->id }}">{{ $item->nama }}</option>
                @endforeach
            </select>
        </div>
        <div class="d-flex gap-2">
            <form action="{{ route('produks.export') }}" method="GET">
                @csrf
                <input type="hidden" name="category_selected" value="{{ $category_selected }}">
                <input type="hidden" name="search_selected" value="{{ $search_selected }}">
                <button type="submit" class="btn btn-success">Export Excel</button>
            </form>
            {{-- <button href="{{ route('produks.export') }}" class="btn btn-success">Export Excel</button> --}}
            <a href="{{ route('produks.create') }}" class="btn btn-primary">Tambah Produk</a>
        </div>
    </div>
    <div class="card" style="width: 100;">
        <table class="table table-striped">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Image</th>
                <th scope="col">Nama Produk</th>
                <th scope="col">Category Produk</th>
                <th scope="col">Harga beli (Rp)</th>
                <th scope="col">Harga Jual (Rp)</th>
                <th scope="col">Stok</th>
                <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($data as $item)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><img src="{{ asset('assets/img/produk/'.$item->image) }}" width="50px" alt=""></td>
                        <td>{{ $item->nama }}</td>
                        <td>{{ $item->category->nama }}</td>
                        <td>{{ $item->harga_beli }}</td>
                        <td>{{ $item->harga_jual }}</td>
                        <td>{{ $item->stok }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('produks.edit', $item->id) }}" class="btn btn-warning"><i class="bi bi-pencil"></i></a>
                            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#hapus{{ $item->id }}"><i class="bi bi-trash"></i></button>
                        </td>
                    </tr>


                    <!-- Modal hapus-->
                    <div class="modal fade" id="hapus{{ $item->id }}" tabindex="-1" aria-labelledby="hapus" aria-hidden="true">
                        <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h1 class="modal-title fs-5" id="hapus">Hapus Category</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form action="{{ route('produks.destroy', $item->id) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <h3 class="text-center">Apakah Anda Yakin Ingin Menghapus Data Ini?</h3>
                                    <button type="submit" class="btn btn-primary mt-3 d-block ms-auto">Lanjutkan</button>
                                </form>
                            </div>
                        </div>
                        </div>
                    </div>
                @endforeach
            </tbody>
        </table>
        <div class="row px-5">
            {{ $data->links() }}
        </div>
    </div>
</div>

<script>
    search = document.getElementById('search');
    search.addEventListener('input', function() {
        let search = this.value;
        let category = document.getElementById('category').value;
        window.location.href = '/produks?search=' + search + '&category=' + category;
    });

    category = document.getElementById('category');
    category.addEventListener('change', function() {
        let search = document.getElementById('search').value;
        let category = this.value;
        window.location.href = '/produks?search=' + search + '&category=' + category;
    });
</script>
@endsection