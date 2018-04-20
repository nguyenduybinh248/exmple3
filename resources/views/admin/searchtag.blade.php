@foreach($tags as $tag)
    <tr class="tr{{ $tag->id }}">
        <td>{{ $tag->id }}</td>
        <td><a href="/admin/tag/{{$tag->id}}">{{ $tag->name }}</a></td>
        <td>{{ $tag->created_at->diffForHumans() }}</td>
        <td>{{ $tag->updated_at->diffForHumans() }}</td>
        <td>
            <a href="/admin/tag/{{$tag->id}}" class="btn btn-xs btn-info">show</a>

            <button class="btn btn-xs btn-warning"  data-id="{{ $tag->id }}">edit</button>
            <button class="btn btn-xs btn-danger"  data-id="{{ $tag->id }}">delete</button>

        </td>
    </tr>
@endforeach