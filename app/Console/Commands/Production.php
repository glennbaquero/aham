<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Production extends BaseCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'aham:prod';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'CLEAR DATABASE AND SEED DATA';

    /**
     * Command to run
     * @return void
     */
    protected function start()
    {
        if (!file_exists('public/storage')) {
            $this->call('storage:link');
        }
        
        $this->call('migrate:fresh');
        $this->call('db:seed', [
            '--class' => 'ProductionSeeder'
        ]);

        $this->call('search:refresh');
    }
}
