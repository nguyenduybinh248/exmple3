@foreach($posts as $post)
    <tr class="tr{{ $post->id }}  "  data-id="{{$post->id}}">
        <td class="stl-column"><img src="{{asset('')}}{{ $post->thumnails }}" width="50px" height="50px" /></td>
        <td class="stl-column">{{ $post->title }}</td>
        <td class="stl-column">{{$post->user->username}}</td>
        <td class="stl-column">{{$post->category->name}}</td>
        <td class="stl-column">{{ $post->created_at->diffForHumans() }}</td>
        <td class="stl-column">{{ $post->updated_at->diffForHumans() }}</td>
        <td class="stl-column">
            <label class="radio-inline checkflag">
                <input type="radio" name="check{{$post->id}}" value="1"
                       @if($post->flag === 1)
                       checked
                        @endif
                >
            </label>
        </td>
        <td>
            <label class="radio-inline">
                <input type="radio" name="check{{$post->id}}" value="2"
                       @if($post->flag === 2)
                       checked
                        @endif
                >
            </label>
        </td>
        <td class="stl-column">
            <button class="btn btn-xs btn-info" data-id="{{ $post->id }}" >show</button>
            <button class="btn btn-xs btn-warning"  data-id="{{ $post->id }}">edit</button>
            <button class="btn btn-xs btn-danger"  data-id="{{ $post->id }}">delete</button>

        </td>
    </tr>
@endforeach
