@extends('layouts.app')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создание Комментария</h3>
        </div>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{route('user.comment.store',$book->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Название</label>
                    <input type="text" name="title" class="form-control" placeholder="name" value="{{old('title')}}" required>
                </div>

                <div class="form-group">
                    <label for="exampleInputEmail1">Описание</label>
                    <textarea  name="comment" class="form-control" placeholder="description"  required></textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Описание</label>
                    <input type="number" name="rating" class="form-control"  value="{{old('rating')}}" required>
                </div>

            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>


@endsection
