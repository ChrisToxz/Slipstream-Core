<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
{
    public function show($tag)
    {
        $tag = Tag::findByTag($tag);

        return view('showMedia')->with(['tag'=>$tag]);
    }
}
