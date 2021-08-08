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
            <th scope="col" class="text-center">Jam Kick-Off</th>
            <th scope="col" class="text-center">Nama Pemesan</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>

        @foreach ($pelunasan as $pl)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase text-center">{{$pl->jadwal}}</td>
            <td class="text-uppercase text-center">{{ \Carbon\Carbon::parse($pl->updated_at)->format('d/m/Y H:i')}}</td>
            <td class="text-uppercase text-center">{{ \Carbon\Carbon::parse($pl->jam_pertandingan)->format('H:i')}}</td>
            <td class="text-uppercase text-center">{{$pl->nama_pemesan}}</td>
        <td><h3 class="badge bg-info text-light font-weight-bold">{{$pl->status_deskripsi}}</h3></td>
            <td><button
                
                {{-- @if ($dp->flag_status == 1)
                    hidden
                @endif  --}}
                
                onclick="detail_validasi_pelunasan({{$pl->id_non_member}})" class="badge bg-primary text-light">VERIFIKASI</button> 
                 <button onclick="batal_pemesanan({{$pl->id_non_member}})" class="badge bg-danger
                    text-light">BATAL</button>
            </td>
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

<!-- Detail Batal -->
<div class="modal fade" id="detailBatal" tabindex="-1" role="dialog" aria-labelledby="detailDPLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="/verifikasi_batal_pemesanan">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="detailDPLabel">Detail Verifikasi DP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="refreshbatal">

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
    function detail_validasi_pelunasan(id_non_member) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('detail_validasi_pelunasan')}}',
            data: {
                '_token': '{{csrf_token()}}',
                'id_non_member': id_non_member
            },
            success: function (resp) {
                $('#detailverifikasipelunasan').modal('show');
                 $("#refreshpelunasan").html(resp);
            }
        })
    }

</script>


{{-- BATAL PESANAN --}}
<script>
    function batal_pemesanan(id_non_member) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('batal_pemesanan')}}',
            data: {
                '_token': '{{csrf_token()}}',
                'id_non_member': id_non_member
            },
            success: function (resp) {
                $('#detailBatal').modal('show');
                $("#refreshbatal").html(resp);
            }
        })
    }

</script>
@endsection