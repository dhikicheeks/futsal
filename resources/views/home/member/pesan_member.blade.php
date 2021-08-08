<form method="POST" action="/inputpesanan_member">
                        @csrf
                        {{-- <div class="form-group">
                            <label for="tang">Nama Pemesan</label>
                            <input type="text" class="form-control  @error ('pemesan') is-invalid @enderror"
                                placeholder="Nama Pemesan" name="pemesan" value="{{old('pemesan')}}">
                            @error('pemesan')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div> --}}
                        <div class="form-group ">
                            <label for="tang">Nama Tim</label>
                            <input type="text" class="form-control @error ('nama_tim') is-invalid @enderror"
                                placeholder="Nama Tim" name="nama_tim" value="{{old('nama_tim')}}">
                            @error('nama_tim')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tang">Tanggal</label>
                            <input type="date" class="form-control @error ('tanggal') is-invalid @enderror" id="tanggal"
                                placeholder="Pilih tanggal" name="tanggal" value="" {{old('tanggal')}}>
                            @error('tanggal')
                            <div class="invalid-feedback">
                                {{$message}}
                            </div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="tang">Jam</label>
                            <select name="jam" class="form-control @error ('jam') is-invalid @enderror" id="jam"
                                value="{{old('jam')}}">
                                @error('jam')
                                <div class="invalid-feedback">
                                    {{$message}}
                                </div>
                                @enderror
                                <option selected disabled value="">Pilih Jam Mulai</option>
                                <option value="08:00">08:00</option>
                                <option value="09:00">09:00</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                </div>
                {{-- <div >
                    <div class="alert alert-warning">
                        <strong>Perhatian !</strong> Diatas Jam <strong> 17.00 </strong> biaya tambahan
                        <strong>Rp20.000</strong> untuk
                        lampu
                    </div>
                </div> --}}
                <div class="float-right">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                    <button hidden type="submit" class="btn btn-primary" id="submit_pesan">Pesan</button>
                    <button type="button" class="btn btn-primary" onclick="cekPesanan()">Pesan</button>
                </div>
                </form>