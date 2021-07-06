@extends('layouts.stisla')

@section('title','Damar Futsal Wonogiri')
@section('section-header','Inventory')
@section('content')

<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#modalSaya">
 Tambah Inventory
</button>
 
<!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel" aria-hidden="true">
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
        <br/>
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
        @foreach ($inventory as $aset)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$aset ->nama_barang}}</td>
            <td>{{$aset ->jumlah}}</td>

            <td class="text-center">
                <a href="" class="badge bg-warning text-dark">Edit</a>
                <a href="" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection
