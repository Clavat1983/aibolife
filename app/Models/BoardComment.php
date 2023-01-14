<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BoardComment extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }

    public function board(){
        return $this->belongsTo('App\Models\Board');
    }
}
