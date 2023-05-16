@extends('layouts.app')
@section('content')

    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Сотруник №{{$user->id}}</h3>
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

            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Имя</label>
                    <div class="form-control">
                        {{$user->name}}
                    </div>
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">email</label>
                    <div class="form-control">
                        {{$user->email}}
                    </div>
                </div>


            </div>

            <div class="card-footer">
                <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary">Перейти в редактирование пользователя</a>
            </div>

    </div>
@endsection
