<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
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
        $users=User::all();

        $departmentusers = User::all();
        return view('home', compact('departmentusers','users'));
    }

    public function home_default(Request $request)
    {
        $reports = Report::query()->where('user_id', auth()->user()->id)->whereMonth('created_at', '◯')->get();

        return response()->json(['reports' => $reports]);
    }

}
