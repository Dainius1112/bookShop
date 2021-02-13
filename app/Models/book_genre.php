<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_genre extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = ['book_id','genre_id'];

}
