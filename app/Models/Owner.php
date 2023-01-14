<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function aibos(){
        return $this->hasMany('App\Models\Aibo');
    }

    public function aibocomments(){
        return $this->hasMany('App\Models\AiboComment');
    }

    public function diarycomments(){
        return $this->hasMany('App\Models\DiaryComment');
    }

    public function diaryreactions(){
        return $this->hasMany('App\Models\DiaryReaction');
    }

    public function boards(){
        return $this->hasMany('App\Models\Board');
    }

    public function boardcomments(){
        return $this->hasMany('App\Models\BoardComment');
    }

    public function contacts(){
        return $this->hasMany('App\Models\Contact');
    }
}
