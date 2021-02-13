<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class book_author extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['book_id','author_id'];


}
