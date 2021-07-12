@extends('layouts.stisla')

@section('title','Validasi Turnamen')
@section('section-header','Validasi Daftar Turnamen')
@section('content')


<table class="table table-hover" id="search-validasi-turnamen">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Jam Pesan</th>
            <th scope="col">Paket</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <th scope="row">1</th>
            <td>1</td>
            <td>4</td>
            <td>4</td>
            <td>4</td>

            <td class="text-center">
                <a href="" class="badge bg-primary text-light" data-toggle="modal" data-target="#modalSaya">Detail</a>

                <a href="" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>

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
    </tbody>
</table>

@endsection