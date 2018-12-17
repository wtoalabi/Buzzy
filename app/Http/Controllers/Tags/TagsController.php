<?php

namespace App\Http\Controllers\Tags;

use App\Http\Resources\Tags\TagsCollection;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index(){
      $tags = Tag::all()->unique('tag');
      return new TagsCollection($tags);
    }
}
