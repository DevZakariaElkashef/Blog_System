@extends('admin/inc/master')
@section('content')

    <!-- Page Heading -->
    <div class="col-10 mx-auto">
        <h2 class="text-center my-4">Add Category</h2>

        <div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>
        
        <form id="addCat" action="{{ route('categories.store') }}" method="POST">
            @csrf
            <div class="mb-3">
              <label class="form-label">Category Name</label>
              <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
            <div id="errors" class="text-danger"></div>
            <button  type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>

@endsection

@section('js')


    <script>


        $('#addCat').submit(function(e){
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
                },error:function(xhr, status, errors){
                    $.each(xhr.responseJSON.errors,function(key,item){
                        $('#errors').html('');
                    $.each(xhr.responseJSON.errors,function(key,item){
                        $('#errors').append(`<p> ${item} </p>`);
                    })
                    setTimeout(function() { 
                        $('#errors').html('');
                    }, 1700);
                    })
                    
                }
            
            });
        });
    
    </script>

@endsection

