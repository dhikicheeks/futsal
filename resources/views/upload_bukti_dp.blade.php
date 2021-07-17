@extends('layouts.app')
@section('title','Upload Bukti Transaksi')
@section('content')

<div class="container">
    <h1 class="text-center">Halaman Upload Transaksi</h1>

    <table class="table table-hover" id="search_upload">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Tanggal Pesan</th>
                <th scope="col" class="text-center">No Pesanan</th>
                <th scope="col" class="text-center">Nama Pemesan</th>
                <th scope="col" class="text-center">Paket</th>
                <th scope="col" class="text-center">Harga</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
               @foreach ($upload_dp as $upload)  
               <th scope="row" class="text-center">{{$loop->iteration}}</th>
               <td class="text-center">{{$upload->tanggal_pesan}}</td>
               <td class="text-center">{{$upload->id_pesanan}}</td>
               <td class="text-uppercase text-center">{{$upload->nama_pemesan}}</td>
               <td class="text-uppercase text-center">{{$upload->deskripsi}}</td>
               <td class="text-uppercase text-center">{{$upload->harga}}</td>
               <td class="text-center">
                    <!-- Button trigger modal -->
                    <a href="" class="badge bg-success" style="text-decoration:none"
                    class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload
                    Pembayaran</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>


<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Upload Bukti DP</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Upload</button>
            </div>
        </div>
    </div>
</div>
@endsection
