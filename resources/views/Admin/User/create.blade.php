@extends('layouts.app')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Создание Сотрудника</h3>
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
        <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <input type="text" name="name" class="form-control" placeholder="name" value="{{old('name')}}" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">email</label>
                    <input type="text" name="email" class="form-control" placeholder="admin@mail.ru" value="{{old('email')}}" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Пароль</label>
                    <input type="password" name="password" class="form-control"  value="{{old('password')}}" required>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Подтверждение пароля</label>
                    <input type="password" name="password_confirmation" class="form-control"  value="{{old('password')}}" required>
                </div>


            </div>

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
@endsection
