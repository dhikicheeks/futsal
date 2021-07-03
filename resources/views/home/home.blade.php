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

ISI Untuk Login Owner

@endsection
@endif



<!-- LOGIN Member -->
@if(Auth::user()->role_id == 1)
@section('section-header','Apa Hayo??')

@section('content')

ISI Untuk Login Member

@endsection
@endif
