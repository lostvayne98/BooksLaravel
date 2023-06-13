@extends('layouts.app')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Редактирование книги Книги</h3>
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
        <form action="{{route('book.update',$model->id)}}" method="POST" enctype="multipart/form-data">
            @method('PUT')
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Наименование</label>
                    <input type="text" name="title" class="form-control" placeholder="name" value="{{$model->title}}" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Автор</label>
                    <input type="text" name="author" class="form-control" placeholder="author" value="{{$model->author}}" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Slug</label>
                    <input type="text" name="slug" class="form-control" placeholder="slug" value="{{$model->slug}}" >
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Описание</label>
                    <textarea  name="description" class="form-control"  >{{$model->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Картинка</label>
                    <img src="{{ asset('/storage/covers/' . $model->cover) }}" class="img-fluid rounded mb-3">
                    <input type="file" name="cover" class="form-control" >
                </div>
                @if(!empty($data))

                    <div class="form-group" id="category-container">
                        <label for="exampleInputEmail1">Категория</label>
                    @if($data->isNotEmpty())
                        <select name="category_id[]" required>
                            @forelse($data as $category)
                                <option value="{{$category->id}}">
                                    {{$category->title}}
                                </option>
                            @empty
                                Сначала создайте категорию

                            @endforelse
                        </select>
                    @else
                        <div>
                            Вам нужно создать категорию
                        </div>
                    @endif

                @else
                <div>Вам нужно создать категории</div>
                @endif
            </div>
            <button type="button" class="btn btn-secondary" id="add-category">Add Category</button>


    </div>

    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
    </form>
    </div>

    <script>
        $(document).ready(function() {
            $('#add-category').click(function() {
                $('<div class="input-group mt-2"><select name="category_id[]" class="form-control">@foreach($data as $category)<option value="{{$category->id}}">{{$category->title}}</option>@endforeach</select><div class="input-group-append"></div></div>').appendTo('#category-container');
            });

        });
    </script>
@endsection
