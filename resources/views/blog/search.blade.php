@extends('admin/inc/blog-layout')
@section('content')

        <!-- Page content-->
        <div class="container">
            <div class="row d-flex justify-content-between">
                <!-- Blog entries-->
                <div class="col-lg-7">
                    
                    <div class="container-fluid">
                        <div class="row d-flex align-items-baseline">
                            @foreach ($rows as $row)
                                <div class="col-11 post">
                                    <a href="{{url('post',$row->id)}}"><img class="card-img-top" src="{{asset('img/posts/'.$row->image)}}" alt="..." /></a>
                                    <div class="card-body">
                                        <div class="small text-muted">{{$row->created_at}}</div>
                                        <h2 class="card-title">{{$row->title}}</h2>
                                        <p class="card-text">{!! substr($row->content, 0, 100) !!}</p>
                                        <a class="btn btn-primary" href="{{url('post',$row->id)}}">Read more →</a>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
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
                                    <form action="{{route('new-post.store')}}" method="post" id="addPost">
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
                                        <li><a href="{{url('category/'.$cat->id)}}">{{$cat->name}}</a></li>
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