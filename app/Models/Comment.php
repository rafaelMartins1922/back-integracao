<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['text','user_id','book_id'];
    use HasFactory;

    public function book(){
        return $this->belongsTo('App\Models\Book');
    }

    public function user(){
        return $this->belongsTo('App\Models\Book');
    }
}
