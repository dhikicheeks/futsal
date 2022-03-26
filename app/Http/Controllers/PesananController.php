<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
class PesananController extends Controller
{
     public function index()
    {
            $pesanan_non_member = DB::table("non_member")
                                ->LEFTJOIN("jadwal_pertandingan","non_member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->SELECT(
                                    'non_member.*',
                                    'jadwal_pertandingan.jam_pertandingan',
                                    'jadwal_pertandingan.flag_status',
                                    'jadwal_pertandingan.tanggal_pertandingan',
                                    'jadwal_pertandingan.nama_tim',
                                    'paket.deskripsi AS paket_deskripsi',                                 
                                    'paket.harga AS harga',                                 
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                )
                                ->WHEREIN('flag_status',[1,2])
                                ->WHERE('id_paket', '!=', 0)
                                ->GET();
                              
        // TODO MENGAMBIL DATA PAKAI UNTUK VIEW
        $paket = DB::TABLE("paket")
                    ->SELECT('*')
                    ->WHERE('id_paket', '!=', 0)
                    ->GET();
                                    //   dd($pesanan_non_member);
        return view('pesan',compact('pesanan_non_member','paket'));
  
    }

    // TODO INSERT PESANAN NON MEMBER
     public function simpan_pesanan_non_member(Request $request)
    {
         $request->validate([           
            'pemesan'=>'required',
            'nama_tim'=>'required', 
            'jam'=>'required', 
            'tanggal'=>'required',
        ]);
        $date_now = Carbon::now('Asia/Jakarta');
        $jam =  $request->jam;

        if ($jam >= '17:00') {
            $tambahan = 10000;
        } else {
            $tambahan = 0;
        }

        //TODO INPUT KE TABEL
        $id_jadwal = DB::table('jadwal_pertandingan')->insertGetId([
            'tanggal_pertandingan'=>$request->tanggal,
            'jam_pertandingan'=>$request->jam,
            'paket'=>$request->paket,
            'nama_tim'=>$request->nama_tim,
        ]);

        DB::table('non_member')->insert([
            'nama_pemesan'=>$request->pemesan,
            'biaya_tambahan'=>$tambahan,
            'created_at'=>$date_now,
            'updated_at'=>$date_now,
            'jadwal'=> $id_jadwal
        ]);
        

        //TODO AMBIL DATA UNTUK TAMPIL KE HALAMAN RESI_DP
        $ambil_data =DB::table("non_member")
                                ->LEFTJOIN("jadwal_pertandingan","non_member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->SELECT(
                                    'non_member.*',
                                    'jadwal_pertandingan.id_pertandingan',
                                    'jadwal_pertandingan.jam_pertandingan',
                                    'jadwal_pertandingan.tanggal_pertandingan',
                                    'jadwal_pertandingan.tanggal_pertandingan',
                                    'paket.deskripsi AS paket_deskripsi',                                 
                                    'paket.harga AS harga',                                 
                                    'status_pesanan.deskripsi AS status_deskripsi',                                 
                                )
            ->where('jadwal_pertandingan.tanggal_pertandingan', $request->tanggal)
            ->where('jadwal_pertandingan.jam_pertandingan', $request->jam)
            ->where('jadwal_pertandingan.paket', $request->paket)
            ->where('non_member.nama_pemesan', $request->pemesan)
            ->where('jadwal_pertandingan.nama_tim', $request->nama_tim)
            ->where('non_member.biaya_tambahan', $tambahan)
            ->where('non_member.created_at', $date_now)
            ->get();
        return view('resi-dp',compact('ambil_data'));
    }
    
    // TODO UPLOAD BUKTI DI RESI
    public function resi_transaksi_upload(Request $request)
    {   
        
       
        $foto_resi = $request->file('foto_resi');
        $id_non_member = $request->id_non_member;
        // dd($id_pesanan);
        $namaFile = uniqid('foto_resi_');
        $eksetensiFile = $foto_resi->getClientOriginalExtension();
        $namaFileBaru = $namaFile. '.' .$eksetensiFile;

        $direktoriUpload = public_path().'/bukti_resi';
        $foto_resi->move($direktoriUpload, $namaFileBaru);
        $update_now = Carbon::now('Asia/Jakarta');
        $ambildata = DB::table('non_member')
                   ->SELECT(
                    'jadwal' ,
                    )
                    ->where('id_non_member', $id_non_member)
                    ->first(); 
        $data1=[
            'bukti_tf' => $namaFileBaru,
            'updated_at'=>$update_now
        ];
        $data2=[
            'flag_status' => 2,
        ];
        DB::table('non_member')
            ->where('id_non_member', $id_non_member)
            ->update($data1);
        DB::table('jadwal_pertandingan')
            ->where('id_pertandingan', $ambildata->jadwal)
            ->update($data2);
      
        return redirect('/pesan')->with('status', 'Pesanan Anda Menunggu Verifikasi Admin');
    }

        // TODO CHECK PESANAN
        public function check_pesanan(Request $request){
        $jam = $request->jam;
        $tanggal = $request->tanggal;

        $get_duplicate = DB::table("jadwal_pertandingan")
                                        ->where('tanggal_pertandingan',$tanggal )
                                        ->where('jam_pertandingan',$jam)
                                        ->first();

        if($get_duplicate){
            return response()->json(array("exists" => true));
        }else{
            return response()->json(array("exists" => false));
        }
    }
    

    //! MEMBER

    // TODO FORM INPUT PESANAN MEMEBER
    public function detail_pesan_member()
    {
        return view('home.member.pesan_member');
    }

    // TODO INSERT PESANAN MEMBER
    public function simpan_pesanan_member(Request $request)
    {
         $request->validate([           
            'nama_tim'=>'required', 
            'jam'=>'required', 
            'tanggal'=>'required',
        ]);
        $date_now = Carbon::now('Asia/Jakarta');
        $jam =  $request->jam;
        $id_member = Auth::user()->id;

        //TODO INPUT KE TABEL
        $id_jadwal = DB::table('jadwal_pertandingan')->insertGetId([
            'tanggal_pertandingan'=>$request->tanggal,
            'jam_pertandingan'=>$request->jam,
            'paket' => 0,
            'nama_tim' => $request->nama_tim,
            // 'id_member' => $id_member
        ]);
        $id_user_member = Auth::user()->id;
        DB::table('member')->insert([
            'id_user_member' => $id_user_member,
            'created_at'=>$date_now,
            'updated_at'=>$date_now,
            'jadwal'=> $id_jadwal,
            
            
        ]);
         return redirect()->back()->with('status', 'Pesanan Ditambahkan');
    }

    //TODO CHECK MAX PESANAN
    public function cek_jumlah_pesanan(Request $request)
    {
        $user_id = $request->user_id;
        $cek_jumlah_pesanan = DB::table('member')
            ->select(
                DB::raw('count(id_user_member) as jml_pesanan')
            )
            ->where('id_user_member', $user_id)
            ->get();
        return response()->json($cek_jumlah_pesanan, 200);
    }

    // TODO CETAK RESI MEMBER
    public function resi_member(){
        $id_user_member = Auth::user()->id; 
        $ambil_data =  DB::TABLE('member')
                    ->LEFTJOIN('jadwal_pertandingan','member.jadwal','jadwal_pertandingan.id_pertandingan')
                    ->LEFTJOIN('users','member.id_user_member','users.id')
                    ->SELECT('member.*','jadwal_pertandingan.*','users.name')
                    ->WHERE('id_user_member', $id_user_member)
                    ->GET();
        // DD($ambil_data);
        $nama = DB::Table('users')
                    ->SELECT('users.name')
                     ->where('id', $id_user_member)
                     ->first();
        $metode_pembayaran = DB::table('jenis_pembayaran')
                            ->SELECT('jenis_pembayaran.*')
                            ->WHEREIN('id_pembayaran',[2,3])
                            ->GET();
        return view('home.member.resi-member',compact('ambil_data','nama','metode_pembayaran'));
    }

    // TODO UPLOAD BUKTI
    public function upload_pembayaran_member(Request $request)
    {
        
        $user_id = Auth::user()->id;
        $metode_pembayaran = $request->pembayaran_id;
        $jadwal_member = DB::table('member')
                            ->select('jadwal')
                            ->where('id_user_member', $user_id)
                            ->get();
        foreach ($jadwal_member as $key) {
            $jadwal = $key->jadwal;
                        DB::table('jadwal_pertandingan')
                            ->where('id_pertandingan', $jadwal)
                            ->update([
                            'metode_pembayaran' => $metode_pembayaran,
                            'flag_status'=> 6
            ]);
        }
        return redirect('/home');
    }

    // TODO UPDATE GANTI JADWAL MEMBER
    public function reschedule_pesanan(Request $request)
    {
        $id_jadwal = $request->id_jadwal;
        $tanggal = $request->tanggal;
        $jam = $request->jam;
        DB::table('jadwal_pertandingan')
            ->where('id_pertandingan', $id_jadwal)
            ->update([
                'tanggal_pertandingan' => $tanggal,
                'jam_pertandingan' => $jam
            ]);
         return redirect()->back()->with('reschedule', 'Reschedule berhasil');
    }

    // TODO HALAMAN BUKTI TF
    public function upload_bukti_tf_member(Request $request)
    {
       $user_id = Auth::user()->id;
       $member=  DB::table('member')
                                ->LEFTJOIN("jadwal_pertandingan","member.jadwal","jadwal_pertandingan.id_pertandingan")
                                ->LEFTJOIN("paket","jadwal_pertandingan.paket","paket.id_paket")
                                ->LEFTJOIN("status_pesanan","jadwal_pertandingan.flag_status","status_pesanan.id_status_pesanan")
                                ->SELECT(
                                    'member.*',
                                    'jadwal_pertandingan.*',                
                                    'status_pesanan.deskripsi AS status_deskripsi'                                 
                                )  
                                ->WHERE('member.id_user_member', '=', $user_id)
                                ->GET();
        // dd($member);
        return view('home.member.upload_resi_member',compact('member'));
    }

    // TODO UPLOAD BUKTI TF MEMBER
    public function uploadtfmember(Request $request)
    {
        $foto_resi = $request->file('foto_resi');
        $id_member = Auth::user()->id;
        // dd($id_pesanan);
        $namaFile = uniqid('foto_resi_');
        $eksetensiFile = $foto_resi->getClientOriginalExtension();
        $namaFileBaru = $namaFile. '.' .$eksetensiFile;

        $direktoriUpload = public_path().'/bukti_resi';
        $foto_resi->move($direktoriUpload, $namaFileBaru);
        $update_now = Carbon::now('Asia/Jakarta');
        $ambildata = DB::table('member')
                   ->SELECT(
                    'jadwal' ,
                    )
              ->where('id_user_member', $id_member)
              ->get(); 
        $data1=[
            'bukti_tf' => $namaFileBaru,
            'updated_at'=>$update_now
        ];
        $data2=[
            'flag_status' => 7,
        ];
        DB::table('member')
            ->where('id_user_member', $id_member)
            ->update($data1);
        foreach ($ambildata as $key) {
            $jadwal = $key->jadwal;
        DB::table('jadwal_pertandingan')
            ->where('id_pertandingan', $jadwal)
            ->update($data2);
        }
        return redirect()->back();
    }


    public function resi_total(){
        return view('resi_total');
    }
}