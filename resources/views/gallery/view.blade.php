@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{ $book->image->path }}" alt="">
                    <div class="row">
                        <div class="card-header col-6">{{ __('Book ' . $book->title) }}</div>
                        <div class="card-header col-6 row">
                            @if (Auth::user()->IsAdmin)
                                <div class="col-4">
                                    <a href="{{ route('book_edit',['id'=>$book->id]) }}" class="btn btn-primary">{{ __("Edit this book") }}<a> <br><br>
                                </div>
                                <div class="col-4">
                                    @if ($book->Approved)
                                        <a href="{{ route('approve_book',['id' => $book->id]) }}" class="btn btn-danger">{{ __("Unapprove this book") }}<a> <br><br>
                                    @else   
                                        <a href="{{ route('approve_book',['id' => $book->id]) }}" class="btn btn-warning">{{ __("Approve this book") }}<a> <br><br>
                                    @endif
                                </div>
                                <div class="col-4">
                                    <form action="{{ route("deleteBook") }}" method="POST">
                                        @csrf
                                        @method('delete')
                                        <div class="d-none">
                                            <input type="number" name='id' value="{{ $book->id }}">
                                        </div>
                                        
                                        <button class='btn btn-danger' type="submit">Delete</button>
                                    </form>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <div>
                            <p>{{ __('Description') }}</p>
                            
                            {{ $book->description }}
                        </div>
                        <div>
                            <p>{{ __("Authors") }}</p>
                            @foreach ($book->author as $item)
                                <p>{{ $item->fullname }}</p>                                
                            @endforeach
                        </div>    
                        <div>
                            <p>{{ __("Genres") }}</p>
                            @foreach ($book->genre as $item)
                                <p>{{ $item->name }}</p>                                
                            @endforeach
                        </div> 
                        <div>
                            <p>{{ __("Genres") }}</p>
                            @foreach ($book->genre as $item)
                                <p>{{ $item->name }}</p>                                
                            @endforeach
                        </div> 
                        <div>
                            <p>{{ __("Average score") }}</p>
                            <p>{{ $book->score->avg('score') }}</p>                                
                        </div> 
                        @if (Auth::user())
                        <form action="{{ route("create_update_score") }}" method="POST">
                            @csrf
                            <div class="d-none">
                                <input type="number" name='id' value="{{ $book->id }}">
                            </div>
                            <div class="form-group row">
                                <label for="score" class="col-md-4 col-form-label text-md-right">{{ __('Your score') }}</label>
    
                                <div class="col-md-6">
                                    <input id="score" type="text" class="form-control @error('score') is-invalid @enderror" name="score" value="{{ old('score') }}" required autocomplete="score" autofocus>
    
                                    @error('score')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <button class='btn btn-primary' type="submit">Create/update score</button>
                        </form>
                        @endif
                        {{-- {{ dd($errors) }} --}}
                        <p>{{ __("Comments") }}</p>
                        <div class="container justify-content-center mt-5 border-left border-right">
                            @foreach ($book->comment as $item)
                                <div class="d-flex justify-content-center py-2">
                                    <div class="second py-2 px-2"> <span class="text1">{{ $item->comment }}</span>
                                        <div class="d-flex justify-content-between py-1 pt-2">
                                            <div><span class="text2">{{ $item->name }} Date {{ $item->created_at }}</span></div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @if (Auth::user())
                            <form action="{{ route("create_comment") }}" method="POST">
                                @csrf
                                <div class="d-none">
                                    <input type="number" name='id' value="{{ $book->id }}">
                                </div>
                                <div class="form-group row">
                                    <label for="comment" class="col-md-4 col-form-label text-md-right">{{ __('Your comment') }}</label>
                                    
                                    <div class="col-md-6">
                                        <textarea  name='comment' class="form-control @error('comment') is-invalid @enderror"></textarea>
        
                                        @error('comment')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <button class='btn btn-primary' type="submit">Create comment</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection