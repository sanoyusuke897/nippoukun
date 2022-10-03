<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Draft;
class DraftController extends Controller
{
    public function index(Request $request, $id)
    {

    $drafts = auth()->user()->drafts;

    return view('draft')->with('drafts', $drafts);
    }


}
