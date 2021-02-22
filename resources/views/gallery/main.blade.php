@extends('layouts.app')

@section('content')
    @foreach ($books->chunk(5) as $chunk)
        <div class="row">
            <div class="col-1"></div>
                @foreach ($chunk as $item)
                    <div class="col-2">
                        <div class="card" style="width: 18rem;">
                            <img class="card-img-top" src="{{ asset(str_replace('public','storage',$item->image->path)) }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{{ $item->description }}</p>
                                <p class="card-text">Cost: {{ $item->getCost() }} Eur</p>
                                <p class="card-text">Disccount: {{ $item->discount }} %</p>
                                {{ $item->created_at }}
                                @if ($item->created_at > now()->addWeeks(-1))
                                    <p class="card-text">New book</p>
                                @endif
                                @if (!$item->Approved)
                                    <a href="{{ route('approve_book',['id' => $item->id]) }}" class="btn btn-warning">{{ __("Approve this book") }}<a> <br><br>
                                @endif
                                <a href="{{ route('book_view',['id' => $item->id]) }}" class="btn btn-primary">{{ __('View book') }}</a>
                            </div>
                        </div>
                    </div>  
                @endforeach
            <div class="col-1"></div>
        </div>
    @endforeach
    {{ $books->links() }}
@endsection