@extends('layouts.stisla')

@section('title','Validasi Pelunasan')
@section('section-header','Verifikasi Pelunasan')
@section('content')


<table class="table table-hover" id="search-validasi-dp">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">No Pesanan</th>
            <th scope="col" class="text-center">Tanggal Pesan</th>
            <th scope="col" class="text-center">Jam Pesan</th>
            <th scope="col" class="text-center">Nama Pemesan</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($pelunasan as $dp)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase text-center">{{$dp->id_pesanan}}</td>
            <td class="text-uppercase text-center">{{$dp->tanggal_pesan}}</td>
            <td class="text-uppercase text-center">{{$dp->jam_pesan}}</td>
            <td class="text-uppercase text-center">{{$dp->nama_pemesan}}</td>
            <td><h3 class="badge bg-info text-light font-weight-bold">{{$dp->deskripsi}}</h3></td>
            <td><button @if ($dp->flag_status == 1)
                    hidden
                @endif onclick="detail_validasi_dp({{$dp->id_pesanan}})" class="badge bg-success text-light">Verifikasi</button> 
               </td>
        </tr>
        @endforeach

        <!-- Verifikasi Modal -->
    </tbody>
</table>

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