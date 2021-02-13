<?php

namespace App\Http\Controllers;

use App\Models\genres;
use App\Models\authors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class SettingsController extends Controller
{
    public $info = [
        'author' => [
            'model' => 'App\Models\authors',
            'field' => 'fullname',
        ],
        'genre' => [
            'model' => 'App\Models\genres',
            'field' => 'name',
        ]
    ];

    public function index()
    {
        $authors = authors::paginate(5,['*'],'authorPage');
        $genres = genres::paginate(5,['*'],'genrePage');

        return view('settings.main',['authors' => $authors,'genres' => $genres]);
    }
    public function store(string $type,Request $request){

        $info = $this->info[$type];
        if(empty($info)){
            return Redirect::back();
        }
        
        $field = $info['field'];
        
        $model = $info['model'];
        
        $request->validate([
            $field => 'required|max:200'
        ]);
            
        $model::create([
            $field => $request->$field
        ]);
        
        return Redirect::back();
    }
    public function destroy(string $type,Request $request){
        
        $info = $this->info[$type];
        
        if(empty($info)){
            return Redirect::back();
        }
        $model = $info['model'];

        $model::destroy($request->id);
    
        return Redirect::back();
    }

}
