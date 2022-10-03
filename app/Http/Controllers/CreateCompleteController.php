<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\Dailies;
use App\Models\Draft;
class CreateCompleteController extends Controller
{
    public function index(Request $request, Draft $drafts)
    {
        $daily = new Dailies();
        $daily->user_id = $request->user_id;
        $daily->report = $request->report;
        $daily->clocking = $request->clocking;
        $daily->save();

        $drafts = auth()->user()->drafts;
        $drafts->each->delete();

        return view('create_complete', compact('daily', 'drafts'));
    }
}
