<div class="container">
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="">Nama Tim</th>
                <th scope="col" class="">Tanggal</th>
                <th scope="col" class="">Jam</th>
                <th scope="col" class="">Peket</th>
                <th scope="col" class="">Harga Paket</th>
                <th scope="col" class="">Biaya Tambahan</th>
                <th scope="col" class="">Tambahan Rompi</th>

                @foreach($pesanan as $pesan)
            <tr>
                <input type="text" hidden value="{{$pesan->id_non_member}}" name="id_non_member">
                <td>{{$pesan->nama_tim}}</td>
                 <td>{{ \Carbon\Carbon::parse($pesan->tanggal)->format('d-M-y')}}</td>
                <td>{{ \Carbon\Carbon::parse($pesan->jam)->format('H:i')}}</td>
                <td>{{$pesan->nama_paket}}</td>
                <td>{{$pesan->harga}}</td>
                <td>{{$pesan->biaya_tambahan}}</td>  
                <td>{{$pesan->tambahan_rompi}}</td>  
            </tr>
            @endforeach
            </tbody>
    </table>
</div>