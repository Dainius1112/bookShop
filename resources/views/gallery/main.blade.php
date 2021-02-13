@extends('layouts.app')

@section('content')
    @foreach ($books->chunk(5) as $chunk)
        <div class="row">
            <div class="col-1"></div>
                @foreach ($chunk as $item)
                    <div class="col-2">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="..." alt="Card image cap">
                            <div class="card-body">
                              <h5 class="card-title">{{ $item->title }}</h5>
                              <p class="card-text">{{ $item->description }}</p>
                              <a href="#" class="btn btn-primary">Go somewhere</a>
                            </div>
                        </div>
                    </div>  
                @endforeach
            <div class="col-1"></div>
        </div>
    @endforeach
    
@endsection