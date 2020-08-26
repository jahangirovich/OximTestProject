<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Category;

class updateCategory extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:category {id} {name} {parent_id?}';

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
        $parent_id = $this->argument('parent_id');
        $name = $this->argument('name');
        $category = Category::find($this->argument('id'));
        if (is_null($category)){
            $this->error('id does not exist');
            return;
        }
        if (is_null($parent_id)){
            $this->error('id can not be null');
            return;
        }
        $category->name=$name;
        $category->parent_id=$parent_id;
        $category->save();
        $this->info('Succesfully changed!');
    }
}
