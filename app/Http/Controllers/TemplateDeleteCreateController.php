<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;

class TemplateDeleteCreateController extends Controller
{
    public function index(Request $request, Template $template)
    {
        $template->delete();
        return view('template_delete', compact('template'));
    }
}
