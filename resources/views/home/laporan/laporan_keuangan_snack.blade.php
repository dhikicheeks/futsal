@extends('layouts.stisla')

@section('title','Laporan Keuangan Snack')
@section('section-header','Laporan Keuangan Snack')
@section('content')


<div class="row">
    <div class="form-group">
        <select name="nama_snack" id="nama_snack" class="form-control">
            <option selected disabled value="">PILIH SNACK</option>
            <option value="">SEMUA</option>
            @foreach ($laporan_keuangan_snack as $sn)
            <option value="{{$sn->nama_snack}}">{{$sn->nama_snack}}</option>
            @endforeach
        </select>
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
            <button onclick="filterSnack()" class="badge bg-primary text-light"><i class="fas fa-filter mx-1"></i>Filter</button>
        </div>
    </div>
    
</div>
<button onclick="window.print()" class="btn btn-primary mb-3"><i class="fas fa-print mx-1"></i>Cetak Laporan</button>
<div id="refresh">
    <table class="table table-hover" id="search-keuangan-snack">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Snack</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Jumlah Masuk</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Jumlah Keluar</th>
                <th scope="col">Terakhir Diupdate</th>
                <th scope="col">Tanggal Hapus</th>
                <th scope="col">Pendapatan</th>
            
            </tr>
        </thead>
        <tbody>
            <?php 
                $omset = 0;
                ?>
            @foreach($laporan_keuangan_snack as $sn)
            <tr>
                <td scope="row">{{$loop->iteration}}</td>
                <td>{{$sn->nama_snack}}</td>
                <td>{{ \Carbon\Carbon::parse($sn->tanggal_ditambahkan)->format('d-M-y')}}</td>
                <td>{{$sn->harga_beli}}</td>
                <td>{{$sn->harga_jual}}</td>
                <td>{{$sn->jumlah_masuk}}</td>
                <td>{{ \Carbon\Carbon::parse($sn->tanggal_keluar)->format('d-M-y')}}</td>
                <td>{{$sn->jumlah_keluar}}</td>
                <td>{{ \Carbon\Carbon::parse($sn->tanggal_update)->format('d-M-y H:i')}}</td>
                <td>{{$sn->tanggal_dihapus ? \Carbon\Carbon::parse($sn->tanggal_dihapus)->format('d-M-y'):null}}</td>
                <td>{{$sn->jumlah_keluar*$sn->harga_jual}}</td>
                <?php 
                    $omset += $sn->jumlah_keluar*$sn->harga_jual;
                ?>
               
            </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-light">
            <tr>
                <td class="font-weight-bold font-italic" colspan="10">OMSET</td>
                <td class="font-weight-bold">{{ $omset }}</td>
            </tr>
          
        </tfoot>
    </table>
</div>

<script>
    function filterSnack()
    {
        var nama_snack = $('#nama_snack').val();
        var tanggal1 = $('#tanggal1').val();
        var tanggal2 = $('#tanggal2').val();
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/filter_snack')}}";
        var formData = {
                    '_token': token, 
                    'nama_snack': nama_snack,
                    'tanggal1': tanggal1,
                    'tanggal2': tanggal2
                  };
        $.ajax({
              method: 'POST',
              url: my_url,
              data: formData,
            //   dataType: 'json',
              success: function(resp){
                  $('#refresh').html(resp);
                
              },
                  error: function (resp){
                        console.log(resp);
                      }

            });
    }
</script>
@endsection
