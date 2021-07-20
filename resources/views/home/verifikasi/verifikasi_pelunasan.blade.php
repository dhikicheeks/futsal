@extends('layouts.stisla')

@section('title','Validasi Pelunasan')
@section('section-header','Verifikasi Pelunasan')
@section('content')
@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

<table class="table table-hover" id="search-validasi-dp">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">No Pesanan</th>
            <th scope="col" class="text-center">Tanggal Pesan</th>
            <th scope="col" class="text-center">Jam Pesan</th>
            <th scope="col" class="text-center">Nama Pemesan</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($pelunasan as $dp)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase text-center">{{$dp->id_pesanan}}</td>
            <td class="text-uppercase text-center">{{$dp->tanggal_pesan}}</td>
            <td class="text-uppercase text-center">{{$dp->jam_pesan}}</td>
            <td class="text-uppercase text-center">{{$dp->nama_pemesan}}</td>
        <td><h3 class="badge bg-info text-light font-weight-bold">{{$dp->deskripsi}}</h3></td>
            <td><button
                
                {{-- @if ($dp->flag_status == 1)
                    hidden
                @endif  --}}
                
                onclick="detail_validasi_pelunasan({{$dp->id_pesanan}})" class="badge bg-success text-light">Verifikasi</button> 
               </td>
        </tr>
        @endforeach

        
    </tbody>
</table>

 <!-- Detail DP Modal -->
<div class="modal fade" id="detailverifikasipelunasan" tabindex="-1" role="dialog" aria-labelledby="detailverifikasipelunasanLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="/update_verifikasi_pelunasan"> 
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="detailverifikasipelunasanLabel">Detail Verifikasi Pelunasan</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="refreshpelunasan">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function detail_validasi_pelunasan(id_pesanan) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('detail_validasi_pelunasan')}}',
            data: {
                '_token': '{{csrf_token()}}',
                'id_pesanan': id_pesanan
            },
            success: function (resp) {
                $('#detailverifikasipelunasan').modal('show');
                 $("#refreshpelunasan").html(resp);
            }
        })
    }

</script>
@endsection