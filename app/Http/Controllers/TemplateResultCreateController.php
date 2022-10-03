<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Template;
use App\Models\User;
class TemplateResultCreateController extends Controller
{
    public function index(Request $request)
    {
    $template = new Template();
    $template->user_id = $request->user_id;
    $template->template_title = $request->template_title;
    $template->template_content = $request->template_content;
    $template->save();

    return view('template_result', compact("template"));
    }
}
