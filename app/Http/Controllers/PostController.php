<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use App\Models\PostTag;
use App\Models\Tag;
use Illuminate\Contracts\Foundation\Application as ApplicationAlias;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index(Request $request): View|Application|Factory|ApplicationAlias
    {
        $category = $request->query('category');

        if ($category) {
            $posts = Post::select('posts.*')
                ->join('categories', 'categories.id', '=', 'posts.category_id')
                ->where([
                    ['categories.name', $category],
                    ['posts.active', true]
                ])
                ->paginate(12);
        } else {
            $posts = Post::where('active', true)->paginate(12);
        }

        return view('home', ['posts' => $posts]);
    }

    public function show(Request $request): View|Application|Factory|ApplicationAlias
    {
        $posts = Post::where([
            ['user_id', $request->user()->id],
            ['active', true]
        ])->paginate();

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

        $input['user_id'] = $request->user()->id;

        $file = $input['cover'];
        $path = $file->store('covers', 'public');
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

    public function edit(int $id): View|Application|Factory|ApplicationAlias
    {
        $post = Post::find($id);
        $categories = Category::all();

        return view('posts.edit', ['post' => $post, 'categories' => $categories]);
    }

    public function update(Request $request, int $id): RedirectResponse
    {
        $input = $request->validate([
            'title' => 'required|string',
            'content' => 'required|string',
            'cover' => 'mimes:jpg,bmp,png,webp',
            'category_id' => 'required|int'
        ]);

        if ($input['cover']) {
            $file = $input['cover'];
            $path = $file->store('covers', 'public');
            $input['cover'] = $path;
        }

        $post = Post::find($id);
        $post->fill($input);
        $post->save();

        $tags_list = [];

        foreach ($request['tags'] as $tag_name) {
            $tag = Tag::firstOrCreate(['name' => $tag_name]);

            if ($tag['id']) {
                PostTag::firstOrCreate([
                    'post_id' => $post['id'],
                    'tag_id' => $tag['id']
                ]);

                $tags_list[] = $tag['id'];
            }
        }

        PostTag::where('post_id', $id)->whereNotIn('tag_id', $tags_list)->delete();

        return Redirect::route('posts.get', $id);
    }

    public function delete(int $id): RedirectResponse
    {
        $post = Post::find($id);
        $post->fill(['active' => false]);
        $post->save();

        return Redirect::route('posts.show');
    }
}
