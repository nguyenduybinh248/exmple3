<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>DuyBinh.Pro</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <script src="{{asset('js/blog/jquery-1.12.4.min.js')}}"></script>
    <link rel="stylesheet" href="{{asset('css/AdminLTE.min.css')}}">
    <link rel="shortcut icon" type="image/png" href="{{asset('img/favicon.png')}}"/>
    <!-- STYLES -->
    {{--<link rel="stylesheet" type="text/css" href="{{asset('/css/blog/bootstrap.css')}}">--}}
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="{{asset('css/blog/slippry.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/blog/fonts.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('css/blog/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/css/fileinput.min.css">
    <!-- GOOGLE FONTS -->
    <link href='https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,300,300italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Playfair+Display:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    <link href='https://fonts.googleapis.com/css?family=Sarina' rel='stylesheet' type='text/css'>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.min.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/adapters/jquery.js"></script>
    <style>
        .pagination {
            display: inline-block;
            padding-left: 0;
            margin: 20px 0;
            border-radius: 4px;
        }
        .pagination > li {
            display: inline;
        }
        .pagination > li > a, .pagination > li > span {
            position: relative;
            float: left;
            padding: 6px 12px;
            margin-left: -1px;
            line-height: 1.42857143;
            color: #337ab7;
            text-decoration: none;
            background-color: #fff;
            border: 1px solid #ddd;
        }
        .pagination > .disabled > a, .pagination > .disabled > a:focus, .pagination > .disabled > a:hover, .pagination > .disabled > span, .pagination > .disabled > span:focus, .pagination > .disabled > span:hover {
            color: #777;
            cursor: not-allowed;
            background-color: #fff;
            border-color: #ddd;
        }
        .pagination > .active > a, .pagination > .active > a:focus, .pagination > .active > a:hover, .pagination > .active > span, .pagination > .active > span:focus, .pagination > .active > span:hover {
            z-index: 3;
            color: #fff;
            cursor: default;
            background-color: #337ab7;
            border-color: #337ab7;
        }
        .pagination > li > a {
            background: #fafafa;
            color: #666;
        }
        .comment {
            font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
            background: rgba(0, 0, 0, 0);
            overflow: hidden;
            resize: none;
            padding: 13px 17px;
            position: relative;
            z-index: 100;
            width: 471px;
            font-weight: 500;
            font-size: 15px;
            margin-left: 60px;
            display: block;
            border-radius: 25px;
            outline: none;
            border: 1px solid #bec2c9;
        }
        .reply {
            font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
            background: rgba(0, 0, 0, 0);
            overflow: hidden;
            resize: none;
            padding: 13px 17px;
            position: relative;
            z-index: 100;
            width: 471px;
            font-weight: 500;
            font-size: 15px;
            margin-left: 60px;
            display: block;
            border-radius: 25px;
            outline: none;
            border: 1px solid #bec2c9;
        }
        .textareaedit {
            font-family: -apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif;
            background: rgba(0, 0, 0, 0);
            overflow: hidden;
            resize: none;
            padding: 13px 17px;
            position: relative;
            z-index: 100;
            width: 471px;
            font-weight: 500;
            font-size: 15px;
            margin-left: 60px;
            display: block;
            border-radius: 25px;
            outline: none;
            border: 1px solid #bec2c9;
        }

    </style>
</head>

<body>


<!-- *****************************************************************
** Preloader *********************************************************
****************************************************************** -->

{{--<div id="preloader-container">--}}
    {{--<div id="preloader-wrap">--}}
        {{--<div id="preloader"></div>--}}
    {{--</div>--}}
{{--</div>--}}


<div class="modal fade bd-example-modal-lg" id="add-post" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">ADD POST</h4>
            </div>
            <div class="modal-body">
                <form method="post" role="form" id="add-new" enctype="multipart/form-data">

                    <div class="form-group" id="add-title">
                        <label for="">Title</label>
                        <input type="text" class="form-control" name="title" placeholder="title" id="title">
                    </div>
                    <div class="form-group" id="add-description">
                        <label for="">Description</label>
                        <input type="text" class="form-control" name="description"  placeholder="description" id="description">
                    </div>
                    <div class="form-group" id="add-content">
                        <label for="">Content</label>
                        <textarea  class="form-control" name="contents" placeholder="content" id="content"></textarea>
                    </div>
                    <div class="portlet light bordered">
                        <div class="portlet-title">
                            <div class="caption">
                                <label for="">Category</label>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <select class="form-control" name="category_id" id="category_id">
                                @foreach ($categorys as $category)
                                    <option value="{{$category->id}}" >{{$category->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="form-group" id="add-thumnails">
                        <label for="">Thumnails</label>
                        <input type="file" class="form-control" name="thumnails" id="thumnails" onchange="readURL(this);">
                        <img class="blah" src="#" style="display: none;" />

                    </div>
                    <div class="form-group" id="add-tags">
                        <label for="">Tag</label><br>
                        <select multiple name="tags[]" id="tags" data-role="tagsinput"  ></select>

                    </div>

                    <button type="submit" class="btn btn-primary">ADD</button>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- *****************************************************************
** Header ************************************************************
****************************************************************** -->

<header class="tada-container">


    <!-- LOGO -->
    <div class="logo-container">
        <a href="index.html"><img src="{{asset('img/logo.png')}}" alt="logo" ></a>
        {{--<div class="tada-social">--}}
        {{--<a href="#"><i class="icon-facebook5"></i></a>--}}
        {{--<a href="#"><i class="icon-twitter4"></i></a>--}}
        {{--<a href="#"><i class="icon-google-plus"></i></a>--}}
        {{--<a href="#"><i class="icon-vimeo4"></i></a>--}}
        {{--<a href="#"><i class="icon-linkedin2"></i></a>--}}
        {{--</div>--}}
    </div>


    <!-- MENU DESKTOP -->
    <nav class="menu-desktop no-menu-sticky">

        <ul class="tada-menu">
            <li><a href="{{asset('/')}}" >HOME</a>
            </li>
            <li><a href="#">Category <i class="icon-arrow-down8"></i></a>
                <ul class="submenu">
                    @foreach($categorys as $category)
                        <li><a href="{{asset('').'category/'.$category->id}}">{{$category->name}}</a></li>
                    @endforeach
                </ul>
            </li>
            <li><a></a></li>

            @guest
                <li><a class="" href="{{ route('login') }}">{{ __('Login') }}</a></li>
                <li><a class="" href="{{ route('register') }}">{{ __('Register') }}</a></li>
               @else

            <li><a href="#">{{Auth::user()->username}} <i class="icon-arrow-down8"></i></a>
                <ul class="submenu">
                    <li>
                        <div  >
                            <a href="{{asset('')}}/profile/{{Auth::user()->id}}">Profile</a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a href="{{asset('user'). '/' . Auth::user()->id}}">{{Auth::user()->username}}'s posts</a>
                        </div>
                    </li>
                    <li>
                        <div>
                            <a data-toggle="modal" data-target="#add-post">Add new post</a>
                        </div>
                    </li>
                    @if(Auth::user()->isadmin === 1)
                        <li>
                            <div  >
                                <a href="{{asset('/admin')}}">Admin's site</a>
                            </div>
                        </li>
                        @elseif(Auth::user()->isadmin === 2)
                        <li>
                            <div class= >
                                <a href="{{asset('/admin')}}">Admin's site</a>
                            </div>
                        </li>
                        @endif
                    <li>
                        <div class= >
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                {{ __('Logout') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                </ul>

            </li>
                @endguest
        </ul>

    </nav>


    <!-- MENU MOBILE -->
    <div class="menu-responsive-container">
        <div class="open-menu-responsive">|||</div>
        <div class="close-menu-responsive">|</div>
        <div class="menu-responsive">
            <ul class="tada-menu">
                <li><a href="{{asset('/')}}" >HOME</a>
                </li>
                <li><a href="#">CATEGORY <i class="icon-arrow-down8"></i></a>
                    <ul class="submenu">
                        @foreach($categorys as $category)
                        <li><a href="{{asset(''). 'category/' .$category->id }}">{{$category->name}}</a></li>
                            @endforeach
                    </ul>
                </li>
                <li>
                    <div class="dropdown-menu" >
                        <a class="dropdown-item" href="{{ route('logout') }}"
                           onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
        </div>
    </div> <!-- # menu responsive container -->


    <!-- SEARCH -->
    <div class="tada-search">
        <form action="{{asset('result')}}" method="get">
            @csrf
                    <div class="form-group-search">
                        <input type="search" name="search" class="search-field" placeholder="Search " style="width: 100%">
                        <ul class="submenu" id="search_result" style="width: 100%">
                        </ul>
                    </div>
                <span class="show_result" style="display: none"></span>
        </form>
    </div>

</header><!-- #HEADER -->


<!-- *****************************************************************
** Section ***********************************************************
****************************************************************** -->

<section class="tada-container content-posts">


    <!-- CONTENT -->
    <div class="content col-xs-8" >
    @yield('content')
    @yield('link')




    </div>


    <!-- SIDEBAR -->
    <div class="sidebar col-xs-4">

        <!-- Most view POSTS -->
        <div class="widget latest-posts">
            <h3 class="widget-title">
                Most view posts
            </h3>
            <div class="posts-container">
                @foreach($viewposts as $post)
                    <div class="item">
                        <img src="{{asset('').$post->thumnails}}" class="post-image" style="width: 100px; height: 75px">
                        <div class="info-post">
                            <h5><a href="{{asset(''). 'post/' .$post->id}}">{{$post->title}}</a></h5>
                            <span class="date">{{$post->created_at}}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach


                <div class="clearfix"></div>
            </div>
        </div>

        <!-- LATEST POSTS -->
        <div class="widget latest-posts">
            <h3 class="widget-title">
                Latest Posts
            </h3>
            <div class="posts-container">
                @foreach($dateposts as $post)
                    <div class="item">
                        <img src="{{asset('').$post->thumnails}}" class="post-image" style="width: 100px; height: 75px">
                        <div class="info-post">
                            <h5><a href="{{asset('').'post/'.$post->id}}">{{$post->title}}</a></h5>
                            <span class="date">{{$post->created_at}}</span>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                @endforeach


                <div class="clearfix"></div>
            </div>
        </div>

        <!-- TAGS -->
        <div class="widget tags">
            <h3 class="widget-title">
                Tags
            </h3>
            <div class="tags-container">
                @foreach($tagposts as $tag)
                    <a href="{{asset(''). 'tag/' .$tag->id}}">{{$tag->name}}</a>
                @endforeach
            </div>
            <div class="clearfix"></div>
        </div>


        <!-- ADVERTISING -->

    </div> <!-- #SIDEBAR -->

    <div class="clearfix"></div>


</section>


<!-- *****************************************************************
** Footer ************************************************************
****************************************************************** -->

<footer class="tada-container">


    <!-- INSTAGRAM -->
    <div class="widget widget-gallery">
        <h3 class="widget-title">INSTAGRAM</h3>
        <div class="image">
            <a href="#"><img src="{{asset('img/img-gallery-1.jpg')}}" alt="image gallery 1"></a>
            <a href="#"><img src="{{asset('img/img-gallery-2.jpg')}}" alt="image gallery 2"></a>
            <a href="#"><img src="{{asset('img/img-gallery-3.jpg')}}" alt="image gallery 3"></a>
            <a href="#"><img src="{{asset('img/img-gallery-4.jpg')}}" alt="image gallery 4"></a>
            <a href="#"><img src="{{asset('img/img-gallery-5.jpg')}}" alt="image gallery 5"></a>
            <a href="#"><img src="{{asset('img/img-gallery-6.jpg')}}" alt="image gallery 6"></a>
        </div>
        <div class="clearfix"></div>
    </div>


    <!-- FOOTER BOTTOM -->
    <div class="footer-bottom">
        <span class="copyright">Theme Created by <a href="#">AD-Theme</a> Copyright © 2016. All Rights Reserved</span>
        <span class="backtotop">TOP <i class="icon-arrow-up7"></i></span>
        <div class="clearfix"></div>
    </div>


</footer>


<!-- *****************************************************************
** Script ************************************************************
****************************************************************** -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="{{asset('js/blog/slippry.js')}}"></script>
<script src="{{asset('js/blog/main.js')}}"></script>
<script type="text/javascript">
    function readURL(input) {
        if (input.files && input.files[0]) {
            console.log(input.files[0]['name']);
            var reader = new FileReader();
            reader.onload = function (e) {
                $('.blah')
                    .attr('src', e.target.result)
                    .height(150)
                    .width('auto')
                    .css('display','block');

            };
            reader.readAsDataURL(input.files[0]);
        }
    }
    $.ajaxSetup(
        {
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        }
    );
    $('#content').ckeditor();

    $('#add-new').on('submit', function (e) {
        if($('#thumnails')[0].files[0]){
            var filename = $('#thumnails')[0].files[0]['name'];
        }
        e.preventDefault();
        var formdata = new FormData($("#add-new")[0]);
        $.ajax({
            type:'post',
            url:'{{asset("postimg")}}',
            data:formdata,
            cache:false,
            dataType:'text',
            // async:false,
            processData: false,
            contentType: false,
            success:function(response){
                console.log(response);
            }
        });

        $.ajax({
            type: 'post',
            url: '{{asset("post")}}',
            data: {
                title: $('#title').val(),
                description: $('#description').val(),
                contents: $('#content').val(),
                category_id: $('#category_id').val(),
                thumnails: filename,
                tags: $('#tags').val()
            },
            success: function (response) {
                $('#add-post').modal('hide');

                toastr.success('Add posts successfully');

            },
            error: function (xhr, status, errorThrown) {
                var err = xhr.responseJSON.errors;
                console.log(err);
                $('#add-title').append('<p style="color: crimson">'+ err['title'][0] +'</p>');
                $('#add-description').append('<p style="color: crimson">'+ err['description'][0] +'</p>');
                $('#add-content').append('<p style="color: crimson">'+ err['contents'][0] +'</p>');
                $('#add-thumnails').append('<p style="color: crimson">'+ err['thumnails'][0] +'</p>');
                $('#add-tags').append('<p style="color: crimson">'+ err['tags'][0] +'</p>');

            }
        });
    });
    //end add post

//    search
    $('.tada-search').on('keyup','.search-field', function(e){
            if (e.keyCode == 27) {
                $('input.search-field').val("");
                $('#search_result').css('display', 'none');
                $('.show_result').css('display', 'none');
            }
            else {
                var search = $('input.search-field').val().trim();
                if(search === ""){

                }
                else {
                    $.ajax({
                        type: 'get',
                        url: '{{asset("")}}search',
                        data:{
                            search: search
                        },
                        success: function (response) {
                            if (response.html !== ''){
                                $('#search_result').html(response.html);
                                $('#search_result').css('display', 'block');
                                $('.show_result').replaceWith('<button class="show_result btn-light" type="submit">See all results</button>');
                            }
                            else {
                                $('#search_result').html(response.html);
                                $('.show_result').replaceWith("<span class='show_result'>Don't have any content like this</span>");
                            }

                        }
                    })
                }
            }
    });

</script>

</body>
</html>
