@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Settings') }}</div>
                <div class="card-body">
                    {{ __('Authors') }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Full Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($authors as $item)
                                <tr>
                                    <th>{{ $item->fullname }}</th>
                                    <td>
                                        <form action="{{ route("settings_delete",['type' => 'author']) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="d-none">
                                                <input type="number" name='id' value="{{ $item->id }}">
                                            </div>
                                            
                                            <button class='btn' type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
                        {{ $authors->links() }}
                    {{ __('Add author') }} 
                    <form action="{{ route("settings_add",['type' => 'author']) }}" method='POST'>
                        @csrf
                        <div class="form-group row">
                            <label for="fullname" class="col-md-4 col-form-label text-md-right">{{ __('FullName') }}</label>

                            <div class="col-md-6">
                                <input id="fullname" type="text" class="form-control  @error('fullname') is-invalid @enderror" name="fullname" required>
                                @error('fullname')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="d-none">
                                <input type="text" value='author'>
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                    {{ __('Genres') }}
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">Name</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($genres as $item)
                                <tr>
                                    <th>{{ $item->name }}</th>
                                    <td>
                                        <form action="{{ route("settings_delete",['type' => 'genre']) }}" method="POST">
                                            @csrf
                                            @method('delete')
                                            <div class="d-none">
                                                <input type="number" name='id' value="{{ $item->id }}">
                                            </div>
                                            
                                            <button class='btn' type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{ $genres->links() }}
                    {{ __('Add genre') }} 
                    <form action="{{ route("settings_add",['type' => 'genre']) }}" method='POST'>
                        @csrf
                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control  @error('name') is-invalid @enderror" name="name" required>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                            <div class="d-none">
                                <input type="text" value='author'>
                            </div>
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Create') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection