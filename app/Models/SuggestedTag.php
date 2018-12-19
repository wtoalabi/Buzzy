<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SuggestedTag extends Model
{
    protected $fillable = ['user_id','tag'];
}
