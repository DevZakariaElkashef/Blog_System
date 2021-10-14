@extends('admin/inc/master')
@section('content')

    <!-- Page Heading -->
    <div class="col-10 mx-auto">
        <h2 class="text-center my-4">Add User</h2>

        <div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>
        
        <form id="addUser" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div class="row mb-1">
                <div class="col-6">
                    <label class="form-label">Firs Name</label>
                    <input type="text" class="form-control" name="first_name">
                </div>
                <div class="col-6">
                    <label class="form-label">Last Name</label>
                    <input type="text" class="form-control" name="last_name">
                </div>
            </div>
            
            <div class="mb-3">
              <label class="form-label">User Name</label>
              <input type="text" class="form-control" name="user_name">
            </div>
            <div class="mb-3">
              <label class="form-label">Email</label>
              <input type="email" class="form-control" name="email">
            </div>
            <div class="mb-3">
              <label class="form-label">Role</label>
              <select name="role" class="form-control">
                  <option value="owner">owner</option>
                  <option value="admin">admin</option>
                  <option value="bloger">bloger</option>
              </select>
            </div>
            <div class="mb-3">
              <label class="form-label">Password</label>
              <input type="password" class="form-control" name="password">
            </div>
            <div id="errors" class="text-danger"></div>
            <button  type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>

@endsection

@section('js')
    
    <script>
        $('#addUser').submit(function(e){
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

