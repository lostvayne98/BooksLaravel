@extends('layouts.app')

@section('content')

    <form action="{{route('search')}}" method="GET">

        <input type="text" name="search">
        <button type="submit" class="btn btn-success">Найти</button>
    </form>


        @if(!empty($results['books']))
            <table>
                <tr>
                    <td>Обложка</td>
                    <td>Название книги</td>
                    <td>Автор книги</td>
                    <td>Стоимость книги</td>
                    <td>Категория</td>

                </tr>
            @forelse($results['books'] as $result)

                <tr>
                    {{-- <td>    <a href="{{route('book.show',$result['id'])}}">  {{$result['id']}}  </a>    </td>--}}
                    <td class="text-center">
                        <img src="{{asset('/storage/covers/'.$result['cover'])}}"
                             style="opacity: .8" width="60" height="60"
                             class="img-bordered-sm img-circle"
                             alt="User Image">
                    </td>
                    <td>{{$result['title']}}</td>

                    <td>{{$result['author']}}</td>

                    <td>{{$result['price']}}</td>


                    <td>
                        {{$result['categories'][0]['title']}}
                    </td>
                </tr>

            @empty


            @endforelse
        @endif



        @if(!empty($results['users']))
            <h1>Пользователи</h1>
            <table>
                <tr>
                    <td>Имя</td>
                </tr>
            @foreach($results['users'] as $user)

                <tr>
                    <td>
                        {{$user['name']}}
                    </td>
                </tr>

            @endforeach
            </table>

        @endif
    </table>

@endsection


