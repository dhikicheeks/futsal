@extends('layouts.app')

@section('title','Damar Futsal Wonogiri')
@section('content')

<div class="container">
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
                <img src="{{asset('assets/img/slider/slider-1.jpg')}}"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/slider/slider-2.jpg')}}"
                    class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="{{asset('assets/img/slider/slider-3.jpg')}}"
                    class="d-block w-100" alt="...">
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
    <h3 class="text-center">16 Juni 2021</h3>
</div>


<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="text-center">Jam</th>
                <th scope="col" class="text-center">Nama Tim</th>

            </tr>
        </thead>
        <tbody>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>
            <tr>
                <td class="text-center">08.00 - 10.00</td>
                <td class="text-center">Rock FC</td>
            </tr>


        </tbody>
    </table>
</div>


@endsection