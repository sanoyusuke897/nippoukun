<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
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
        $current_month = date('m');
        $dailies = Dailies::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', $current_month)->latest()->get();

        //$current_year = date('Y年m月の提出履歴');
        //dd($current_year);
        //$select_months = ['12','11','10','09','08','07','06'];
        //dd($select_months);

        return view('list', compact("dailies"));
    }

    public function list_default(Request $request)
    {
        $month = $request->input('month');
        $dailies = Dailies::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', $month)->get();

        return response()->json(['dailies' => $dailies]);
    }

    public function list_date(Request $request)
    {

        $date = $request->input('date'); //202212
        $pieces = explode("-", $date);
        //Log::debug($pieces);
        //dump($date);
        //$dailies = Dailies::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', $date)->dd();
        $dailies = Dailies::query()
            ->where('user_id', auth()->user()->id)
            ->whereYear('created_at', $pieces[0])
            ->whereMonth('created_at', $pieces[1])
            ->get();

        //Log::debug($dailies);c

        //②年と月、それぞれ検索をかける
        //③where like 先頭の文字が当てる

        return response()->json(['dailies' => $dailies]);
    }
}
