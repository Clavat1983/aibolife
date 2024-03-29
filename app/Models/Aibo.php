<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aibo extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }

    public function aibocomments(){
        return $this->hasMany('App\Models\AiboComment');
    }

    public function diaries(){
        return $this->hasMany('App\Models\Diary');
    }

    public function behaviors(){
        return $this->hasMany('App\Models\BehaviorShare');
    }
}
