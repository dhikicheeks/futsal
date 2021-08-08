@extends('layouts.stisla')

@section('title','Verifikasi Pembayaran Member')
@section('section-header','Verifikasi Pembayaran Member')
@section('content')


<table class="table table-hover" id="search-verifikasi-member">
    <thead>
        <tr>
            <th scope="col">No</th>
            <th scope="col">Name</th>
            <th scope="col">Tanggal Pesan</th>
            <th scope="col">Paket</th>
            <th scope="col">Status</th>
            <th scope="col" class="text-center">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($member as $mb)
            
        <tr>
            <th scope="row">1</th>
            <td>{{$mb->name}}</td>
            <td>{{$mb->created_at}}</td>
           
            <td>{{$mb->paket}}</td>
            <td>{{$mb->status_deskripsi}}</td>
            
            <td class="text-center">
                <a class="badge bg-primary text-light" onclick="verifikasiMember({{ $mb->id_user_member }})">Verifikasi</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
<!-- Contoh Modal -->
<div class="modal fade modal-lg" id="modalSaya" tabindex="-1" role="dialog" aria-labelledby="modalSayaLabel"
            aria-hidden="true" data-backdrop="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <form action="/verifikasi_admin" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="modalSayaLabel">Verikasi Pembayaran Member</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="refresh_member">

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

