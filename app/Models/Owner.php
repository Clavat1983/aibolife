<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Owner extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function aibos(){
        return $this->hasMany('App\Models\Aibo');
    }

    public function diarycomments(){
        return $this->hasMany('App\Models\DiaryComment');
    }
}
