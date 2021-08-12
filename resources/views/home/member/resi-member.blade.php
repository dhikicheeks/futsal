<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Resi Member</title>

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
    <div class="container mt-5">
        <div class="card h-100">
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col-6">
                        <p class="">Nama Member :
                            <br> <strong>{{$nama->name}}</strong>
                        </p>
                    </div>
                    <div class="col-6">
                        {{-- <h5 class="text-right mt-2">No Pesanan # {{$data->id_pertandingan}}</h5> --}}
                    </div>
                </div>
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
                                                <td><strong>Tanggal Pertandingan</strong></td>
                                                <td class=""><strong>Jam Pertandingan</strong></td>
                                                <td class=""><strong>Pertandingan</strong></td>
                                                {{-- <td class=""><strong>Total Harga</strong></td> --}}
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($ambil_data as $member)
                                            <tr>
                                                <td>{{$member->tanggal_pertandingan}}</td>
                                                <td>{{$member->jam_pertandingan}}</td>
                                                <td>{{$member->id_pertandingan}}</td>
                                            </tr>
                                             <input type="text" id="jadwal" name="jadwal" value="{{ $member->jadwal }}" hidden>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                    <div class="form-check">
                                        <select name="pembayaran_id" id="pembayaran_id" class="form-control">
                                            <option>--PILIH--</option>
                                            @foreach ($metode_pembayaran as $method)
                                                <option value="{{$method->id_pembayaran}}">{{$method->diskripsi}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <hr>
                                     <div class="alert alert-info">
                                    <strong>Perhatian !</strong> Jika memilih metode TF Kirim ke Rekening xxxxxx AN xxx
                                </div>
                                    <div class="panel-footer float-right">
                                        <button class="btn btn-success btn-sm" onclick="selesaiPembayaran()">Submit</button>
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
<script>
    function selesaiPembayaran(){
        var pembayaran_id = $('#pembayaran_id').val();
        var my_url = "{{url('upload_pembayaran_member')}}";
        var token = '{{ csrf_token() }}';
        var formData = {
            '_token': token,
            'pembayaran_id': pembayaran_id
        };
        $.ajax({
            method: "POST",
            url: my_url,
            data: formData,
            // datatype: json,
                success: function(resp){
                    // console.log(resp);
                    window.location.href = "/home";
                },
                error: function(resp){
                    // console.log(resp);
                }
        });
    }
</script>
</html>
