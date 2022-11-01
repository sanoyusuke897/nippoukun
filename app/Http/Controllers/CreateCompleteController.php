<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\Dailies;
use App\Models\Draft;
use App\Models\Report;
class CreateCompleteController extends Controller
{
    public function index(Request $request, Draft $drafts, Report $reports)
    {
        $daily = new Dailies();
        $daily->user_id = $request->user_id;
        $daily->report = $request->report;
        $daily->clocking = $request->clocking;
        $daily->save();

        $drafts = auth()->user()->drafts;
        $drafts->each->delete();

        $report = new Report();
        $report->user_id = $request->user_id;
        $report->daily_id = $daily->id;
        $report->report = "1";
        $report->save();

        return view('create_complete', compact('daily', 'drafts','report'));
    }
}
