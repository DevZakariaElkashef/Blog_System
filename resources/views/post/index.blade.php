@extends('layouts/blog-layout')
@section('title') Blog CMS - {{ $post->title }} @endsection

@section('content')
    <div class="col-lg-8">

        <!-- Post content-->
        <article>
            <!-- Post header-->
            <header class="mb-4">
                <div class="d-flex justify-content-between align-items-center">
                    <!-- Post title-->
                    <h1 class="fw-bolder mb-1">{{$post->title}}</h1>
                    @can('bloger')
                    @if (Auth::user()->id === $post->user_id)
                    <!-- Post Edit -->
                    <a href="{{ route('user_post.edit', $post->id) }}" class="btn btn-outline-primary py-1">Edit</a>
                    @endif
                    @endcan
                    
                </div>
                <!-- Post meta content-->
                <div class="text-muted fst-italic mb-2">Posted on {{$post->created_at}} by <a class="text-decoration-none text-primary  text-opacity-75" href="{{url('author/'. $post->author)}}">{{$post->author}}</a></div>
                <!-- Post categories-->
                @if ($post->tags != "")
                    @foreach(explode(',', $post->tags) as $tag) 
                    <a class="badge bg-secondary text-decoration-none link-light" href="#!">{{$tag}}</a>
                    @endforeach
                @endif
                
            </header>
            <!-- Preview image figure-->
            <figure class="mb-4"><img class="w-100 rounded" src="{{asset('img/posts/'.$post->image)}}" alt="..." /></figure>
            <!-- Post content-->
            <section class="mb-5">
                <p class="fs-5 mb-4 text-justify">{!! $post->content !!}</p>
                
            </section>
        </article>
        <!-- Comments section-->
        <section class="mb-5">
            <div class="card bg-light">
                <div class="card-body">
                    @can('bloger')
                    
                    <!-- Comment form-->
                    <h4>Leave a Comment</h4>
                    <div id="commentsuccess" class="col-5 mx-auto bg-success text-light rounded"></div>
                    <div id="commenterrors" class="col-5 mx-auto my-3 bg-danger text-light rounded"></div>
                    
                    <form id="sendComment" class="mb-4" action="{{route('comments.store')}}" method="POST">
                        @csrf
                        <input type="hidden" name="post_id" value="{{$post->id}}">

                        <div class="form-floating">
                            <textarea class="form-control" name="content" placeholder="Leave a comment here" id="floatingTextarea" style="height: 100px"></textarea>
                            <label for="floatingTextarea">Comments</label>
                            </div>
                        <button type="submit" class="btn btn-primary mt-3">Submit</button>
                    </form>

                    @endcan

                    @foreach ($comments as $comment)
                    
                    <!-- Single comment-->
                    <div class="d-flex my-3">
                        <div class="flex-shrink-0"><img class="rounded-circle" src="https://dummyimage.com/50x50/ced4da/6c757d.jpg" alt="..." /></div>
                        <div class="ms-3">
                            <div class="fw-bold">{{$comment->author}}</div>
                            {{$comment->content}}
                        </div>
                    </div>

                    @endforeach
                </div>
            </div>
        </section>
    </div>
@endsection
        
@section('js')
    
    <script>
        $('#sendComment').submit(function(e){
            e.preventDefault();
            var action = $(this).attr('action');
            var data = $(this).serialize();
            
            $.ajax({
                url: action,
                type: "POST",
                data: data,
                success:function(result){
                    $('#commentsuccess').append(`<p class="text-center p-3 m-2"> ${result.message} </p>`);
                    setTimeout(function() { 
                        $('#commentsuccess').html('');
                    }, 3000);

                },error:function(xhr, status, error){
                    $('#commenterrors').html('');
                    $.each(xhr.responseJSON.errors,function(key,item){
                        $('#commenterrors').append(`<p class="text-center p-3 m-2"> ${item} </p>`);
                    })
                    setTimeout(function() { 
                        $('#commenterrors').html('');
                    }, 3000);
                }
            
            });
        });
    
    </script>
    
    
    <script>
        ClassicEditor
            .create( document.querySelector( '#postContent' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

@endsection

