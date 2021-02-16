<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class book_comments extends Model
{
    use HasFactory;

    protected $fillable = ['book_id','user_id','comment'];
    

    public function user(){
        return  $this->hasOne(User::class,'id','user_id');
    }
}
