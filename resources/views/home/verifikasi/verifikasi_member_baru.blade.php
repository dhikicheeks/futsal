@extends('layouts.stisla')

@section('title','Verifikasi Pembayaran Member')
@section('section-header','Verifikasi Pembayaran Member')
@section('content')


<table class="table table-hover " id="search-verifikasi-member">
    <thead>
        <tr>
            <th scope="col" class="text-center">No</th>
            <th scope="col" class="text-center">Nama Member</th>
            <th scope="col" class="text-center">Tanggal Pesan</th>
            <th scope="col" class="text-center">Paket</th>
            <th scope="col" class="text-center">Metode Pembayaran</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($member as $mb)
            
        <tr>
            <th scope="row" class="text-center">{{$loop->iteration}}</th>
            <td class="text-center text-uppercase">{{$mb->name}}</td>
            <td class="text-uppercase text-center">{{ \Carbon\Carbon::parse($mb->created_at)->format('d/m/Y')}}</td>
            <td class="text-center text-uppercase">{{$mb->metode_pembayaran}}</td>
            <td class="text-center text-uppercase"><h3 class="badge bg-warning text-light">{{$mb->status_deskripsi}}</h3></td>
            <td class="text-center text-uppercase">
                <a class="badge bg-primary text-light" onclick="verifikasiMember({{ $mb->id_user_member }})">Verifikasi</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Contoh Modal -->
<div class="modal fade" id="modalSaya" data-backdrop="false" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalSayaLabel"
        aria-hidden="true" >
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="/verifikasi_admin" method="POST">
                    @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalSayaLabel">Verikasi Pembayaran Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body " id="refresh_member">

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
    function verifikasiMember(id_user_member)
    {
        var token = '{{ csrf_token() }}';
        var my_url = "{{url('/tampil_verifikasi_member')}}";
        var formData = {
                    '_token': token, 
                    'id_user_member': id_user_member
                  };

        $.ajax({
              method: 'POST',
              url: my_url,
              data: formData,
            //   dataType: 'json',
              success: function(resp){
                  $('#refresh_member').html(resp);
                  $('#modalSaya').modal('show');
              },
                error: function (resp){
                        console.log(resp);
                      }

            });
    }
</script>
@endsection

