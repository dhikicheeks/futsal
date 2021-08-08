<div class="container">
<table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class=" text-center">Nama Tim</th>
                <th scope="col" class=" text-center">Tanggal</th>
                <th scope="col" class=" text-center">Melakuan Pembayaran</th>
                <th scope="col" class=" text-center">Paket</th>
                <th scope="col" class=" text-center">Harga</th>
                <th scope="col" class=" text-center">Bukti DP</th>

                @foreach($pesanan as $pesan)
            <tr>
                <input type="text" hidden value="{{$pesan->id_non_member}}" name="id_non_member">
                <td class="text-uppercase">{{$pesan->nama_tim}}</td>
                <td class="">{{ \Carbon\Carbon::parse($pesan->tanggal_pertandingan)->format('d/m/Y')}}</td>
                <td class="text-center">{{ \Carbon\Carbon::parse($pesan->updated_at)->format('d/m/Y H:i')}}</td>
                {{-- <td class="text-center">{{$pesan->deskrip}}</td> --}}
                {{-- <td class="text-center">{{$pesan->harga}}</td> --}}
                <td class="text-center"><img src="{{ asset('/bukti_resi/'.$pesan->bukti_tf) }}" alt="" width="60%" class="fancybox" data-fancybox="detailimage"></td>
            </tr>
            @endforeach
            </tbody>
    </table>
</div>


<style type="text/css">
.fancybox:hover{
    cursor: pointer;
    filter: brightness(80%);
}
</style>