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
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$pesan->nama_tim}}</td>
                <td>{{$pesan->tanggal_pesan}}</td>
                <td>{{$pesan->jam_pesan}}</td>
                <td>{{$pesan->paket}}</td>
            </tr>
            @endforeach
            </tbody>
    </table>