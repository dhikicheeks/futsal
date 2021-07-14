@extends('layouts.stisla')

@section('title','Laporan Keuangan Snack')
@section('section-header','Laporan Keuangan Snack')
@section('content')



<table class="table table-hover" id="search-keuangan-snack">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Snack</th>
            <th scope="col">Harga</th>
            <th scope="col">Harga</th>
            <th scope="col">Jumlah</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($laporan_keuangan_snack as $sn)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$sn->nama_snack}}</td>
            <td>{{$sn->harga}}</td>
            <td>{{$sn->stock}}</td>
            <td>{{$sn->stock}}</td>

            <td class="text-center">
                <button class="badge bg-primary text-light">Detail</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/inputinventory">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSayaLabel">Detail Verifikasi DP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Verifikasi</button>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection