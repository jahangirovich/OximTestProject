<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;

class createCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:category {name} {parent_id?}';

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
        $par1=$this->argument('parent_id');
        $par2=$this->argument('name');
        $alStaff=['name'=>$par2,'parent_id'=>0];
        if (is_numeric($par1)){
            $alStaff['parent_id']=$par1;
        }
        else if(!empty($par1)){
            $this->error('parent_id should be numeric');
            return;
        }
        $category=Category::create(
            $alStaff
        );
        
        $this->info('Created');
    }
}
