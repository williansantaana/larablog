<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function index(): Collection
    {
        return Tag::all();
    }

    public function store(Request $request)
    {
        $input = $request->validate(['name' => 'required|string']);
        return Tag::create($input);
    }
}
