@extends('layouts.stisla')



<!--  ADMIN -->
@if(
Auth::user()->role_id == 90)
@section('title','Validasi DP')
@section('section-header','Verifikasi Dp')
@section('content')

<table class="table table-hover" id="search-verifikasi-member">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Pemesan</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Jam Pesan</th>
            <th scope="col">Paket</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($validasi_dp as $dp)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td>{{$dp->nama_pemesan}}</td>
            <td>{{$dp->tanggal_pesan}}</td>
            <td>{{$dp->jam_pesan}}</td>
            <td>{{$dp->paket}}</td>
            <td>{{$dp->flag_status}}</td>

            <td class="text-center">
                <button onclick="detail_validasi_dp({{$dp->id_pesanan}})" class="badge bg-primary text-light">Detail</button>
                <a href="" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>
        @endforeach
        <!-- Contoh Modal -->
        <div class="modal fade" id="detailDP" tabindex="-1" role="dialog" aria-labelledby="detailDPLabel"
            aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form method="POST" action="/">
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
    </tbody>
</table>


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


<!-- Contoh Modal -->
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
            <td>{{$inve->nama_barang}}</td>
            <td>{{$inve->jumlah}}</td>
            <td class="text-center">
                <a href="" class="badge bg-warning text-dark" data-toggle="modal" data-target="#ModalEdit">Edit</a>
                <a href="/inventory/delete/{{$inve->id_inventory}}" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- Modal Edit --}}
<div class="modal fade" id="ModalEdit" tabindex="-1" role="dialog" aria-labelledby="ModalEditLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/ory">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="modalSayaLabel">Edit Inventory</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                    <div class="mb-3">
                        <label for="barang" class="form-label">Nama Barang</label>
                        <input type="text" class="form-control @error ('barang') is-invalid @enderror" id="barang"
                            placeholder="Masukan barang barang" name="barang">
                        @error('barang')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="jumlah" class="form-label">Jumlah Barang</label>
                        <input type="text" class="form-control  @error ('jumlah') is-invalid @enderror" id="jumlah"
                            placeholder="Masukan jumlah" name="jumlah"> @error('jumlah')
                        <div class="invalid-feedback">
                            {{$message}}
                        </div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-warning">Ubah</button>

                </div>
            </form>
        </div>
    </div>
</div>


@endsection
@endif



<!-- LOGIN Member -->
@if(Auth::user()->role_id == 1)
@section('title','Validasi DP')
@section('section-header','Apa Hayo??')

@section('content')

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Nama Barang</th>
            <th scope="col">Jumlah</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>

        <tr>
            <th scope="row">1</th>
            <td>1</td>
            <td>4</td>

            <td class="text-center">
                <a href="" class="badge bg-warning text-dark">Edit</a>
                <a href="" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>

    </tbody>
</table>

@endsection
@endif
