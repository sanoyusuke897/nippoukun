<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
class TemplateEditController extends Controller
{
    public function index(Template $template)
    {
        return view('template_edit', compact('template'));
    }
}
