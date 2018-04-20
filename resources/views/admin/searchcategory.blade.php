@foreach($categorys as $category)
    <tr class="tr{{ $category->id }}">
        <td>{{ $category->id }}</td>
        <td><a href="/admin/category/{{$category->id}}">{!! $category->name !!}</a></td>
        <td>{{ $category->created_at->diffForHumans() }}</td>
        <td>{{ $category->updated_at->diffForHumans() }}</td>
        <td>
            <a href="/admin/category/{{$category->id}}" class="btn btn-xs btn-info">show</a>

            <button class="btn btn-xs btn-warning"  data-id="{{ $category->id }}">edit</button>
            <button class="btn btn-xs btn-danger"  data-id="{{ $category->id }}">delete</button>

        </td>
    </tr>
@endforeach