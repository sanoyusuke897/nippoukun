<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\User;
class TemplateCreateController extends Controller
{
    public function index()
    {
        $users=User::all();
        return view('template_create',compact('users'));
    }
}
