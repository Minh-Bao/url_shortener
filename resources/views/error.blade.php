@extends('layouts.master')


@section('content')

<h1>The application return an error</h1>
    <p> Shortener not found...</p>

<a href="{{ config('app.url') }}">
   return to main page....
</a>

@endsection