<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Resi DP</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">
</head>

<body>
    <br>
    
    @foreach ($resi as $item) 
    <div class="container mt-5">
        <div class="card h-100">
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col-12">
                                <div class="alert alert-success text-center">
                                   <strong >DAMAR FUTSAL WONOGIRI  </strong>                            
                                </div>
                        <p class="">Nama Pemesan :
                            <br> <strong>{{$item->nama_pemesan}}</strong>
                        </p>
                    </div>
                    <div class="col-6">
                      
                    </div>
                </div>
@endforeach
                <div class="row">
                    <div class="col-md-12">
                        <hr>
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title"><strong>Detail Pesanan</strong></h3>
                            </div>
                            <div class="panel-body">
                                <div class="table-responsive">
                                    <table class="table table-condensed">
                                        <thead>
                                            <tr>
                                                <td><strong>Detail Paket</strong></td>
                                                <td class=""><strong>Harga Paket</strong></td>
                                                <td class=""><strong>Biaya Tambahan</strong></td>
                                                <td class=""><strong>Tambahan Penyewaan Rompi</strong></td>
                                                <td class=""><strong>Total Harga</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($resi as $item)
                                                <tr>
                                                    <td>{{ $item->nama_paket }}</td>
                                                    <td>{{ $item->harga }}</td>
                                                    <td>{{ $item->biaya_tambahan }}</td>
                                                    <td>{{ $item->tambahan_rompi }}</td>
                                                    <td>{{ $item->harga + $item->biaya_tambahan + $item->tambahan_rompi}}</td>
                                                </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                                
                                <div class="alert alert-primary text-center">
                                    <strong>Terima kasih sudah bermain di Damar Futsal</strong>
                                </div>
                            </div>
                            <hr>
                            <div class="panel-footer float-right">
                                <button class="btn btn-success" onclick="window.print()"><i class="fas fa-cloud-upload-alt"></i >Cetak</button>
                                <a href="{{url('/home')}}" class="btn btn-danger"> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



   
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

</html>