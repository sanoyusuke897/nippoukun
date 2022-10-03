<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\Dailies;
use App\Models\User;

class CreateConfirmController extends Controller
{
    public function index(Request $request)
    {

        $user = User::all();
        $daily = new Dailies();
        $daily->user_id = $request->user_id;
        $daily->report = $request->report;
        $daily->clocking = $request->clocking;

        return view('create_confirm', compact("daily","user"));
    }
}
