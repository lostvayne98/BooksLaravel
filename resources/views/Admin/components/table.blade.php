<tbody>

@foreach($models as $model)
    <tr>
        <td>    <a href="{{route('book.show',$model->id)}}">  {{$model->id}}  </a>    </td>
        <td class="text-center">
            <img src="{{asset('/storage/covers/'.$model->cover)}}"
                 style="opacity: .8" width="60" height="60"
                 class="img-bordered-sm img-circle"
                 alt="User Image">
        </td>
        <td>{{$model->title}}</td>

        <td>{{$model->author}}</td>

        <div class="btn-group">
            <a href="{{route('book.show',[$model->id])}}" class="btn btn-default"><i class="fas fa-eye"></i></a>

        </div>

        </td>

        <td>

        </td>
    </tr>
@endforeach
</tbody>
