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
    <div class="container mt-5">
        <div class="card h-100">
            <div class="card-body">
                <div class="row pt-3">
                    <div class="col-6">
                        <p class="">Nama Pemesan :
                            <br> <strong>Reza</strong>
                        </p>
                    </div>
                    <div class="col-6">
                        <h5 class="text-right mt-2">No Pesanan # 12345</h5>
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
                                                <td><strong>Paket</strong></td>
                                                <td class="text-center"><strong>Durasi</strong></td>
                                                <td class="text-center"><strong>Bonus</strong></td>
                                                <td class="text-right"><strong>Harga</strong></td>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <tr>
                                                <td>1</td>
                                                <td class="text-center">2 Jam</td>
                                                <td class="text-center">2 Air Mineral 1,5L & Rompi</td>
                                                <td class="text-right">Rp.70.000</td>
                                            </tr>

                                        </tbody>
                                    </table>
                                </div>
                                <div class="alert alert-warning">
                                    <strong>Perhatian !</strong> Kirim ke Rekening An.BBBBB 11231231
                                </div>
                                <div class="alert alert-danger">
                                    <strong>Perhatian !</strong> Screenshoot resi ini sebagai bukti pembayaran
                                    dan
                                    untuk melakuan validasi admin
                                </div>
                            </div>
                            <hr>
                            <div class="panel-footer float-right">
                                <button class="btn btn-success btn-sm" data-bs-toggle="modal"
                                    data-bs-target="#UploadResi">Upload</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="UploadResi" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UploadResiLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="UploadResiLabel">Upload Bukti Pembayaran Dp</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Upload</button>
                </div>
            </div>
        </div>
    </div>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-gtEjrD/SeCtmISkJkNUaaKMoLD0//ElJ19smozuHV6z3Iehds+3Ulb9Bn9Plx0x4" crossorigin="anonymous">
</script>

</html>