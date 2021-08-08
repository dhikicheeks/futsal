  <table class="table table-hover" id="search-keuangan-snack">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Snack</th>
                <th scope="col">Tanggal Masuk</th>
                <th scope="col">Harga Beli</th>
                <th scope="col">Harga Jual</th>
                <th scope="col">Jumlah Masuk</th>
                <th scope="col">Tanggal Keluar</th>
                <th scope="col">Jumlah Keluar</th>
                <th scope="col">Tanggal Hapus</th>
                <th scope="col">Pendapatan</th>
            
            </tr>
        </thead>
        <tbody>
            <?php 
                $omset = 0;
                ?>
            @foreach($laporan_keuangan_snack as $sn)
            <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$sn->nama_snack}}</td>
                <td>{{ \Carbon\Carbon::parse($sn->tanggal_ditambahkan)->format('d-M-y')}}</td>
                <td>{{$sn->harga_beli}}</td>
                <td>{{$sn->harga_jual}}</td>
                <td>{{$sn->jumlah_masuk}}</td>
                <td>{{$sn->tanggal_keluar}}</td>
                <td>{{$sn->jumlah_keluar}}</td>
                <td>{{$sn->tanggal_dihapus}}</td>
               
                <td>{{$sn->jumlah_keluar*$sn->harga_jual}}</td>
                <?php 
                    $omset += $sn->jumlah_keluar*$sn->harga_jual;
                ?>
               
            </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-light">
            <tr>
                <td class="font-weight-bold font-italic" colspan="9">OMSET</td>
                <td class="font-weight-bold">{{ $omset }}</td>
            </tr>
          
        </tfoot>
    </table>