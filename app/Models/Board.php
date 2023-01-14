<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }

    public function boardcomments(){
        return $this->hasMany('App\Models\BoardComment');
    }
}
