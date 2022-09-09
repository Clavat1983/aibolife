<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diary extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function aibo(){
        return $this->belongsTo('App\Models\Aibo');
    }

    public function diarycomments(){
        return $this->hasMany('App\Models\DiaryComment');
    }

    public function diaryreactions(){
        return $this->hasMany('App\Models\DiaryReaction');
    }
}
