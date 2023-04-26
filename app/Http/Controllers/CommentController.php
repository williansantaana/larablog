<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Request $request)
    {
        return Comment::where('user_id', $request['user_id']);
    }

    public function store(Request $request)
    {
        $input = $request->validate([
            'content' => 'required|string'
        ]);

        return Comment::create($input);
    }
}
