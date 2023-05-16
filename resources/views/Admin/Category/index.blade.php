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
                                                <a href="{{route('category.create')}}" class="btn btn-primary btn-sm" style="margin-bottom: 10px">Добавить
                                                    категорию</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-12 col-md-6">
                                        <div id="example1_filter" class="dataTables_filter">

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
                                            @foreach($model as $category)
                                                <tr>
                                                    <td>    <a href="{{route('category.edit',$category->id)}}">  {{$category->id}}  </a>    </td>

                                                    <td>{{$category->title}}</td>

                                                    <td>{{$category->slug}}</td>
                                                    <td>
                                                        <form action="{{route('category.destroy',$category->id)}}" method="POST">
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

