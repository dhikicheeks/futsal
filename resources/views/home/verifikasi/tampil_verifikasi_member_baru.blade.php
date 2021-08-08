
    <table class="table table-hover" id="search-verifikasi-member">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Bukti Transfer</th>
                <th scope="col">Name</th>
                <th scope="col">Tanggal Pesan</th>
                <th scope="col">Paket</th>
                <th scope="col">Status</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($member as $mb)
                
            <tr>
                <th scope="row">1</th>
                <td>
                    <img src="{{asset('/bukti_resi/'.$mb->bukti_tf)}}" width="100">
                </td>
                <td>{{$mb->name}}</td>
                <td>{{$mb->created_at}}</td>
            
                <td>4</td>
                <td>{{$mb->status_deskripsi}}</td>
                <input type="text" id="id_user_member" name="id_user_member" value="{{ $mb->id_user_member }}" hidden>
            </tr>
            @endforeach
        </tbody>
    </table>