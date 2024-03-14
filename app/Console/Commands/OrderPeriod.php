<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class OrderPeriod extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'order:period';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check order periods and terminate the finished orders';

    /**
     * Execute the console command.
     */
    public function handle()
    {

    }
}
