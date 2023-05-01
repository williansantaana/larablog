<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index(): View|Application|Factory|ApplicationAlias
    {
        $posts = Post::all();

        return view('home', ['posts' => $posts]);
    }

    public function show(Request $request): View|Application|Factory|ApplicationAlias
    {
        $posts = Post::where('user_id', $request->user()->id)->get();

        return view('posts.show', ['posts' => $posts]);
    }

    public function get(string $id): View|Application|Factory|ApplicationAlias
    {
        $post = Post::find($id);

        return view('posts.get', ['post' => $post]);
    }

    public function create(): View|Application|Factory|ApplicationAlias
    {
        $categories = Category::all();

        return view('posts.create', ['categories' => $categories]);
    }

    public function store(Request $request): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'cover' => 'required|mimes:jpg,bmp,png,webp',
            'category_id' => 'required|int'
        ]);
        $file = $input['cover'];
        $path = $file->store('covers', 'public');
        $input['user_id'] = $request->user()->id;
        $input['category_id'] = 1;
        $input['cover'] = $path;

        $post = Post::create($input);

        if ($post['id']) {
            foreach ($request['tags'] as $tag_name) {
                $tag = Tag::firstOrCreate(['name' => $tag_name]);

                if ($tag['id']) {
                    PostTag::create([
                        'post_id' => $post['id'],
                        'tag_id' => $tag['id']
                    ]);
                }
            }
        }

        return Redirect::route('posts.show');
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
