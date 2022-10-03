<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;

class DailyController extends Controller
{
    public function index()
    {
        return view('daily');
    }
}
