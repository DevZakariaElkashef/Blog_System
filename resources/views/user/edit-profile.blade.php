@extends('admin/inc/blog-layout')
@section('header')

<header class="py-5 bg-light border-bottom mb-4">
    <div class="container">
        <div class="text-center my-5 py-3">
            <h1 class="fw-bolder">Welcome {{Auth::user()->first_name}} to Your Profile</h1>
            <p class="lead mb-0">Lorem ipsum dolor sit amet consectetur adipisicing elit. Nemo, autem.</p>

        </div>
    </div>
</header>
    
@endsection

@section('content')

<div class="container py-5">
    <div class="col-7 mx-auto">
        <div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>
        <div id="errors" class="col-5 mx-auto bg-danger text-light rounded"></div>


        <form id="editProfile" action="{{ route('profile.update', Auth::user()->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="row mb-1">
                <div class="col-6">
                    <label class="form-label">Firs Name</label>
                    <input type="text" class="form-control" name="first_name" value="{{Auth::user()->first_name}}">
                </div>
                <div class="col-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name" value="{{Auth::user()->last_name}}">
                </div>
            </div>
            
            <div class="mb-3">
              <label class="form-label">User Name</label>
              <input type="text" class="form-control" name="user_name" value="{{Auth::user()->user_name}}">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email" value="{{Auth::user()->email}}">
            </div>
            
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
            <input type="hidden" name="id" value="{{Auth::user()->id}}">
            <button  type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</div>

@endsection


@section('js')
    
    <script>
        $('#editProfile').submit(function(e){
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
                    }, 1700);

                },error:function(xhr, status, error){
                    $('#errors').html('');
                    $.each(xhr.responseJSON.errors,function(key,item){
                        $('#errors').append(`<p> ${item} </p>`);
                    })
                    setTimeout(function() { 
                        $('#errors').html('');
                    }, 1700);
                }
            
            });
        });
    
    </script>

@endsection


