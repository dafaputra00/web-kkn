<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index()
    {
        $terbaru = Post::latest()->first();
        return view('index')
            ->with('terbaru', $terbaru);
    }
}
