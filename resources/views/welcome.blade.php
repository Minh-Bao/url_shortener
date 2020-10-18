@extends('layouts.master')

@section('content')
        <h1>Minimize your URL</h1>
        
        <form method="POST">
            {{ csrf_field() }}
            <input type="text" name="url" placeholder="Enter your original URL" value="{{ old('url') }}">
            {!! $errors->first('url', '<p class="error-msg">:message</p>') !!}
        </form>
@endsection