
@if(request()->is('admin/book'))
<th>{{ __('ID') }}</th>
<th>{{ __('Фото') }}</th>
<th>{{ __('Название Книги') }}</th>
<th>{{ __('Имя Автора') }}</th>
@elseif(request()->is('admin/category'))
    <th>{{ __('ID') }}</th>
    <th>{{ __('Название') }}</th>
    <th>{{ __('Slug') }}</th>
@elseif(request()->is('admin/users'))
    <th>{{ __('ID') }}</th>
    <th>{{ __('Имя') }}</th>
    <th>{{ __('Email') }}</th>

@endif
