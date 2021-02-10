@extends('layout.layout')

@section('content')
    @if (session('status'))
    {{ session('status') }}
    @endif
    <form action="{{ route('register') }}" method="post">
        @csrf
        <div>
            <label for="name">Vardas</label>
            <input type="text" name='name' value="{{ old('name') }}"">
            @error('name')
                {{ $message }}   
            @enderror
        </div>
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
            <label for="password_confirmation">Slaptažodis kartojimas</label>
            <input type="password" name='password_confirmation'>
        </div>
        <button type="submit">Register</button>
    </form>
@endsection