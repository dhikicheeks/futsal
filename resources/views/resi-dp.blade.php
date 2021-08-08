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
    <?php 
    $harga_total = 0 ;
    ?>
    @foreach ($ambil_data as $data)
    <div class="container mt-5">
        <div class="card h-100">
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col-6">
                        <p class="">Nama Pemesan :
                            <br> <strong>{{$data->nama_pemesan}}</strong>
                        </p>
                    </div>
                    <div class="col-6">
                        <h5 class="text-right mt-2">No Pesanan # {{$data->id_pertandingan}}</h5>
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
                                                <td><strong>Detail Paket</strong></td>
                                                <td class=""><strong>Harga Paket</strong></td>
                                                <td class=""><strong>Biaya Tambahan</strong></td>
                                                <td class=""><strong>Total Harga</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{$data->paket_deskripsi}}</td>
                                                <td>{{$data->harga}}</td>
                                                <td>{{$data->biaya_tambahan}}</td>
                                                <td class=""><strong>
                                                        {{$data->harga+$data->biaya_tambahan}}
                                                    </strong>
                                                </td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="alert alert-warning">
                                    <strong>Perhatian !</strong> Kirim ke Rekening An.BBBBB 11231231 dengan Nominal
                                    Rp.20.000
                                </div>
                                <div class="alert alert-danger">
                                    <strong>Perhatian !</strong> Screenshoot resi ini sebagai bukti pembayaran
                                    dan
                                    untuk melakuan validasi admin
                                    <br>
                                    <strong>Pembayaran Max 1 Jam Setelah pembayaran</strong>
                                </div>
                            </div>
                            <hr>
                            <div class="panel-footer float-right">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#UploadResi"><i class="fas fa-cloud-upload-alt"></i>Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach


    <!-- Modal -->
    <div class="modal fade" id="UploadResi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UploadResiLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="resi_transaksi_upload" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="modal-header">
                        <h5 class="modal-title" id="UploadResiLabel">Upload Bukti Pembayaran Dp</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <input type="file" name="foto_resi" id="foto_resi">
                    </div>
                    <div class="modal-footer">
                        @foreach ($ambil_data as $item)
                            <input hidden type="text" name="id_non_member" value="{{$item->id_non_member}}">
                        @endforeach
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="input" class="btn btn-primary">Upload</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

</html>
