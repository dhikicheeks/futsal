@extends('layouts.app')
@section('title','Pesan Lapangan')
@section('content')

<div class="container">
    <center>
        <h1> Turnamen</h1>
    </center>
</div>


<h1 class="text-center">Jadwal Futsal Hari ini</h1>
<!-- Button trigger modal -->
<button type="button" class="btn btn-success mb-3" data-toggle="modal" data-target="#exampleModal">
    Pesan Sekarang
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Pesan Lapangan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="/inputpesanan">
                    @csrf
                    <div class="form-group">
                        <label for="tang">Nama Pemesan</label>
                        <input type="text" class="form-control" placeholder="Nama Pemesan" name="pemesan">
                    </div>
                    <div class="form-group">
                        <label for="tang">Nama Tim</label>
                        <input type="text" class="form-control" placeholder="Nama Tim" name="nama_tim">
                    </div>
                    <div class="form-group">
                        <label for="tang">Tanggal</label>
                        <input type="date" class="form-control" placeholder="Pilih tanggal" name="tanggal">
                    </div>
                    <div class="form-group">
                        <label for="tang">Jam</label>
                        <input type="time" class="form-control" id="jam" placeholder="Pilih jam" name="jam">
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                        <button type="submit" class="btn btn-primary">Pesan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="">No</th>
                <th scope="col" class="">Nama Tim</th>
                <th scope="col" class="">Tanggal</th>
                <th scope="col" class="">Jam</th>
                <th scope="col" class="">Peket</th>

                {{-- @foreach($pesanan as $pesan)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$pesan->nama_tim}}</td>
                <td>{{$pesan->tanggal_pesan}}</td>
                <td>{{$pesan->jam_pesan}}</td>
                <td>{{$pesan->paket}}</td>

            </tr>
            @endforeach --}}


            </tbody>
    </table>

    @endsection
