<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class readProducts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'parse:products';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
        $data = file_get_contents('app/json_files/products.json');
        $parsed = json_decode($data,true);
        $this->info(json_encode($parsed));
    }
}
