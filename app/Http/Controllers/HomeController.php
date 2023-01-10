<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\User;
use App\Models\Dailies;
use App\Models\Report;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $date = date('Y-m-d', strtotime('monday this week'));
        //$dailies = Dailies::all();

        //dd($date);

        //事業企画部のreports//



        //-------------------------------------//

        //$mydepartment = auth()->user()->department;

        $user1=User::where('id',auth()->id())->get();
        //dd($user1);

        $user2=User::where('id','!=',auth()->id())->get();
        //dd(auth()->id());
        //dd($user2);

        $userall = collect()->merge($user1)->merge($user2);
        //dd(collect($userall));

        $userdepartments = collect($userall)->groupBy('department')->keys();

        //dd($userdepartments);

        $departmentreports = [];



        foreach ($userdepartments as $userdepartment) {

            //dd($userdepartment);
            $reports = Report::
            select('reports.id as id', 'users.name', 'reports.report', 'reports.user_id','reports.created_at','dailies.id as did','users.department')
            ->leftjoin('dailies', 'reports.daily_id', '=', 'dailies.id')
            ->leftjoin('users', 'reports.user_id', '=', 'users.id')
            ->whereDate('reports.created_at', '>=', $date)
            ->where('users.department', $userdepartment)
            ->get();

            $departmentreports[$userdepartment] = $reports->groupBy('name');

        };


        //---------------GroupByする方法---------------//
        $reportstest = Report::
            select('reports.id as id', 'users.name', 'reports.report', 'reports.user_id','reports.created_at','dailies.id as did','users.department')
            ->leftjoin('dailies', 'reports.daily_id', '=', 'dailies.id')
            ->leftjoin('users', 'reports.user_id', '=', 'users.id')
            //->orderBy('reports.created_at', 'desc')
            ->whereDate('reports.created_at', '>=', $date)
            //->where('users.department', $userdepartment->department)
            ->get();

            $test=$reportstest->groupBy('department'); //←★ここ！

            //dd($test);
        //---------------GroupByする方法---------------//


        // $fruit = ['apple'=>'りんご','banana'=>'ばなな'];
        // $fruit["orange"] = "オレンジ";

        // dd($fruit);

        //dd($userdepartment);

        //dd($reportslists);

        //dd($reportslists->all());
        //dd($reports);
        //$reports = Report::query()->where('user_id', auth()->user()->id)->whereTime('created_at', '>=', strtotime('this week Monday'))->orderBy('created_at', 'desc')->limit(5)->get();

        return view('home', compact('departmentreports'));
    }

}
