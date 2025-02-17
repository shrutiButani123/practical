<?php

namespace App\Console\Commands;

use Illuminate\Console\Command; 

use App\Models\User;
use Carbon\Carbon;
// use Illuminate\Support\Facades\Log;

class DeleteOldUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete users who registered more than 20 days ago';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $date = Carbon::now()->subDays(20);
        $users = User::where('created_at', '<', $date)->delete();

        if($users){
            \Log::info('Users deleted successfully.');
        } else {
            \Log::info('No users to delete.');
        }
    }
}
