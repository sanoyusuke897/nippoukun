<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\Template;
use App\Models\Dailies;
use App\Models\Draft;

class CreateController extends Controller
{
    public function index()
    {
        $templates = auth()->user()->templates;
        $drafts = auth()->user()->drafts->count();
        return view('create', compact("templates", "drafts"));
    }

    public function draft_save(Request $request)
    {

        $draft = new Draft;
        $draft->user_id = auth()->user()->id;
        $draft->report = $request->report;
        $draft->clocking = $request->clocking;

        $draft->save();

        return response()->json([$draft]);
    }

    public function draft_add(Request $request)
    {
        $drafts = auth()->user()->drafts;
        $drafts = Draft::orderBy('drafts.created_at','desc')->get();
        return response()->json($drafts);
    }

    public function draft_delete(Request $request, Draft $draft)
    {
        //$draft = Draft::find($request->input('user_id'));
        $draft->query()->where('user_id', '=', $request->input('user_id'))->delete();
        // Draft::find($request->input('user_id'))->delete();
        return response()->json($draft);
    }

    public function copy_create(Request $request, Dailies $daily)
    {

        $templates = auth()->user()->templates;
        $drafts = auth()->user()->drafts->count();

        return view('copy_create', compact("templates", "drafts", "daily"));

    }
}
