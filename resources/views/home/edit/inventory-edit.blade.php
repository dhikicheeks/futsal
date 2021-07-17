<div class="mb-3">
    <label for="barang" class="form-label">Nama Barang</label>
    <input type="text" name="id_inventory" value="{{$id_inventory}}" hidden>
    <input disabled type="text" class="form-control @error ('barang') is-invalid @enderror" id="barang" value="{{$edit->nama_barang}}"
        placeholder="Masukan barang barang" name="barang">
    @error('barang')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
<div class="mb-3">
    <label for="jumlah" class="form-label">Jumlah Barang</label>
    <input type="text" class="form-control  @error ('jumlah') is-invalid @enderror" id="jumlah" value="{{$edit->jumlah}}"
        placeholder="Masukan jumlah" name="jumlah"> @error('jumlah')
    <div class="invalid-feedback">
        {{$message}}
    </div>
    @enderror
</div>
