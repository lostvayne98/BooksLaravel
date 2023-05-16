@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-4">
                <img src="{{ asset('/storage/covers/' . $book->cover) }}" class="img-fluid rounded mb-3">
            </div>
            <div class="col-md-8">
                <h2 class="mb-3">{{ $book->title }}</h2>
                <p class="text-muted"><strong>Автор:</strong> {{ $book->author }}</p>
                <p>{{ $book->description }}</p>
                <hr>
                <div class="row">
                    <div class="col-md-6">
                        <p class="text-muted"><strong>Дата публикации:</strong> {{ $book->created_at->format('d M Y') }}</p>
                    </div>
                    <div class="col-md-6">
                        <p class="text-muted"><strong>Рейтинг:</strong> {{ $book->rating}}</p>
                    </div>

                    <div class="col-md-6">
                        <p class="text-muted"><strong>Slug:</strong> {{ $book->slug}}</p>
                    </div>



                        <div class="col-md-6">
                            <p class="text-muted">
                                <a href="{{route('user.comment.create',$book->id)}}">Написать коментарий</a>

                            </p>
                        </div>


                    @can('view',auth()->user())
                        <div class="col-md-6">
                            <a href="{{route('book.edit',$book->id)}}">
                                <button class="btn btn-success">Редактировать Книгу</button>
                            </a>
                        </div>
                    @endcan

                    <hr>
                    <h4>Категории</h4>

                    @forelse($book->categories as $category)

                        <div class="col-md-6">
                            <p class="text-muted"><strong>Название:</strong> {{ $category->title}}</p>
                        </div>
                    @empty
                    Нет категорий

                    @endforelse

                </div>
                <hr>
                <h4>Комментарии</h4>
                @forelse($book->comments as $comment)
                <div class="card mb-3">
                    <div class="card-body">
                        <h5 class="card-title">{{$comment->title}}</h5>
                        <p class="card-text">{{$comment->comment}}</p>
                        <p class="card-text"><small class="text-muted">Опубликовано {{$comment->user->name}} {{$comment->updated_at->format('d M Y')}}</small></p>
                        <p class="card-text"><small class="text-muted">Оценка {{$comment->rating}} </small></p>
                    </div>
                    @can('updateComment',$comment)
                        <a href="{{route('user.comment.edit',$comment->id)}}" class="btn btn success">Редактировать комментарий</a>

                        <form action="{{route('user.comment.destroy',$comment->id)}}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-danger">Удалить комментарий</button>
                        </form>

                    @endcan
                </div>
                @empty
                Комментарии отсутствуют
                @endforelse
            </div>
        </div>
    </div>

@endsection
