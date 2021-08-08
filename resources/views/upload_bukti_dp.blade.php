@extends('layouts.app')
@section('title','Upload Bukti Transaksi')
@section('content')
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container">
    <h1 class="text-center">Halaman Upload Transaksi</h1>

    <table class="table table-hover" id="search_upload">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">No Pesanan</th>
                <th scope="col" class="text-center">Tanggal Pesan</th>
                <th scope="col" class="text-center">Nama Pemesan</th>
                <th scope="col" class="text-center">Tanggal Kick-Off</th>
                <th scope="col" class="text-center">Kick-Off</th>
                <th scope="col" class="text-center">Paket</th>
                <th scope="col" class="text-center">Harga</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                @foreach ($upload_dp as $upload)
                <th scope="row" class="text-center">{{$loop->iteration}}</th>
                <td class="text-center">{{$upload->id_non_member}}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($upload->created_at)->format('d/m/Y H:i')}}</td>
                <td class="text-uppercase text-center">{{$upload->nama_pemesan}}</td>
                <td class="text-uppercase text-center">
                    {{ \Carbon\Carbon::parse($upload->tanggal_pertandingan)->format('d/m/Y')}}</td>
                <td class="text-uppercase text-center">{{ \Carbon\Carbon::parse($upload->jam_pertandingan)->format('H:i')}}
                </td>
                <td class="text-uppercase text-center">{{$upload->deskripsi}}</td>
                <td class="text-uppercase text-center">{{$upload->harga}}</td>
                <td class="text-center">
                    <!-- Button trigger modal -->
                    <a onclick="ambil_id_pesanan({{$upload->id_non_member}})" href=""
                        class="badge  rounded-pill  bg-success" style="text-decoration:none" class="btn btn-primary"
                        data-bs-toggle="modal" data-bs-target="#UploadResi">Upload
                        Pembayaran</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>



<!-- Modal -->
<div class="modal fade" id="UploadResi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UploadResiLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form action="resi_transaksi_upload" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="UploadResiLabel">Upload Bukti Pembayaran Dp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <input type="file" name="foto_resi" id="foto_resi">
                </div>
                <div class="modal-footer">
                    <input hidden type="text" name="id_non_member" id="id_non_member">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="input" class="btn btn-primary">Upload</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function ambil_id_pesanan(id_non_member) {
        $('#id_non_member').val(id_non_member);
    }

</script>
@endsection
