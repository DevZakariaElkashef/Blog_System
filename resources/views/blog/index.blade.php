@extends('layouts/blog-layout')
@section('title') Blog CMS - Home @endsection
@section('content')
    <div class="col-md-8">
        @if (isset($rand_post))
            <!-- Featured blog post-->
            <div class="card mb-4">
                <a href="{{url('post',$rand_post->id)}}"><img class="card-img-top" src="{{asset('img/posts/'.$rand_post->image)}}" alt="..." /></a>
                <div class="card-body">
                    <h2 class="card-title text-primary">{{$rand_post->title}}</h2>
                    <h4 >by <a class="text-decoration-none text-primary  text-opacity-75" href="{{url('author/'. $rand_post->author)}}">{{$rand_post->author}}</a></h4>
                    <div class="small text-muted d-flex justify-content-between align-items-center">
                        <span><i class="far fa-clock"></i> {{$rand_post->created_at}} </span>
                        <span><i class="far fa-eye"></i> {{$rand_post->views}}</span>
                    </div>
                    <p class="card-text">{!! substr($rand_post->content, 0,70) !!}</p>
                    <a class="btn btn-outline-primary" href="{{url('post',$rand_post->id)}}">Read more →</a>
                </div>
            </div>
        @endif
        @if (count($posts) > 0)
            <div class="container-fluid">
                <div class="row d-flex align-items-baseline">
                        @foreach ($posts as $row)
                            <div class="col-md-6 post">
                                <a href="{{url('post',$row->id)}}"><img width="100" class="card-img-top" src="{{asset('img/posts/'.$row->image)}}" alt="..." /></a>
                                <div class="card-body">
                                    <h2 class="card-title text-primary">{{$row->title}}</h2>
                                    <h4 >by <a class="text-decoration-none text-primary  text-opacity-75" href="{{url('author/'. $row->author)}}">{{$row->author}}</a></h4>
                                    <div class="small text-muted d-flex justify-content-between align-items-center">
                                        <span><i class="far fa-clock"></i> {{$row->created_at}} </span>
                                        <span><i class="far fa-eye"></i> {{$row->views}}</span>
                                    </div>
                                    <p class="card-text">{!! substr($row->content, 0,70) !!}</p>
                                    <a class="btn btn-outline-primary" href="{{url('post',$row->id)}}">Read more →</a>
                                </div>
                            </div>
                        @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {!! $posts->links(); !!}
            </div>
        @else
            <div class="d-flex justify-content-center align-items-center" style="height:80vh;">
                <h1 class="text-muted">No Posts To View</h1>
            </div>
        @endif
    </div>
@endsection

@section('js')
    <script>
        ClassicEditor
            .create( document.querySelector( '#postContent' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>
@endsection