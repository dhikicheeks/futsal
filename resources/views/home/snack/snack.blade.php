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
    <i class="fas fa-cookie-bite mx-1"></i>Tambah Snack Baru
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
                        <input type="text" class="form-control @error ('nama_snack') is-invalid @enderror"
                            id="nama_snack" placeholder="Masukan Nama Snack" name="nama_snack"
                            value="{{old('nama_snack')}}">
                        @error('nama_snack')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli</label>
                        <input type="text" class="form-control @error ('harga_beli') is-invalid @enderror"
                            id="harga_beli" placeholder="Masukan Harga Beli" name="harga_beli"
                            value="{{old('harga_beli')}}">
                        @error('harga_beli')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual</label>
                        <input type="text" class="form-control  @error ('harga_jual') is-invalid @enderror"
                            id="harga_jual" placeholder="Masukan Harga Jual" name="harga_jual"
                            value="{{old('harga_jual')}}"> @error('harga_jual')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_masuk" class="form-label">Jumlah</label>
                        <input type="text" class="form-control  @error ('jumlah_masuk') is-invalid @enderror"
                            id="jumlah_masuk" placeholder="Masuk Kuantiti" name="jumlah_masuk"
                            value="{{old('jumlah_masuk')}}"> @error('harga_jual')
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
            <th scope="col">Harga Beli</th>
            <th scope="col">Harga Jual/pcs</th>
            <th scope="col">Stock</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($snack as $sn)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase">{{$sn->nama_snack}}</td>
            <td>{{$sn->harga_beli}}</td>
            <td>{{$sn->harga_jual}}</td>
            <td>{{$sn->jumlah_masuk}}</td>

            <td class="text-center">
                <a class="fa fa-plus-square fa-lg text-decoration-none" style="color:green"
                    onclick="tambahsnack(<?php echo $sn->id_snack; ?>)"></a>
                <a class="fa fa-minus-square fa-lg mx-2 text-decoration-none" onclick="kurangsnack(<?php echo $sn->id_snack; ?>)"
                    style="color:orange"></a>
                <a href="/snack/delete/{{$sn->id_snack}}" class="fa fa-trash fa-lg text-decoration-none"
                    style="color:red"></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{{-- TAMBAH KUANTITI --}}
<div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body" id="isi_modal_tambah">
            </div>
        </div>
    </div>
</div>
{{-- KURANG KUANTITI --}}
<div class="modal fade" id="modalKurang" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
            </div>
            <div class="modal-body" id="isi_modal_kurang">
            </div>
        </div>
    </div>
</div>


<script>
    function tambahsnack(id_snack) {
        var token = '{{ csrf_token() }}';

        $.ajax({
            method: "POST",
            url: '{{url('tambah_quantity_snack')}}',
            data: {
                '_token': token,
                'id_snack': id_snack
            },

            success: function (resp) {
                $("#isi_modal_tambah").html(resp);
                $('#modalTambah').modal('show');
            },
            error: function (resp) {

            }
        });

    }
</script>

<script>
    function kurangsnack(id_snack) {
        var token = '{{ csrf_token() }}';

        $.ajax({
            method: "POST",
            url: '{{url('kurang_quantity_snack')}}',
            data: {
                '_token': token,
                'id_snack': id_snack
            },

            success: function (resp) {
                $("#isi_modal_kurang").html(resp);
                $('#modalKurang').modal('show');
            },
            error: function (resp) {

            }
        });

    }
</script>
@endsection
