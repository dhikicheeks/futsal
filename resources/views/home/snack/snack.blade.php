@extends('layouts.stisla')

@section('title','Stock Snack')
@section('section-header','Stock Snack')
@section('content')


@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@elseif (session('status-delete'))
<div class="alert alert-danger">
    {{ session('status-delete') }}
</div>

@endif

<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalSaya">
    Tambah Snack Baru
</button>


<!-- Input Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/inputstock">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSayaLabel">Tambahkan Snack Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="snack" class="form-label">Nama Snack</label>
                        <input type="text" class="form-control @error ('snack') is-invalid @enderror" id="snack"
                            placeholder="Masukan nama snack" name="snack" value="{{old('snack')}}">
                        @error('snack')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control @error ('harga') is-invalid @enderror" id="harga"
                            placeholder="Masukan harga satuan" name="harga" value="{{old('harga')}}">
                        @error('harga')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Jumlah Stock</label>
                        <input type="text" class="form-control  @error ('stock') is-invalid @enderror" id="stock"
                            placeholder="Masukan jumlah stock" name="stock" value="{{old('stock')}}"> @error('stock')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>

                </div>
            </form>
        </div>
    </div>
</div>

<table class="table table-hover" id="search-makanan">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Snack</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($snack as $sn)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$sn->nama_snack}}</td>
            <td>{{$sn->harga}}</td>
            <td>{{$sn->stock}}</td>

            <td class="text-center">
                <a href="/snack/edit/{{$sn->id_snack}}" class="badge bg-warning text-dark" data-toggle="modal"
                    data-target="#modalEdit">Edit</a>
                <a href="/snack/delete/{{$sn->id_snack}}" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


<!-- Edit Modal -->
<div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="modalEditLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/update_snack">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalEditLabel">Tambahkan Snack</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="snack" class="form-label">Nama Snack</label>
                        <input type="text" class="form-control @error ('snack') is-invalid @enderror" id="snack"
                            placeholder="Masukan snack snack" name="snack" value="">
                        @error('snack')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga" class="form-label">Harga</label>
                        <input type="text" class="form-control @error ('harga') is-invalid @enderror" id="harga"
                            placeholder="Masukan harga harga" name="harga">
                        @error('harga')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="stock" class="form-label">Stock Barang</label>
                        <input type="text" class="form-control  @error ('stock') is-invalid @enderror" id="stock"
                            placeholder="Masukan stock" name="stock"> @error('stock')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>

                </div>
            </form>
        </div>
    </div>
</div>

@endsection
