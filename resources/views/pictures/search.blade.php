@extends('layout')

@section('search')

    @foreach($pictures as $picture)
        <p id='foreach'>{{$picture->picture_name}}</p>
        <p>{{$picture->id}}</p>
    @endforeach
@endsection