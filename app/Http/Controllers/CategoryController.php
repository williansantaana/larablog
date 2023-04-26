<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(): Collection
    {
        return Category::all();
    }

    public function store(Request $request)
    {
        $input = $request->validate(['name' => 'required|string']);
        return Category::create($input);
    }
}
