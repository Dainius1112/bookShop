<?php

namespace App\Models;

use App\Models\genres;
use App\Models\authors;
use App\Models\book_scores;
use App\Models\book_author;
use App\Models\book_comments;
use App\Models\file_uploads;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class books extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','title','description','price','discount','file_upload_id','Approved'];

    public function author()
    {
        return $this->hasManyThrough(authors::class,book_author::class,'book_id','id','id','author_id');
    }
    
    public function authorIds()
    {
        return $this->hasMany(book_author::class,'book_id','id');
    }
    
    public function genre()
    {
        return $this->hasManyThrough(genres::class,book_genre::class,'book_id','id','id','genre_id');
    }

    public function image(){
        return  $this->hasOne(file_uploads::class,'id','file_upload_id');
    }
    
    public function score(){
        return  $this->hasMany(book_scores::class,'book_id','id');
    }

    public function comment(){
        return  $this->hasMany(book_comments::class,'book_id','id')->join('users','users.id','user_id')->select('book_comments.*','name')->latest();
    }
    public function getCost(){
        $price = $this->price/100;
        if($this->discount){
            $price = $price * (100 - $this->discount) / 100;
        }
        return round($price,2);
    }
}
