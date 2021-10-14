@extends('admin/inc/master')
@section('content')

    <!-- Page Heading -->
    <div class="col-10 mx-auto">
        <h2 class="text-center my-4">Update Category</h2>

        <div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>
        
        <form class="update-category" action="{{ route('categories.update', $cat->id) }}" method="POST">
            @method('PUT')
            @csrf
            <div class="mb-3">
              <label class="form-label">Category Name</label>
              <input type="text" class="form-control" name="name" value="{{$cat->name}}">
            </div>
            <ul class="list-group" id="errors"></ul>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        
    </div>

@endsection

@section('js')
    <script>
        $.ajaxSetup({
            headers:
            {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.update-category').submit(function(e){
            e.preventDefault();
            var action = $(this).attr("action");
            var data = $(this).serialize();

            $.ajax({
                url: action,
                type: "POST",
                data:data,
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