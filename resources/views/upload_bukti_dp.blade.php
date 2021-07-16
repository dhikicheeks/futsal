@extends('layouts.app')
@section('title','Upload Bukti Transaksi')
@section('content')

<div class="container">
    <h1 class="text-center">Halaman Upload Transaksi</h1>

    <table class="table table-hover" id="search_upload">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">No Pesanan</th>
                <th scope="col" class="text-center">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td class="text-center">
                    <!-- Button trigger modal -->
                    <a href="" class="badge bg-success" style="text-decoration:none" type="button"
                        class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">Upload
                        Pembayaran</a>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Upload Bukti DP</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
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
                </td>
            </tr>

        </tbody>
    </table>
</div>

@endsection