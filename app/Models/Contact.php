<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;

    protected $fillable = [
        'category',
        'title',
        'body',
        'name',
        'email',
    ];

    public function owner(){
        return $this->belongsTo('App\Models\Owner');
    }
}
