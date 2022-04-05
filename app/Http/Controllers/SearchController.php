<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function searchPostBycategory(Category $category)
    {
        $posts = $category->posts()->paginate(10);
        return $posts;
    }
}
