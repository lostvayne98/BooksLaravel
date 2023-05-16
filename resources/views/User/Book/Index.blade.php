
@extends('layouts.app')
@section('content')


    <div class="container">
        <h1>My Book List</h1>
        <ul class="list-group">
            @foreach($model as $book)
            <li class="list-group-item">
                <div class="row">

                    <div class="col-md-2">
                        <a href="{{route('user.book.show',$book->id)}}">
                        <img src="{{asset('/storage/covers/' . $book->cover)}}" alt="Book 1 Cover Image" style="width: 100px;height: 100px;">
                        </a>
                    </div>
                    <div class="col-md-8">
                        <h5 class="mb-1">{{$book->title}}</h5>
                        <small>Rating: {{$book->rating}}({{$book->comments->count()}} comments)</small>
                        <p class="mb-1">{{$book->description}}</p>
                    </div>
                    <div class="col-md-2">
                        <a href="{{route('user.book.show',$book->id)}}" class="text-end">Перейти</a>
                    </div>
                </div>
            </li>
            @endforeach

@endsection
