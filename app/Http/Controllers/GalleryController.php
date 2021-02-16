<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\genres;
use App\Models\authors;
use App\Models\book_genre;
use App\Models\book_author;
use App\Models\book_comments;
use App\Models\book_scores;
use App\Models\file_uploads;
use Illuminate\Http\Request;
// use Intervention\Image\Image;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {   
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $books = books::query();
        $books->when($request->search,function($q,$value){
            return $q->where('title','LIKE',"%{$value}%")
                ->orWhere('description','LIKE',"%{$value}%");
        });
        $books->when(!Auth::user() || !Auth::user()->IsAdmin,function($q,$value){

            return $q->where('Approved','=',1);
        });
        return view('gallery.main',['books'=>$books->paginate(25),'count' => $books->count()]);
    }

    public function view(int $id){
        
        $book = books::find($id);
        return view('gallery.view',['book'=>$book]);
    }

    public function add_book(){
        if(!Auth::check()){
            return redirect()->route('home');
        }
        $authors = authors::all();
        $genres = genres::all();

        return view('gallery.actions.add',['authors' => $authors,'genres' => $genres]);
    }

    public function store(Request $request){
        
        $request->validate([
            'title' => 'required|string|max:200',
            'description' => 'required',
            'price' => 'required|numeric',
            'discount' => 'required|numeric',
            'file_path' => 'required|file',
            'authors' => 'required|array',
            'genres' => 'required|array',
        ]);
        
        $img = Image::make($request->file_path)->resize(300,200)->encode('jpg');

        $now = Carbon::now()->toDateTimeString();   

        $hash = md5($img->__toString().$now);

        Storage::put("/public/image/{$hash}.jpg",$img);

        $file = file_uploads::create([
            'name' => $request->file_path->getClientOriginalName(),
            'extension' => 'jpg',
            'path' => "/storage/image/{$hash}.jpg"
        ]);

        $book = books::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'file_upload_id' => $file->id,
            'user_id' => Auth::user()->id
        ]);

        foreach($request->authors as $author){
        
            book_author::create([
                'book_id' => $book->id,
                'author_id' => $author
            ]);
        }

        foreach($request->genres as $genre){
            book_genre::create([
                'book_id' => $book->id,
                'genre_id' => $genre
            ]);
        }

        return redirect()->route('gallery');
    }
    public function approve(int $id){
        if(!Auth::user()->IsAdmin){
            return redirect()->route('gallery');
        }
        books::find($id)->update(['Approved'=>true]);
        return redirect()->route('book_view',['id'=>$id]);
    }
    public function createComment(Request $request){

        $request->validate([
            'comment' => 'string',
            'id' => 'integer'
        ]);

        book_comments::create([
            'comment' => $request->comment,
            'book_id' => $request->id,
            'user_id' => Auth::user()->id,
        ]);

        return redirect()->route('book_view',['id'=>$request->id]);
    }
    public function createUpdateScore(Request $request){
        $request->validate([
            'book_id' => 'integer',
            'score' => 'integer|min:0|max:5'
        ]);

        book_scores::updateOrCreate([
            'user_id' => Auth::user()->id,
            'book_id' => $request->id
        ],[
            'score' => $request->score,
            'user_id' => Auth::user()->id,
            'book_id' => $request->id
        ]);
        return redirect()->route('book_view',['id'=>$request->id]);
    }
}
