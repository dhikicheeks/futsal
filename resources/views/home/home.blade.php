@extends('layouts.stisla')

@section('title','Damar Futsal Wonogiri')
<!-- LOGIN OWNER dan ADMIN -->
@if(Auth::user()->role_id == 100 ||
Auth::user()->role_id == 90)
@section('section-header','Verifikasi Dp')
@section('content')

ISI Untuk Login Owner dan Admin

@endsection
@endif


<!-- LOGIN Member -->
@if(Auth::user()->role_id == 1)
@section('section-header','Apa Hayo??')

@section('content')

ISI Untuk Login Member

@endsection
@endif