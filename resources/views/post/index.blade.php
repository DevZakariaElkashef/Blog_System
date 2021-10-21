@extends('layouts/blog-layout')
@section('content')

        <!-- Page content-->
        <div class="container mt-5">
            <div class="row">
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
                                <div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>
                                <div id="errors" class="col-5 mx-auto my-3 bg-danger text-light rounded"></div>
                                
                                <form id="sendComment" class="mb-4" action="{{route('comments.store')}}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" name="author" class="form-control my-2" placeholder="Your Name...">
                                    </div>
                                    <div class="form-group">
                                        <input type="email" name="email" class="form-control my-2" placeholder="Your Email...">
                                    </div>

                                    <input type="hidden" name="post_id" value="{{$post->id}}">

                                    <div class="form-group">
                                        <textarea class="form-control" rows="3" placeholder="Join the discussion and leave a comment!" name="content"></textarea>
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
                <!-- Side widgets-->
                <div class="col-lg-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <form action="{{url('search')}}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Enter search term..." name="search"/>
                                    <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @can('bloger')
                    <!-- Write post -->
                    <div class="card mb-4">
                        <div class="card-header">Write Post</div>
                        <div class="card-body">
                            
                            <!-- Button trigger modal -->
                            <a class="btn w-100"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <input role="button" type="text" class="form-control w-100 rounded-pill" placeholder="What's On Your Mind?..">
                            </a>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Write Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="errors" class=" bg-danger text-light text-center rounded"></div>
                                        <div id="success" class=" bg-success text-light text-center rounded"></div>
                                    <form action="{{route('user_post.store')}}" method="post" id="addPost">
                                        @csrf
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <select name="category_id" class="form-select form-select-sm">
                                                @foreach ($cats as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Post Title" type="text" name="title" class="form-control">
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Post Author" type="text" name="author" class="form-control">
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Post Tags" type="text" name="tags" class="form-control">
                                        </div>
                                        <div class="form-group ">
                                            <select name="status" class="form-select form-select-sm">
                                                <option selected>Select Status</option>
                                                <option value="published">Publish</option>
                                                <option value="drafted">Draft</option>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <textarea placeholder="Post Content" type="text" name="content" class="form-control" id="postContent"></textarea>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input type="file" name="image" class="form-control form-control-sm">
                                        </div>
                                
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                @foreach ($cats as $cat)
                                <div class="col-sm-6">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{url('category/'.$cat->id)}}" class="text-decoration-none">{{$cat->name}}</a></li>
                                    </ul>
                                </div>
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
            </div>
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
                    $('#success').append(`<p class="text-center p-3 m-2"> ${result.message} </p>`);
                    setTimeout(function() { 
                        $('#success').html('');
                    }, 5000);

                },error:function(xhr, status, error){
                    $('#errors').html('');
                    $.each(xhr.responseJSON.errors,function(key,item){
                        $('#errors').append(`<p class="text-center my-3"> ${item} </p>`);
                    })
                    setTimeout(function() { 
                        $('#errors').html('');
                    }, 5000000);
                }
            
            });
        });
    
    </script>
    <script>
        $('#addPost').submit(function(e){
            e.preventDefault();
            var action = $(this).attr('action');
            
            
            $.ajax({
                url: action,
                type: 'POST',
                data: new FormData( this ),
                processData: false,
                contentType: false,
                success:function(result){
                    $('#success').append(`<p class="text-center p-3 m-2"> ${result.message} </p>`);
                    setTimeout(function() { 
                        $('#success').html('');
                    }, 2700);
    
                },error:function(xhr, status, error){
                    $('#errors').html('');
                    $.each(xhr.responseJSON.errors,function(key,item){
                        $('#errors').append(`<p> ${item} </p>`);
                    })
                    setTimeout(function() { 
                        $('#errors').html('');
                    }, 2700);
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

