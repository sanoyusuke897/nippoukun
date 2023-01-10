<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\Dailies;
use App\Models\Draft;
use App\Models\Report;
use Illuminate\Support\Facades\Date;

class CreateCompleteController extends Controller
{
    public function index(Request $request, Draft $drafts, Report $reports)
    {
        $daily = new Dailies();
        $daily->user_id = $request->user_id;
        $daily->created_at = $request->created_at;
        $daily->report = $request->report;
        $daily->clocking = $request->clocking;
        $daily->save();

        $drafts = auth()->user()->drafts;
        $drafts->each->delete();

        // $date = $request->input('dateyear', 'datemonth', 'dateday');
        // $fputs = implode(",", $date);

        // dd($fputs);

        $reports->user_id = $request->user_id;
        $reports->daily_id = $daily->id;
        $reports->report = "1";
        $reports->created_at = $request->created_at;
        $reports->save();

        return view('create_complete', compact('daily', 'drafts','reports'));
    }
}
