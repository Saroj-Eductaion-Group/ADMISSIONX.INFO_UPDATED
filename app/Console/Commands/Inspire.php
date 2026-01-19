<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Foundation\Inspiring;
use DB;

class Inspire extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'inspire';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Display an inspiring quote';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $getAllListObj  = DB::table('city')->orderBy('id', 'DESC')->get();
        $count =0;
        foreach (array_chunk($getAllListObj,100) as $totalList ) {
            echo "List ". $count++;
            foreach ($totalList as $key => $value) {
                $slugUrl = preg_replace('/[^A-Za-z0-9-]+/', '-', $value->name);
                $slugUrl = strtolower($slugUrl);
                DB::statement(DB::raw("UPDATE city SET pageslug='".$slugUrl."' WHERE id=".$value->id.""));
            }
        }
        echo('city slug has been updated'); die;

        $this->comment(PHP_EOL.Inspiring::quote().PHP_EOL);
    }
}
