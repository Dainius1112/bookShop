<?php

namespace App\Http\Controllers;

use App\Models\books;
use App\Models\genres;
use App\Models\authors;
use App\Models\book_genre;
use App\Models\book_author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    public function index()
    {
        $books = books::paginate(25);
        return view('gallery.main',['books'=>$books,'count' => $books->count()]);
    }

    public function add_book(){
        if(!Auth::check()){
            return redirect()->view('/home');
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
            'file_path' => 'required'
        ]);
        $book = books::create([
            'title' => $request->title,
            'description' => $request->description,
            'price' => $request->price,
            'discount' => $request->discount,
            'file_path' => $request->file_path,
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
}
