@foreach ($data_snack as $item)
<form method="POST" action="{{ url('/save_kurang_quantity_snack')}}">
    @csrf
    <div class="modal-header">
        <h5 class="modal-title" id="modalSayaLabel">Pengeluran  Snack</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    <div class="modal-body">
        <div class="mb-3">
            <label for="snack" class="form-label">Nama Snack</label>
            <input type="text" disabled class="form-control @error ('nama_snack') is-invalid @enderror" id="nama_snack"
                placeholder="Masukan Nama Snack" name="nama_snack" value="{{$item->nama_snack}}">
            @error('nama_snack')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga_beli" class="form-label">Harga Beli</label>
            <input type="text" disabled class="form-control @error ('harga_beli') is-invalid @enderror" id="harga_beli"
                placeholder="Masukan Harga Beli" name="harga_beli" value="{{$item->harga_beli}}">
            @error('harga_beli')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="harga_jual" class="form-label">Harga Jual</label>
            <input type="text" disabled class="form-control  @error ('harga_jual') is-invalid @enderror" id="harga_jual"
                placeholder="Masukan Harga Jual" name="harga_jual" value="{{$item->harga_jual}}"> @error('harga_jual')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="jumlah_keluar" class="form-label">Jumlah</label>
            <input type="text" class="form-control  @error ('jumlah_keluar') is-invalid @enderror" id="jumlah_keluar"
                placeholder="Keluar Kuantiti" name="jumlah_keluar" value="{{$item->jumlah_keluar}}"> @error('harga_jual')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>
          <input type="text" hidden id="id_snack" name="id_snack" value="{{$item->id_snack}}">
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Batal</button>
        <button type="submit" class="btn btn-success">Simpan</button>

    </div>
</form>
@endforeach
