@extends('layouts.stisla')



{{--========================================= ROLE ADMIN====================================== --}}
@if(
Auth::user()->role_id == 1)
@section('title','Validasi DP')
@section('section-header','Verifikasi Dp')
@section('content')

<table class="table table-hover text-center" id="search-verifikasi-member">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">No Pemesanan</th>
            <th scope="col" class="text-center">Tanggal Pesan</th>
            <th scope="col" class="text-center">Tanggal Kick-Off</th>
            <th scope="col" class="text-center">Kick-Off</th>
            <th scope="col" class="text-center">Nama Pemesan</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Verifikasi</th>
            {{-- <th scope="col" class="text-center">Batal</th> --}}
        </tr>
    </thead>
    <tbody>
        @foreach ($validasi_dp as $dp)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase text-center">{{$dp->jadwal}}</td>
            <td class="text-uppercase text-center">{{ \Carbon\Carbon::parse($dp->created_at)->format('d/m/Y H:i')}}</td>
            <td class="text-uppercase text-center">
                {{ \Carbon\Carbon::parse($dp->tanggal_pertandingan)->format('d/m/Y')}}</td>
            <td class="text-uppercase text-center">{{ \Carbon\Carbon::parse($dp->jam_pertandingan)->format('H:i')}}</td>
            <td class="text-uppercase text-center">{{$dp->nama_pemesan}}</td>
            <td>
                <h3 @if ($dp->flag_status ==1)
                    class="badge bg-warning text-light font-weight-bold"
                    @endif
                    class="badge bg-success text-light font-weight-bold" >{{$dp->status_deskripsi}}</h3>
            </td>
            <td>
                <button @if ($dp->flag_status == 1)
                    hidden
                    @endif onclick="detail_validasi_dp({{$dp->id_non_member}})" class="badge bg-primary
                    text-light"><i class="fas fa-info-circle mx-1"></i>VERIFIKASI</button>
               

        </tr>
        @endforeach
    </tbody>
</table>
<!-- Detail DP Modal -->
<div class="modal fade" id="detailDP" tabindex="-1" role="dialog" aria-labelledby="detailDPLabel" aria-hidden="true"
    data-backdrop="false">
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
    function detail_validasi_dp(id_non_member) {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('detail_validasi_dp ')}}',
            data: {
                '_token': '{{csrf_token()}}',
                'id_non_member': id_non_member
            },
            success: function (resp) {
                $('#detailDP').modal('show');
                $("#refresh").html(resp);
            }
        })
    }

</script>


{{--========================================= ROLE OWNER====================================== --}}

@if(Auth::user()->role_id == 2 )
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
  <i class="fas fa-box-open mx-1"></i>Tambah Inventory
</button>
            <button onclick="window.print()" class="btn btn-info mb-2"><i class="fas fa-print mx-1"></i>Cetak Laporan</button>


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
            <th scope="col">Di Tambahkan</th>
            <th scope="col">Perubahan Terakhir</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($inventory as $inve)
        <tr>
            <th scope="row">{{$loop->iteration}}</th>
            <td class="text-uppercase">{{$inve->nama_barang}}</td>
            <td class="text-uppercase">{{$inve->jumlah}}</td>
            <td>
                <h3 class="badge bg-warning text-light font-weight-bold">
                    {{ \Carbon\Carbon::parse($inve->created_at)->format('d/m/Y')}}</h3>
            </td>
            <td>
                <h3 class="badge bg-info text-light font-weight-bold">
                    {{ \Carbon\Carbon::parse($inve->updated_at)->format('d/m/Y H:i')}}</h3>
            </td>
            <td class="text-center">
                <button data-toggle="modal" data-target="#edit_inventory"
                    onclick="edit_inventory({{$inve->id_inventory}})" class="badge bg-success text-light">Edit</button>
                <a href="/inventory/delete/{{$inve->id_inventory}}" class="badge bg-danger text-light">Delete</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


{{-- Modal Edit iNVENTORY --}}
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
                    <button type="submit" class="btn btn-success">Simpan</button>
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
            url: '{{url('edit_inventory ')}}',
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



{{--========================================= ROLE MEMBER====================================== --}}

@if(Auth::user()->role_id == 3)
@section('title','Paket Anda')
@section('section-header','Paket Anda')

@section('content')
    @if (session('status'))
    <div class="alert alert-info">
        {{ session('status') }}
    </div>
    @elseif (session('reschedule'))
    <div class="alert alert-warning">
        {{ session('reschedule') }}
    </div>
    @endif
    <div class="alert alert-danger text-uppercase">
           <strong>Perhatian ! Reschedule H-1 booking</strong>
    </div>
    <div class="alert alert-info ">
           <strong class="text-uppercase">Harga Member Rp.350.000</strong>
           <p >5 Kali pertandingan bonus air mineral & rompi ganti jadwal sepuasnya</p>
    </div>
<button type="button" class="btn btn-primary mb-3" onclick="pesanMember()">
    <i class="fas fa-user-plus mx-1"></i>Masukan Pemesanan
</button>
<br>
<a href="{{url("/resi_member")}}" class="btn btn-success mb-3" 
@foreach ($member as $item)
    @if($item->flag_status > 2)
    hidden
    @elseif ($cek_jumlah_pesanan->jml_pesanan >= 5)
    
    @else
    hidden
    @endif
@endforeach>
    <i class="fas fa-shopping-cart"></i> Lanjut Pembayaran
</a>

<table class="table table-hover">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Tanggal Pertandingan</th>
            <th scope="col" class="text-center">Jadwal Pertandingan</th>
            <th scope="col" class="text-center">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($member as $raw)
        <tr>
            <th scope="row" class="text-center">{{$loop->iteration}}</th>
            <td class="text-center">{{ \Carbon\Carbon::parse($raw->tanggal_pertandingan)->format('d/m/Y')}}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($raw->jam_pertandingan)->format('H:i')}}</td>
            <td class="text-center"><h3 @if ($raw->flag_status == 1)
                        class="badge bg-warning text-light text-center"
                        @endif class="badge bg-success text-light sm"
                        >{{$raw->status_deskripsi}}
                    </h3></td>
            <td class="text-center">
                @if ($date_now_1 <= $raw->tanggal_pertandingan)
                    <button class="badge bg-primary text-light text-center" data-toggle="modal" data-target="#exampleModal{{$raw->jadwal}}">Ganti Jadwal</button>
                @else
                    <h3 class="badge bg-info text-light text-center">JADWAL TIDAK DAPAT DIUBAH</h3>
                @endif
                
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<div class="modal fade" tabindex="-1" id="modalPesanMember" data-backdrop="false">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Pesan Member</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="isi_pesan_member">
            </div>
            <div class="modal-footer">
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
@foreach ($member as $raw)
    <div class="modal fade" id="exampleModal{{$raw->jadwal}}" data-backdrop="false" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
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
                <form method="POST" action="/reschedule_pesanan">
                        @csrf
                        <div class="form-group">
                            <label for="tang">Tanggal</label>
                            <input type="date" class="form-control @error ('tanggal') is-invalid @enderror" id="tanggal"
                                placeholder="Pilih tanggal" name="tanggal" value="{{$raw->tanggal_pertandingan}}" {{old('tanggal')}}>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tang">Jam</label>
                            <select name="jam" class="form-control @error ('jam') is-invalid @enderror" id="jam"
                                value="{{old('jam')}}">
                                @error('jam')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <option selected disabled value="">{{ $raw->jam_pertandingan }}</option>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                </div>
                <input type="text" id="id_jadwal" name="id_jadwal" value="{{ $raw->jadwal }}" hidden>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button hidden type="submit" class="btn btn-primary" id="reschedule">Pesan</button>
                    <button type="button" class="btn btn-primary" onclick="cekReschedule()">Pesan</button>
                </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<input type="text" name="user_id" id="user_id" value="{{ Auth::user()->id }}" hidden>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    function cekPesanan() {
        var tanggal = $("#tanggal").val();
        var jam = $("#jam").val();
        var token = '{{ csrf_token() }}';

        $.ajax({
            method: "POST",
            url: '{{url('check_pesanan')}}',
            data: {
                '_token': token,
                'jam': jam,
                'tanggal': tanggal
            },
            dataType: "json",
            success: function (res) {
                if (res.exists) {
                    alert("Jam Sudah Di Pesan");
                } else {
                    return cekJumlah();
                }
            },
            error: function (jqXHR, exception) {

            }
        });

    }
    function cekReschedule() {
        var tanggal = $("#tanggal").val();
        var jam = $("#jam").val();
        var token = '{{ csrf_token() }}';

        $.ajax({
            method: "POST",
            url: '{{url('check_pesanan')}}',
            data: {
                '_token': token,
                'jam': jam,
                'tanggal': tanggal
            },
            dataType: "json",
            success: function (res) {
                if (res.exists) {
                    alert("Jam Sudah Di Pesan");
                } else {
                    document.getElementById("reschedule").click();
                }
            },
            error: function (jqXHR, exception) {

            }
        });

    }

    function cekJumlah() {
        var user_id = $("#user_id").val();
        var jam = $("#jam").val();
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/cek_jumlah_pesanan')}}";
        var formData = {
                    '_token': token, 
                    'user_id': user_id
                  };

        $.ajax({
              method: 'POST',
              url: my_url,
              data: formData,
              dataType: 'json',
              success: function(data){
                $.each(data, function(i,n){
                    if(n["jml_pesanan"] >= 5){
                        alert('Maaf jumlah pesanan anda sudah melebihi batas!,Silahkan Checkout');
                        location.reload();
                    }
                    else {
                        document.getElementById("submit_pesan").click();
                  }
                });
              },
                  error: function (resp){
                        console.log(resp);
                      }

            });

    }
    
    function pesanMember() {
        var token = '{{ csrf_token() }}';
        $.ajax({
            method: 'post',
            url: '{{url('detail_pesan_member ')}}',
            data: {'_token': '{{csrf_token()}}'
            },
            success: function (resp) {
                $('#modalPesanMember').modal('show');
                $('.modal-backdrop').removeAttr('modal-backdrop');
                $("#isi_pesan_member").html(resp);
            },
            error: function (resp) {
                console.log(resp);
            }
        });
    }

</script>

@endsection
@endif