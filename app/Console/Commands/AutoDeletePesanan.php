<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class AutoDeletePesanan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'hapuspesanan:delete';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Hapus Pesanan yang tidak jadi DP';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
       $hour_now = Carbon::now('Asia/Jakarta')->format('H');
    //     $time_now = Carbon::now('Asia/Jakarta')->format('H:i:s');
    //     $date_now = Carbon::now('Asia/Jakarta')->format('Y-m-d');
    //     $date_now_3 = date('Y-m-d', strtotime("-3 day", strtotime(date("Y-m-d"))));
    //     $date_now_7 = date('Y-m-d', strtotime("-7 day", strtotime(date("Y-m-d"))));
    //     $date_now_30 = date('Y-m-d', strtotime("-30 day", strtotime(date("Y-m-d"))));
    //     $date_now_30a = date('Y-m-d', strtotime("+30 day", strtotime(date("Y-m-d"))));
    //     $date_time_now = Carbon::now('Asia/Jakarta');

        // $pesanan = DB::table('pesanan')
        //                 ->select(
        //                             '*'
        //                         )
        //                 ->get();
        // foreach ($pesanan as $data) {
        //     $status = [
        //                     'status' => 1,
        //                     'jumlah' => 0,
        //                     'jumlah_harga' => 0
        //                 ];
        //     $update = DB::table('troli')
        //                 ->where('created_at', '<', $date_now_30)
        //                 ->update($status);


        DB::table('pesanan')
                ->WHERE('flag_status',1 AND 'created_at','>=',$hour_now)->delete();
    }
}
