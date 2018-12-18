<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Symbol extends Model
{
    protected $hidden = ['updated_at'];
    protected $fillable = ['description_id','symbol'];
}
