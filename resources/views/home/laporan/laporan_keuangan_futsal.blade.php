@extends('layouts.stisla')

@section('title','Laporan Keuangan Futsal')
@section('section-header','Laporan Keuangan Futsal')
@section('content')


<div class="container">
    <div class="row">
        <div class="col-3">
            <div class="input-group mb-3">
                <input type="date" class="form-control">
            </div>
        </div>
        <div class="col-3">
            <div class="input-group mb-3">
                <input type="date" class="form-control">
            </div>
        </div>
        <div class="col-2">
            <div class="">
                <button class="badge bg-primary text-light">Filter</button>
            </div>
        </div>
        
    </div>
</div>


<table class="table table-hover" id="search-keuangan-futsal">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">No Pesanan</th>
            <th scope="col">Tanggal Validasi</th>
            <th scope="col">Harga</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan_keuangan_futsal as $keuangan_futsal)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$keuangan_futsal->id_pesanan}}</td>
           <td>{{ \Carbon\Carbon::parse($keuangan_futsal->updated_at)->format('d/m/Y H:i')}}</td>
            <td>{{$keuangan_futsal->harga}}</td>
            <td>
                <h3 @if ($keuangan_futsal->flag_status==3)
                    class="badge bg-danger text-light text-center"
                    @endif class="badge bg-success text-light sm"
                    >{{$keuangan_futsal->deskripsi}}</h3>
            </td>
            <td class="text-center">
                <button onclick="detail_keuangan_futsal({{$keuangan_futsal->id_pesanan}})"
                    class="badge bg-primary text-light">Detail</button>
            </td>
        </tr>
        @endforeach
    </tbody>
    <tfoot class="bg-light">
        <tr>
            <td class="font-weight-bold font-italic" colspan="5">PEMBAYARAN DP</td>
            <td class="font-weight-bold">23172371</td>
        </tr>
        <tr>
            <td class="font-weight-bold font-italic" colspan="5">SELESAI PESANAN</td>
            <td class="font-weight-bold"></td>
        </tr>
        <tr>
            <td class="font-weight-bold font-italic" colspan="5">TOTAL</td>
            <td class="font-weight-bold">23172371</td>
        </tr>
    </tfoot>
</table>
<!-- Detail Keuangan Futsal -->
<div class="modal fade" id="DetailKeuanganFutsal" tabindex="-1" role="dialog"
    aria-labelledby="DetailKeuanganFutsalLabel" aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="DetailKeuanganFutsalLabel">Detail Laporan Futsal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="refresh-keuangan-futsal">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function detail_keuangan_futsal(id_pesanan) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('
            detail_keuangan_futsal ')}}',
            data: {
                '_token': '{{csrf_token()}}',
                'id_pesanan': id_pesanan
            },
            success: function (resp) {
                $('#DetailKeuanganFutsal').modal('show');
                $("#refresh-keuangan-futsal").html(resp);
            }
        })
    }

</script>
@endsection
