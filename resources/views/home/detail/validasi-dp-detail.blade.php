<div class="container">
<table class="table table-striped">
        <thead>
            <tr>
                
                <th scope="col" class=" text-center">Nama Tim</th>
                <th scope="col" class=" text-center">Tanggal</th>
                <th scope="col" class=" text-center">Jam</th>
                <th scope="col" class=" text-center">Peket</th>
                <th scope="col" class=" text-center">Harga</th>
                <th scope="col" class=" text-center">Bukti DP</th>

                @foreach($pesanan as $pesan)
            <tr>
                <input type="text" hidden value="{{$pesan->id_pesanan}}" name="id_pesanan">
                <td class="text-uppercase">{{$pesan->nama_tim}}</td>
                <td class="">{{$pesan->tanggal_pesan}}</td>
                <td class="text-center">{{$pesan->jam_pesan}}</td>
                <td class="text-center">{{$pesan->deskripsi}}</td>
                <td class="text-center">{{$pesan->harga}}</td>
                <td class="text-center">{{$pesan->bukti_tf}}</td>
            </tr>
            @endforeach
            </tbody>
    </table>


</div>