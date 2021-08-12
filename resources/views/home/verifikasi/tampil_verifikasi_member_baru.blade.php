
    <table class="table table-hover table-responsive" id="search-verifikasi-member">
        <thead>
            <tr>
                
                {{-- <th scope="col">Nama Member</th>
                <th scope="col">Tanggal Pesan</th> --}}
                {{-- <th scope="col">Paket</th> --}}
                {{-- <th scope="col">Status</th> --}}
                <th scope="col">Bukti Transfer</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($member as $mb)

            <tr>
                {{-- <td>{{$mb->name}}</td>
                <td>{{$mb->created_at}}</td>
                <td>4</td>
                <td>{{$mb->status_deskripsi}}</td> --}}
                <td>
                    <img src="{{asset('/bukti_resi/'.$mb->bukti_tf)}}" alt=""    width="60%" class="fancybox" data-fancybox="detailimage">
                </td>
                <input type="text" id="id_user_member" name="id_user_member" value="{{ $mb->id_user_member }}" hidden>
            </tr>
            @endforeach
        </tbody>
    </table>

    
<style type="text/css">
.fancybox:hover{
    cursor: pointer;
    filter: brightness(80%);
}
</style>