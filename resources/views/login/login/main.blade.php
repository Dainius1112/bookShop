@extends('layout.layout')

@section('content')
    <form action="{{ route('login') }}" method="post">
        <div>
            <label for="email">El. paštas</label>
            <input type="mail" name='email'>
        </div>
        <div>
            <label for="password">Slaptažodis</label>
            <input type="password" name='password'>
        </div>
        {{-- {!! Form::submit($text, [$options]) !!} --}}
    </form>
    labas
@endsection