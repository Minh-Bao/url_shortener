@extends('layouts.master')

@section('content')
        <h1>The Best URL Shortener from OuterSpace!!!!</h1>

        <form method="POST">
            {{ csrf_field() }}
            <input type="text" name="url" placeholder="Enter your original URL">
            <input type="submit" value="Shorten Url">
        </form>
@endsection