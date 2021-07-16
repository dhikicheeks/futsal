@extends('layouts.app')
@section('title','Pesan Lapangan')
@section('content')


{{-- DATATABLE --}}
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/bs5/dt-1.10.25/datatables.min.css" />
<div class="container">


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
                            <select name="jam" class="form-control">
                                <option selected disabled value="">Pilih Jam Mulai</option>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="paket">Paket 1 Jam</label>
                            @foreach ($paket_jam1 as $jam1)
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket1"
                                    value="{{$jam1->id_paket}}">
                                <label class="form-check-label" for="paket1">
                                    {{$jam1->deskripsi}}
                                </label>
                            </div>
                            @endforeach
                            <div class="form-group">
                                <label for="paket">Paket 2 Jam</label>
                                @foreach ($paket_jam2 as $jam2)
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="paket" id="paket1"
                                        value="{{$jam2->id_paket}}">
                                    <label class="form-check-label" for="paket1">
                                        {{$jam2->deskripsi}}
                                    </label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div>
                <div class="container">
                    <div class="alert alert-warning">
                        <strong>Perhatian !</strong> Diatas Jam 5 dikenai biaya tambahan <strong>Rp10.000</strong> untuk
                        lampu
                    </div>
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
                <th scope="col" class="">Tanggal</th>
                <th scope="col" class="">Jam</th>
                <th scope="col" class="">Nama Tim</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pesanan as $pesan)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$pesan->tanggal_pesan}}</td>
                <td>{{$pesan->jam_pesan}}</td>
                <td class="text-uppercase">{{$pesan->nama_tim}}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>





@endsection