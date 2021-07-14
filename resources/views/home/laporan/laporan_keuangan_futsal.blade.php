@extends('layouts.stisla')

@section('title','Laporan Keuangan Futsal')
@section('section-header','Laporan Keuangan Futsal')
@section('content')
<table class="table table-hover" id="search-keuangan-futsal">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Jam Pesan</th>
            <th scope="col">Paket</th>
            <th scope="col">Status</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($laporan_keuangan_futsal as $dp)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$dp->nama_pemesan}}</td>
            <td>{{$dp->tanggal_pesan}}</td>
            <td>{{$dp->jam_pesan}}</td>
            <td>Paket {{$dp->paket}}</td>
            <td>{{$dp->flag_status}}</td>
            <td class="text-center">
                <button onclick="detail_keuangan_futsal({{$dp->id_pesanan}})"
                    class="badge bg-primary text-light">Detail</button>
            </td>
        </tr>
        @endforeach
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
    </tbody>
</table>


<script>
    function detail_keuangan_futsal(id_pesanan) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('detail_keuangan_futsal')}}',
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
