<div class="container">
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class="">No</th>
                <th scope="col" class="">Nama Tim</th>
                <th scope="col" class="">Tanggal</th>
                <th scope="col" class="">Jam</th>
                <th scope="col" class="">Peket</th>

                @foreach($pesanan as $pesan)
            <tr>
                <input type="text" hidden value="{{$pesan->id_non_member}}" name="id_non_member">
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$pesan->nama_tim}}</td>
                <td>{{$pesan->tanggal}}</td>
                <td>{{$pesan->jam}}</td>
                <td>{{$pesan->paket}}</td>
            </tr>
            @endforeach
            </tbody>
    </table>
</div>