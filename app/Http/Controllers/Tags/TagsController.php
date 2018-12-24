<?php

namespace App\Http\Controllers\Tags;

use App\Http\Resources\Tags\TagsCollection;
use App\Http\Resources\WordList\ListCollection;
use App\Models\Tag;
use App\Models\Word;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagsController extends Controller
{
    public function index(){
      $tags = Tag::all()->unique('tag');
      return new TagsCollection($tags);
    }
    
    public function show($tag){
        $tag = Tag::where('slug', $tag)->first();
        return new ListCollection($tag->words);
    }
}
