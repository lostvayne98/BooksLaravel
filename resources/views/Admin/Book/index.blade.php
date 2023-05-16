@extends('layouts.app')

@section('content')

    <section class="content">
        <div class="container-fluid">
            <div class="">
                <div class="col-25">
                    <div class="card">

                        {{--<div class="card-header">
                            <h3 class="card-title">{{$title ?? ''}}</h3>
                        </div>--}}
                        <div class="card-body">

                            <div id="example1_wrapper" class="dataTables_wrapper dt-bootstrap4">
                                <div class="row">
                                    <div class="col-sm-12 col-md-6">
                                        <div class="dt-buttons btn-group flex-wrap">
                                            <div class="btn-group">
                                                {{--<a href="{{route('users.create')}}" class="btn btn-primary btn-sm">Добавить пользователя</a>--}}
                                                <a href="{{route('book.create')}}" class="btn btn-primary btn-sm">Добавить
                                                    книгу</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example1_filter" class="dataTables_filter">
                                            {{--<form method="get" action="search">
                                                <label>
                                                    Поиск:
                                                    <input id="s" name="s" type="search" class="form-control form-control-sm" placeholder="Например: 'ivanov'" aria-controls="example1">
                                                </label>
                                            </form>--}}
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-12">
                                        <table id="example1"
                                               class="table table-bordered table-striped dataTable dtr-inline"
                                               aria-describedby="example1_info">
                                            <thead>
                                            @component('Admin.components.tableNames')
                                            @endcomponent

                                            </thead>
                                            <tbody>

                                            @foreach($model as $book)
                                                <tr>
                                                    <td>    <a href="{{route('book.show',$book->id)}}">  {{$book->id}}  </a>    </td>
                                                    <td class="text-center">
                                                        <img src="{{asset('/storage/covers/'.$book->cover)}}"
                                                             style="opacity: .8" width="60" height="60"
                                                             class="img-bordered-sm img-circle"
                                                             alt="User Image">
                                                    </td>
                                                    <td>{{$book->title}}</td>

                                                    <td>{{$book->author}}</td>

                                                    <div class="btn-group">
                                                        <a href="{{route('book.show',[$book->id])}}" class="btn btn-default"><i class="fas fa-eye"></i></a>

                                                    </div>



                                                    <td>
                                                        <form action="{{route('book.destroy',$book->id)}}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="btn btn-danger">Удалить</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>

                                        </table>

                                    </div>
                                </div>


                                <div class="row">
                                    <div class="col-sm-12 col-md-5">

                                    </div>
                                    <div class="col-sm-12 col-md-7">
                                        <div class="dataTables_paginate paging_simple_numbers"
                                             id="example1_paginate">
                                            <ul class="pagination">
                                                {{$model->links()}}
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
        </div>
    </section>

@endsection
