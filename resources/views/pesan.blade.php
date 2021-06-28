@extends('layouts.app')
@section('title','Pesan Lapangan')
@section('content')

<div class="container">
    <!-- Button trigger modal -->
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
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
                    <form>
                        <div class="form-group">
                            <label for="tang">Tanggal</label>
                            <input type="text" class="form-control" id="tanggal" placeholder="Pilih tanggal">
                        </div>
                        <div class="form-group">
                            <label for="tang">Jam</label>
                            <input type="text" class="form-control" id="jam" placeholder="Pilih jam">
                        </div>
                        <div class="form-group">
                            <label for="paket">Paket 1 Jam</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket1" value="option1"
                                    checked>
                                <label class="form-check-label" for="paket1">
                                    Paket 1 (1 jam)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Paket 2 (1 jam + 2 Air Mineral 1,5L)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Paket 3 (1 jam + 2 Air Mineral 1,5L + Rompi)
                                </label>
                            </div>
                        <div class="form-group">
                            <label for="paket">Paket 2 Jam</label>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket1" value="option1"
                                    checked>
                                <label class="form-check-label" for="paket1">
                                    Paket 1 (2 jam)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Paket 2 (2 jam + 2 Air Mineral 1,5L)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="paket" id="paket2" value="option2">
                                <label class="form-check-label" for="exampleRadios2">
                                    Paket 3 (2 jam + 2 Air Mineral 1,5L + Rompi)
                                </label>
                            </div>
                        </div>
                </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                <button type="button" class="btn btn-primary">Pesan</button>
            </div>
        </div>
    </div>
</div>

<h1 class="text-center">Jadwal Futsal Hari ini</h1>
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
