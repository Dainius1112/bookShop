<?php

namespace App\Models;

use App\Models\genres;
use App\Models\authors;
use App\Models\book_author;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class books extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title','description','price','discount','file_path'];

    public function author()
    {
        return $this->hasManyThrough(authors::class,book_author::class);
    }

    public function genres()
    {
        return $this->hasManyThrough(genres::class,book_genre::class);
    }
    public function labas(){
        dd('ate');
    }
}
