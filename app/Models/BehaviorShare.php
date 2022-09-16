<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BehaviorShare extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function aibo(){
        return $this->belongsTo('App\Models\Aibo');
    }
}
