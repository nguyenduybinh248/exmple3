@if(isset($posts))
    {{$posts->links()}}
    @elseif(isset($users))
    {{$users->links()}}
@elseif(isset($tags))
    {{$tags->links()}}
    @endif

