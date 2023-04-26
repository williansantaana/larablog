<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index(): View|Application|Factory
    {
        $posts = Post::all();

        return view('index', ['posts' => $posts]);
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
        ]);

        Post::create($input);

        return Redirect::route('user.posts');
    }

    public function update(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string'
        ]);

        $post = Post::find($input['id']);
        $post->fill($input);
        $post->save();

        return Redirect::route('user.posts');
    }

    public function delete(Request $request): RedirectResponse
    {
        $post = Post::find($request['id']);
        $post->delete();

        return Redirect::route('user.posts');
    }
}
