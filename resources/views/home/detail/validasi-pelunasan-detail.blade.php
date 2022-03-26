<div class="container">
    <table class="table table-striped">
        <thead>
            <tr>
                <th scope="col" class=" text-center">Nama Tim</th>
                <th scope="col" class=" text-center">DP Divalidasi</th>
                <th scope="col" class=" text-center">Paket</th>
                <th scope="col" class=" text-center">Kekurangan Pelunasan</th>
                <th scope="col" class=" text-center">Total</th>
                @foreach($pesanan as $pesan)
            <tr>
                <input type="text" hidden value="{{$pesan->id_non_member}}" id="id_non_member" name="id_non_member">
                <td class="text-uppercase">{{$pesan->nama_tim}}</td>
                <td class="">{{ \Carbon\Carbon::parse($pesan->updated_at)->format('d/m/Y H:i')}}</td>
                <td class="text-center">{{$pesan->deskripsi}}</td>
                <td class="text-center">{{$pesan->harga+$pesan->biaya_tambahan-20000}}</td>
                <td class="text-center">{{$pesan->harga+$pesan->biaya_tambahan}}</td>
            </tr>
            @endforeach

            </tbody>
    </table>
    <div class="form-group col-5">
        <label for="tang">Tambahan Rompi</label>
        <input type="text" class="form-control @error ('rompi') is-invalid @enderror" id="rompi"
            placeholder="Masukkan harga total" name="rompi" value="" {{old('rompi')}}>
        @error('rompi')
        <div class="invalid-feedback">
            {{$message}}
        </div>
        @enderror
    </div>
</div>
