<?php

namespace App\Console\Commands;

use App\Models\CronLog;
use App\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class AddScoreToUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:score';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to add score to user every day in 12:00';

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
     * @return mixed
     */
    public function handle()
    {
        $log = [];
        $users = User::select('id')->where('last_login', '>=', Carbon::now()->subWeek())->get();

        foreach ($users as $user) {
            if (is_null($user->spinner)) {
                $log[$user->id] = 1;
                $user->increment('score', 1);
            } else {
                $random = rand(1, $user->spinner->spinner->level + 1);
                $log[$user->id] = $random;
                $user->increment('score', $random);
            }
        }

        CronLog::create([
            'cron_type' => 'add score',
            'data' => json_encode($log),
        ]);
    }
}
