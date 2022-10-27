<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\Dailies;
use Carbon\Carbon;

class ListController extends Controller
{
    public function index()
    {
        //$dailies = auth()->user()->dailies;
        //$dailies = Dailies::orderBy('created_at','desc')->get(); //all();はありえない where条件
        //$dailies = auth()->user()->dailies;
        $dailies = Dailies::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', '10')->latest()->get();


        return view('list', compact("dailies"));
    }

    public function list_default(Request $request)
    {
        $month = $request->input('month');
        $dailies = Dailies::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', $month)->get();

        return response()->json(['dailies' => $dailies]);
    }

    public function list_month(Request $request)
    {
        $month = $request->input('month');
        $dailies = Dailies::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', $month)->get();

        $date = Carbon::today();
        $dailies->$date;


        return response()->json(['dailies' => $dailies, $date]);
    }
}
