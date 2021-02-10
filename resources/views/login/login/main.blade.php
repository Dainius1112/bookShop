@extends('layout.layout')

@section('content')
    @if (session('status'))
        {{ session('status') }}
    @endif
    <form action="{{ route('login') }}" method="post">
        @csrf
        <div>
            <label for="email">El. paštas</label>
            <input type="mail" name='email' value="{{ old('email') }}"">
            @error('email')
                {{ $message }}   
            @enderror
        </div>
        <div>
            <label for="password">Slaptažodis</label>
            <input type="password" name='password'>
            @error('password')
                {{ $message }}   
            @enderror
        </div>
        <div>
            <input type="checkbox" name='remember' id='remember'>
            <label for="remember">Slaptažodis</label>
        </div>
        {{-- {!! Form::submit($text, [$options]) !!} --}}
        <button type="submit">Login</button>
    </form>
@endsection