<?php

namespace App\Console\Commands;
use App\Models\Report;
use App\Models\User;
use DateTime;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
class WriteLog extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stamping';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'stamping a daily-report record in reports table';

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

        //logger('test');
        //$id = auth()->user()->id;
        //$id = Auth::id();
        //$ids = User::pluck('id');

        //$ids = DB::table('users')->pluck('id');
        //$report = new Report();

        $ids = User::pluck('id'); //idの値だけを取得する

        foreach ($ids as $id) {

        $report = Report::insert([
            ['user_id' => $id , 'daily_id' => 0, 'report' => 0, 'created_at'=> new DateTime(), 'updated_at'=>new DateTime()]
        ]);
        }

        // $ids = User::pluck('id');
        // $items = ['user_id' => $id , 'daily_id' => 0, 'report' => 0, 'created_at'=> new DateTime(), 'updated_at'=>new DateTime()];

        // foreach ($items as $key =>$val) {

        // $report = Report::insert([

        // ]);
        // }



        //Log::debug($ids);
    }
}
