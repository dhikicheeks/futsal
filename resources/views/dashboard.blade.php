@extends('layouts.app')

@section('title','Damar Futsal Wonogiri')
@section('content')

<div class="container"">
    <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-indicators">
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
            <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="{{asset('assets/img/slider/slider-1.jpg')}}" class="d-block w-100" style="max-height: 650px"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/slider/slider-2.jpg')}}" class="d-block w-100" style="max-height: 650px"
                    alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/slider/slider-3.jpg')}}" class="d-block w-100" style="max-height: 650px"
                    alt="...">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
            data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
</div>


<div class="container">
    <h1 class="mt-5 text-center">Jadwal Pertandingan</h1>
    <h3 class="text-center">{{\Carbon\Carbon::parse($date_now)->format('d-M-y')}}</h3>
</div>
<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center">No</th>
                <th scope="col" class="text-center">Kick Off</th>
                <th scope="col" class="text-center">Nama Tim</th>
                <th scope="col" class="text-center">Status Pembayaran</th>
            </tr>
        </thead>
        <tbody>
            @foreach($jadwal as $pesan)
            <tr>
                <th scope="row" class="text-center">{{$loop->iteration}}</th>
                <td class="text-center">{{ \Carbon\Carbon::parse($pesan->jam_pertandingan)->format('H:i')}}</td>
                <td class="text-center" class="text-uppercase">{{$pesan->nama_tim}}</td>
                <td class="text-center" class="text-uppercase"><h3 @if ($pesan->flag_status==1)
                   class="badge rounded-pill bg-danger text-light sm">{{$pesan->status_deskripsi}}
                    @endif</h3></td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>

@endsection
