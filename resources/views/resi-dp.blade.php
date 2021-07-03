<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Resi DP</title>
    <link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-xs-12">
                <div class="invoice-title">
                    <h2>Nota Pembayaran DP</h2>
                    <h3 class="text-right">No Pesanan # 12345</h3>
                </div>
                <hr>
                <div class="row">
                    <div class="col-xs-6">
                        <address>
                            <strong>Nama pemesan :</strong><br>
                            Reza <br>
                        </address>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
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
                                                <!-- foreach ($order->lineItems as $line) or some such thing here -->
                                                <tr>
                                                    <td>1</td>
                                                    <td class="text-center">2 Jam</td>
                                                    <td class="text-center">2 Air Mineral 1,5L & Rompi</td>
                                                    <td class="text-right">Rp.70.000</td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="alert alert-danger">
                                        <strong>Perhatian !</strong> Screenshoot resi ini sebagai bukti pembayaran dan
                                        untuk melakuan validasi admin
                                    </div>
                                </div>
</body>
</html>
