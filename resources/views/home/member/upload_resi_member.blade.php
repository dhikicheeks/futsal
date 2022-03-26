@extends('layouts.stisla')

@section('title','Upload Bukti TF')
@section('section-header','Upload Bukti Transakasi Member')
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

<button
@foreach ($member as $item)
    @if ($item->flag_status != 3 && $item->flag_status != 6 || $item->metode_pembayaran == 3)
        hidden
    @endif
@endforeach
class="btn btn-primary btn btn-success mb-3"  data-toggle="modal" data-target="#upload_bukti_member"><i class="fas fa-cloud-upload-alt mx-1"></i>Upload Bukti</button>
<table class="table table-hover" id="search-verifikasi-member">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Tanggal Pesan</th>
            <th scope="col" class="text-center">Jam Pesan</th>
            <th scope="col" class="text-center">Nama Tim</th>
            <th scope="col" class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
 @foreach ($member as $member_upload)
        <tr>
            <th scope="row" class="text-center">{{$loop->iteration}}</th>
            <td class="text-center">{{ \Carbon\Carbon::parse($member_upload->tanggal_pertandingan)->format('d-M-y')}}</td>
            <td class="text-center">{{ \Carbon\Carbon::parse($member_upload->jam_pertandingan)->format('H:i')}}</td>
            <td class="text-center">{{$member_upload->nama_tim}}</td>
            <td class="text-center">
                    <h3 @if ($member_upload->flag_status==4)
                        class="badge bg-success text-light text-center"
                        @endif class="badge bg-danger text-light sm"
                        >{{$member_upload->status_deskripsi}}</h3>
                </td>
        </tr>
           @endforeach
    </tbody>
</table>


<!-- Contoh Modal -->
<div class="modal fade" id="upload_bukti_member" tabindex="-1" role="dialog" aria-labelledby="upload_bukti_memberLabel" aria-hidden="true"
    data-backdrop="false">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <form method="POST" action="/uploadtfmember" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="upload_bukti_memberLabel">Upload Bukti Transfer</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <input type="file" name="foto_resi" id="foto_resi">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
                    <button type="submit" class="btn btn-success">Upload</button>

                </div>
            </form>
        </div>
    </div>
</div>
@endsection
