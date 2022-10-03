<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facedes\Auth;
use App\Models\User;
use App\Models\Dailies;
use App\Models\Comment;
use App\Models\Like;

class DailyDetailController extends Controller
{
    public function index(Dailies $daily)
    {

        $comments = Comment::where('daily_id', $daily->id)->orderBy('created_at','desc')->get();
        $likes = Like::where('daily_id', $daily->id)->get();

        return view('daily_detail', compact("comments", "daily", "likes"));
    }

    public function daily_comment(Request $request)
    {
        $commentUser = User::find($request->input('user_id'));

        $comment = new Comment;
        $comment->user_id = auth()->user()->id;
        $comment->daily_id = $request->daily_id;
        $comment->comment = $request->comment;
        $comment->save();

        return response()->json([$comment,$commentUser]);
    }

    public function daily_like(Request $request)
    {
        $likeUser = User::find($request->input('user_id'));

        if (Like::where('daily_id', $request->input('daily_id'))->count()) {
            $like = Like::where('daily_id', $request->input('daily_id'))->first();
           } else {
            $like = new Like;
            $like->user_id = auth()->user()->id;
            $like->daily_id = $request->daily_id;
           }

        $like->like = $request->like;

        $like->save();

        return response()->json([$like,$likeUser]);
    }

    public function daily_like_delete(Request $request,Like $like)
    {
        // $like=Like::find($request->input('daily_id'));
        // dd($like);
        $like->where('daily_id', '=', $request->input('daily_id'))->delete();

        return response()->json($like);
    }

    // public function like(Request $request)
    // {
    //     return view('daily_detail')->with('daily', $daily);
    // }
}
