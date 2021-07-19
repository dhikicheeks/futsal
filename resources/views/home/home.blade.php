@extends('layouts.stisla')



<!--  ADMIN -->
@if(
Auth::user()->role_id == 90)
@section('title','Validasi DP')
@section('section-header','Verifikasi Dp')
@section('content')

<table class="table table-hover text-center" id="search-verifikasi-member">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">No Pemesanan</th>
            <th scope="col" class="text-center">Tanggal Kick-Off</th>
            <th scope="col" class="text-center">Jam Kick-Off</th>
            <th scope="col" class="text-center">Nama Pemesan</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($validasi_dp as $dp)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase text-center">{{$dp->id_pesanan}}</td>
            <td class="text-uppercase text-center">{{$dp->tanggal_pesan}}</td>
            <td class="text-uppercase text-center">{{$dp->jam_pesan}}</td>
            <td class="text-uppercase text-center">{{$dp->nama_pemesan}}</td>
            <td><h3 class="badge bg-info text-light font-weight-bold">{{$dp->deskripsi}}</h3></td>
            <td>
                <button @if ($dp->flag_status == 1)
                    hidden
                @endif onclick="detail_validasi_dp({{$dp->id_pesanan}})" class="badge bg-success text-light">Verifikasi</button>
               
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
 <!-- Detail DP Modal -->
<div class="modal fade" id="detailDP" tabindex="-1" role="dialog" aria-labelledby="detailDPLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="POST" action="/update_verifikasi_dp"> 
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="detailDPLabel">Detail Verifikasi DP</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="refresh">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Verifikasi</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
@endif

<script>
    function detail_validasi_dp(id_pesanan) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('detail_validasi_dp')}}',
            data: {
                '_token': '{{csrf_token()}}',
                'id_pesanan': id_pesanan
            },
            success: function (resp) {
                $('#detailDP').modal('show');
                 $("#refresh").html(resp);
            }
        })
    }

</script>

<!-- LOGIN OWNER -->
@if(Auth::user()->role_id == 100 )
@section('title','Inventory')
@section('section-header','Inventory')
@section('content')


@if (session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@elseif (session('status-delete'))
<div class="alert alert-danger">
    {{ session('status-delete') }}
</div>
@endif


<button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#TambahInventory">
    Tambah Inventory
</button>


<!-- Tambah Inventory Modal -->
<div class="modal fade" id="TambahInventory" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/inputinventory">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSayaLabel">Tambahkan Inventory Baru</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error ('barang') is-invalid @enderror" id="barang"
                            placeholder="Masukan barang barang" name="barang" value="{{old('barang')}}">
                        @error('barang')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Barang</label>
                        <input type="text" class="form-control  @error ('jumlah') is-invalid @enderror" id="jumlah"
                            placeholder="Masukan jumlah" name="jumlah" value="{{old('jumlah')}}"> @error('jumlah')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<table class="table table-hover" id="search-inventory">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventory as $inve)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase">{{$inve->nama_barang}}</td>
            <td class="text-uppercase">{{$inve->jumlah}}</td>
            <td class="text-center">
                <button  data-toggle="modal" data-target="#edit_inventory" onclick="edit_inventory({{$inve->id_inventory}})" class="badge bg-success text-light">Edit</button>
                <a href="/inventory/delete/{{$inve->id_inventory}}" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- Modal Edit --}}
=
<div class="modal fade" id="edit_inventory" tabindex="-1" role="dialog" aria-labelledby="edit_inventoryLabel"
    aria-hidden="true" data-backdrop="false">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <form method="post" action="/update-inventory">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="edit_inventoryLabel">Edit Inventory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body" id="refresh-inventory">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success" >Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    function edit_inventory(id_inventory) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('edit_inventory')}}',
            data: {
                '_token': '{{csrf_token()}}',
                'id_inventory': id_inventory
            },
            success: function (resp) {
                $('#edit_inven').modal('show');
                 $("#refresh-inventory").html(resp);
            }
        })
    }

</script>


@endsection
@endif



<!-- LOGIN Member -->
@if(Auth::user()->role_id == 1)
@section('title','Paket Anda')
@section('section-header','Paket Anda')

@section('content')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Paket Anda</th>
            <th scope="col">Sisa Paket / Exp Paket</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <th scope="row">1</th>
            
            <td>4</td>
            <td>4</td>
            <td class="text-center">
                
                <button class="badge bg-primary text-light">Perpanjang</button>
            </td>
        </tr>

    </tbody>
</table>

@endsection
@endif
