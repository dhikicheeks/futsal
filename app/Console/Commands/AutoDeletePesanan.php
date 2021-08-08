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
    protected $signature = 'AutoDeletePesanan:delete';

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
        DB::table('jadwal_pertandingan')
                ->WHERE('flag_status', 1)
                ->WHERE('created_at','>=',$hour_now)
                ->delete();
    }
}
