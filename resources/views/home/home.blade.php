@extends('layouts.stisla')


@section('title','Damar Futsal Wonogiri')
<!--  ADMIN -->
@if(
Auth::user()->role_id == 90)
@section('section-header','Verifikasi Dp')
@section('content')

ISI Untuk Login Owner dan Admin

@endsection
@endif


<!-- LOGIN OWNER -->
@if(Auth::user()->role_id == 100 )
@section('section-header','Inventory')
@section('content')

<button type="button" class="btn btn-primary mb-4" data-toggle="modal" data-target="#modalSaya">
    Tambah Inventory
</button>

<!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalSayaLabel">Judul Modal Di Sini</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Halo, ini modal sederhana.
                <br />
                Seri Tutorial Bootstrap 4 lengkap dari dasar sampai mahir.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Oke</button>
            </div>
        </div>
    </div>
</div>


<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <th scope="row"></th>
            <td></td>
            <td></td>

            <td class="text-center">
                <a href="" class="badge bg-warning text-dark">Edit</a>
                <a href="" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>
    </tbody>
</table>

@endsection
@endif



<!-- LOGIN Member -->
@if(Auth::user()->role_id == 1)
@section('section-header','Apa Hayo??')

@section('content')

ISI Untuk Login Member

@endsection
@endif