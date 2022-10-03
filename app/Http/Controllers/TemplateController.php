<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\Template;

class TemplateController extends Controller
{
    public function index()
    {

        $templates = auth()->user()->templates;

        return view('template')->with('templates', $templates);
    }

    public function template_ajax(Request $request, $id)
    {
        $temp = new Template;
        $data = $temp->ajax($id);

        return $data;
    }
}
