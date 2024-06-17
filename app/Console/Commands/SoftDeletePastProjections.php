<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\MovieRoom;
use Carbon\Carbon;

class SoftDeletePastProjections extends Command
{
    // Nome e descrizione del comando
    protected $signature = 'projections:soft-delete-past';
    protected $description = 'Soft delete past movie projections';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $now = Carbon::now();
        $pastProjections = MovieRoom::where('date', '<', $now)->get();

        foreach ($pastProjections as $projection) {
            $projection->delete();
        }

        $this->info('Past projections have been soft deleted successfully.');
    }
}



// protected function schedule(Schedule $schedule)
// {
//     $schedule->command('projections:soft-delete-past')->daily();
// }

// protected function commands()
// {
//     $this->load(__DIR__.'/Commands');

//     require base_path('routes/console.php');
// }
