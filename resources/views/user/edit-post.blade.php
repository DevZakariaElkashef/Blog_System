@extends('layouts/blog-layout')
@section('content')

<div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>
<div class="col-lg-8 mx-auto my-4">

    <form id="editPost" action="{{ route('user_post.update', $post->id) }}" method="post" enctype="multipart/form-data">
    @method('PUT')
    @csrf

    <div class="form-group">
        <label>Category Name</label>
        <select name="category_id" class="form-control">
            @foreach ($categories as $category)
                <option value="{{$category->id}}" @if($post->category_id == $category->id) selected @endif >{{$category->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Post Title</label>
        <input type="text" name="title" class="form-control" value="{{$post->title}}">
    </div>
    <div class="form-group">
        <label>Post Author</label>
        <input type="text" name="author" class="form-control" value="{{$post->author}}">
    </div>
    <div class="form-group">
        <label>Post Tags</label>
        <input type="text" name="tags" class="form-control" value="{{$post->tags}}">
    </div>
    <div class="form-group ">
        <select name="status" class="form-select">
            <option selected>Select Status</option>
            <option value="published">Publish</option>
            <option value="drafted">Draft</option>
        </select>
    </div>
    <div class="form-group">
        <label>Post Content</label>
        <textarea  type="text" name="content" class="form-control" id="postContent" >{!!  $post->content  !!}</textarea>
    </div>
    <img width="100" src="{{asset('img/posts/'.$post->image)}}" alt="">
    <div class="form-group">
        <label>Post Image</label><br>
        <input type="file" name="image">
    </div>

    <button class="btn btn-primary" type="submit">Submit</button>

    </form>
</div>

@endsection

@section('js')
    
    <script>
        $('#editPost').submit(function(e){
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
                    }, 1700);

                },error:function(xhr, status, error){
                    $('#success').html('');
                    $.each(xhr.responseJSON.errors,function(key,item){
                        $('#success').append(`<p> ${item} </p>`);
                    })
                    setTimeout(function() { 
                        $('#success').html('');
                    }, 1700);
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