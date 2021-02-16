@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <img src="{{ $book->image->path }}" alt="">
                    <div class="card-header">{{ __('Book ' . $book->title) }}</div>
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
                                <input type='number' name='score'>
                                
                                <button class='btn' type="submit">Create/update score</button>
                            </form>
                        @endif
                        <p>{{ __("Comments") }}</p>
                        <div class="container justify-content-center mt-5 border-left border-right">
                            @foreach ($book->comment as $item)
                                <div class="d-flex justify-content-center py-2">
                                    <div class="second py-2 px-2"> <span class="text1">{{ $item->comment }}</span>
                                        <div class="d-flex justify-content-between py-1 pt-2">
                                            <div><span class="text2">{{ $item->User->name }} Date {{ $item->created_at }}</span></div>
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
                                <textarea  name='comment'></textarea>
                                
                                <button class='btn' type="submit">Create comment</button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection