<table class="table table-hover" id="search-keuangan-futsal">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama</th>
                <th scope="col">Tanggal Pertandingan</th>
                <th scope="col">Jam Pertandingan</th>
                <th scope="col">Tanggal Divalidasi</th>
                <th scope="col">Status Pesanan</th>
                <th scope="col">User</th>
                <th scope="col">Harga Total</th>
                <th scope="col" class="text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            <?php 
              $batal_transaksi = 0;
              $selesai_transaksi = 0;
              $total_pesanan = 0;
              $harga = 0;  
            ?>
            @foreach ($filter_keuangan_futsal as $row)
            <tr>
                <?php
                    if ($row->paket == 0) {
                      $harga =  ($row->harga+$row->biaya_tambahan+$row->tambahan_rompi)/5;
                    }
                    else {
                      $harga =  $row->harga+$row->biaya_tambahan+$row->tambahan_rompi;
                    }
                    if ($row->flag_status == 5) {
                        $batal_transaksi = $jml_batal_transaksi*20000;
                    }
                    else {
                        $selesai_transaksi += $harga;
                    }
                    $total_pesanan = $batal_transaksi+$selesai_transaksi;
                    
                ?>
                <th scope="row">{{$loop->iteration}}</th>
                <td>
                    @if ($row->paket == 0)
                        {{ $row->nama_member }}
                    @else
                        {{ $row->nama_non_member }}
                    @endif
                </td>
                <td>{{ \Carbon\Carbon::parse($row->tanggal)->format('d-M-y')}}</td>
                <td>{{ \Carbon\Carbon::parse($row->jam)->format('H:i')}}</td>
                <td>{{ \Carbon\Carbon::parse($row->updated_at)->format('d/m/Y H:i')}}</td>
                <td>
                    <h3 @if ($row->flag_status==4)
                        class="badge bg-success text-light text-center"
                        @endif class="badge bg-danger text-light sm"
                        >{{$row->deskripsi}}</h3>
                </td>
                <td>
                    @if($row->paket == 0)
                        <h3 class="badge bg-info text-light text-center">MEMBER</h3>
                    @else
                        <h3 class="badge bg-warning text-light sm">NON MEMBER</h3>
                    @endif
                </td>
                <td>
                    @if($row->flag_status != 5) 
                    {{$row->harga+$row->biaya_tambahan+$row->tambahan_rompi}}
                    @else 
                    20000
                    @endif
                </td>
                <td class="text-center">
                        <button onclick="detail_keuangan_futsal({{$row->jadwal}})" class="badge bg-primary text-light">Detail</button>
                </td>
            </tr>
            @endforeach
        </tbody>
        
        <tfoot class="bg-light">
            <tr>
                <td class="font-weight-bold font-italic" colspan="8">BATAL TRANSAKSI</td>
                <td>{{ $batal_transaksi }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold font-italic" colspan="8">SELESAI PESANAN</td>
                <td>{{ $selesai_transaksi }}</td>
            </tr>
            <tr>
                <td class="font-weight-bold font-italic" colspan="8">TOTAL</td>
                <td>{{ $total_pesanan }}</td>
            </tr>
        </tfoot>
    </table>