@foreach($users as $user)
    <tr class="tr{{ $user->id }}">
        <td>{{ $user->id }}</td>
        <td><a href="/admin/user/{{$user->id}}">{{ $user->username }}</a></td>
        <td>{{$user->email}}</td>
        <td>{{$user->adress}}</td>
        <td>{{ $user->created_at->diffForHumans() }}</td>
        <td>{{ $user->updated_at->diffForHumans() }}</td>
        @if(Auth::user()->isadmin == 2)
            <td>
                <form action="">
                    <input type="checkbox" class="checkbox checkflag" id="check{{$user->id}}" data-id ="{{$user->id}}"
                           @if( $user->isadmin == 1 )checked
                    @elseif($user->isadmin == 0)
                            @endif
                    ><br>
                </form>
            </td>
            <td>
                <button class="btn btn-xs btn-danger"  data-id="{{ $user->id }}">delete</button>
            </td>
        @endif
    </tr>
@endforeach