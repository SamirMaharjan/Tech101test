<?php

namespace App\Console\Commands;

use App\Models\RewardPoint;
use App\Models\SalesOrder;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ExpireRewards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rewards:expire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Expire rewards older than 1 year';

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
        $expirationDate = Carbon::now()->subYear();
        RewardPoint::where('created_at', '<=', $expirationDate)
            ->update(['is_active' => 0]);
       
    }
}
