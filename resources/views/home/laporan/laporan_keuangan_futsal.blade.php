@extends('layouts.stisla')

@section('title','Laporan Keuangan Futsal')
@section('section-header','Laporan Keuangan Futsal')
@section('content')



<div class="row">
    <div class="col-3">
        <div class="form-group mb-3">
            <select name="status" id="status" class="form-control">
                <option selected disabled value="">PILIH USER</option>
                <option value="0">SEMUA</option>
                <option value="1">MEMBER</option>
                <option value="2">NON MEMBER</option>
            </select>
        </div>
    </div>
    <div class="col-3">
        <div class="input-group mb-3">
            <input type="date" class="form-control" id="tanggal1">
        </div>
    </div>
    <div class="col-3">
        <div class="input-group mb-3" z>
            <input type="date" class="form-control" id="tanggal2">
        </div>
    </div>
    <div class="col-2 mt-2">
        <div class="">
            <button onclick="filtertanggalfutsal()" class="badge bg-primary text-light"><i class="fas fa-filter mx-1"></i>Filter</button>
        </div>
    </div>
</div>
            <button onclick="window.print()" class="btn btn-primary mb-3"><i class="fas fa-print mx-1"></i>Cetak Laporan</button>

<div class="row" id="refresh">
    <table class="table table-hover table-responsive" id="search-keuangan-futsal">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Pertandingan</th>
                <th scope="col">Jam Pertandingan</th>
                <th scope="col">Tanggal Divalidasi</th>
                <th scope="col">Status Pesanan</th>
                <th scope="col">User</th>
                <th scope="col">Harga Total</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
              $batal_transaksi = 0;
              $selesai_transaksi = 0;
              $total_pesanan = 0;
              $harga = 0;  
            ?>
            @foreach ($pesanan as $row)
            <tr>
                <?php
                    if ($row->paket == 0) {
                      $harga =  ($row->harga+$row->biaya_tambahan+$row->tambahan_rompi)/5;
                    }
                    else {
                      $harga =  $row->harga+$row->biaya_tambahan+$row->tambahan_rompi;
                    }
                    if ($row->flag_status == 5) {
                        $batal_transaksi = $jml_batal_transaksi*20000;
                    }
                    else {
                        $selesai_transaksi += $harga;
                    }
                    $total_pesanan = $batal_transaksi+$selesai_transaksi;
                    
                ?>
                <th scope="row">{{$loop->iteration}}</th>
                <td class="text-uppercase">
                    @if ($row->paket == 0)
                        {{ $row->nama_member }}
                    @else
                        {{ $row->nama_non_member }}
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-M-y')}}</td>
                <td>{{ \Carbon\Carbon::parse($row->jam)->format('H:i')}}</td>
                <td>{{ \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y H:i')}}</td>
                <td>
                    <h3 @if ($row->flag_status==4)
                        class="badge bg-success text-light text-center"
                        @endif class="badge bg-danger text-light sm"
                        >{{$row->deskripsi}}</h3>
                </td>
                <td>
                    @if($row->paket == 0)
                        <h3 class="badge bg-info text-light text-center">MEMBER</h3>
                    @else
                        <h3 class="badge bg-warning text-light sm">NON MEMBER</h3>
                    @endif
                </td>
                <td>
                    @if($row->flag_status != 5) 
                    {{$row->harga+$row->biaya_tambahan+$row->tambahan_rompi}}
                    @else 
                    20000
                    @endif
                </td>
                <td class="text-center">
                        <button onclick="detail_keuangan_futsal({{$row->jadwal}})" class="badge bg-primary text-light"><i class="fas fa-info-circle mx-1"></i>Detail</button>
                </td>
            </tr>
            @endforeach
        </tbody>
        
        <tfoot class="bg-light">
            <tr>
                <td class="font-weight-bold font-italic" colspan="8">BATAL TRANSAKSI</td>
                <td>{{ $batal_transaksi }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold font-italic" colspan="8">SELESAI PESANAN</td>
                <td>{{ $selesai_transaksi }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold font-italic" colspan="8">TOTAL</td>
                <td>{{ $total_pesanan }}</td>
            </tr>
        </tfoot>
    </table>
</div>



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
    function detail_keuangan_futsal(jadwal) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'POST',
            url: "{{url('detail_keuangan_futsal')}}",
            data: {
                '_token': token,
                'jadwal': jadwal
            },
            success: function (resp) {
                $("#refresh-keuangan-futsal").html(resp);
                $('#DetailKeuanganFutsal').modal('show');
            },
            error: function(resp){
                console.log(resp);
            }
        });
    }

    function filtertanggalfutsal() {
        var filtertanggal1 = $('#tanggal1').val();
        var filtertanggal2 = $('#tanggal2').val();
        var status = $('#status').val();
        var token = '{{csrf_token()}}';
        var myurl = "{{url('filtertanggalmaen')}}";
        var formDataFilter = {
            '_token': token,
            'tanggalfilter1': filtertanggal1,
            'tanggalfilter2': filtertanggal2,
            'status': status
        }
        $.ajax({
            method: 'post',
            url: myurl,
            data: formDataFilter,
            success: function (resp) {

                $("#refresh").html(resp);
            }
        })
    }

</script>

@endsection
