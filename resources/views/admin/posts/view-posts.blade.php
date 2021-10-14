@extends('admin/inc/table')
@section('content')


 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Posts Tables</h1>
    <div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <form action="{{route('postsoptions')}}" method="post">
            @csrf
            <div class="card-header py-3 " id="bulkOptions">
                <div class="d-flex justify-content-between aligns-item-center">
                    <div><h4 class="my-0">All Comments</h4></div>
                    <div class="d-flex">
                    <select name="bulkoptions" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                        <option selected>Select Action</option>
                        <option value="published">publish</option>
                        <option value="drafted">Draft</option>
                        <option value="delete">Delete</option>
                    </select>
                    <div class="input-group-append">
                        <button class="btn btn-outline-secondary" type="submit">Apply</button>
                    </div>
                </div>
                </div>
            </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th scope="col"><input type="checkbox" name="" id="checkAll"></th>
                            <th scope="col">Id</th>
                            <th scope="col">Category</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Date</th>
                            <th scope="col">image</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Status</th>
                            <th scope="col">Views</th>
                            <th scope="col">Show</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Id</th>
                            <th scope="col">Category</th>
                            <th scope="col">Title</th>
                            <th scope="col">Author</th>
                            <th scope="col">Date</th>
                            <th scope="col">image</th>
                            <th scope="col">Tags</th>
                            <th scope="col">Comments</th>
                            <th scope="col">Status</th>
                            <th scope="col">Views</th>
                            <th scope="col">Show</th>
                            <th scope="col">Edit</th>
                            <th scope="col">Delete</th>
                            </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($rows as $row)
                        <tr id="{{$row->id}}">
                            <td ><input type="checkbox" name="checkBoxArray[]" value="{{$row->id}}" class="checkBokes"></td>
                            <td >{{ $loop->iteration }}</td>
                            <td >{{ $row->category->name}}</td>
                            <td >{{ $row->title}}</td>
                            <td >{{ $row->author}}</td>
                            <td >{{ $row->date}}</td>
                            <td ><img width="100" src="{{asset('img/posts/'.$row->image)}}" alt="{{$row->image}}"></td>
                            <td >{{ $row->tags}}</td>
                            <td >{{$row->comment_counts}}</td>
                            <td >{{ $row->status}}</td>
                            <th>{{ $row->views }}</th>
                            <td><a href="{{url('post',$row->id)}}" class="btn btn-sm btn-outline-primary py-1">View</a></td>
                            
                            <td><a href="{{ route('posts.edit', $row->id) }}" class="btn btn-sm btn-outline-secondary py-1">Edit</a></td>
                            <td>
                                <a id="delPost" href="{{ route('posts.destroy', $row->id) }}" data-id="{{$row->id}}" class="btn btn-sm btn-outline-danger py-1">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</form>
</div>
<!-- end page content -->


@endsection

@section('js')

   {{-- delete --}}
   <script>
    $.ajaxSetup({
         headers: {
             'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
         }
     });
    
         $('body').on('click','#delPost',function(e){
             e.preventDefault();
             var action= $(this).attr('href');
             var del_id= $(this).attr('data-id');
             $.ajax({
                 type:'DELETE',
                 url: action,
                 data:{'del_id':del_id},
                 success:function(res){
                     $('#success').append(`<p class="text-center p-3 m-2"> ${res.message} </p>`);
                     $('#'+res.id).remove();
                     setTimeout(function() { 
                         $('#success').html('');
                     }, 1700);
                 }
             })                
             
         })

 
 </script>
 <script>
    $(document).ready(function(){

    $('#checkAll').click(function(e){
        if(this.checked){
            $('.checkBokes').each(function(){
                this.checked = true;
            })
        }else{
            $('.checkBokes').each(function(){
                this.checked = false;
            })
        }
    })
    })
</script>
    
@endsection