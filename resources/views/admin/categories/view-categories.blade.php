@extends('admin/inc/table')
@section('content')


 <!-- Begin Page Content -->
 <div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">Caregories Tables</h1>
    <div id="success" class="col-5 mx-auto bg-success text-light rounded"></div>

    <!-- DataTales Example -->
    <form id="catOptions" action="{{route('categoriesoptions')}}" method="get">
        @csrf
        <div class="card shadow mb-4">
            <div class="card-header py-3">
                <div class="d-flex justify-content-between aligns-item-center">
                    <div><h4 class="my-0">All Comments</h4></div>
                        <div class="d-flex">
                            <select name="bulkoptions" class="custom-select" id="inputGroupSelect04" aria-label="Example select with button addon">
                                <option selected>Select Action</option>
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
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th scope="col"></th>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">Date</th>
                                <th scope="col">Edit</th>
                                <th scope="col">Delete</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($rows as $row)
                                <tr id="{{$row->id}}">
                                    <td scope="col"><input type="checkbox" name="checkBoxArray[]" value="{{$row->id}}" class="checkBokes"></td>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $row->name }}</td>
                                    <td>{{ $row->date }}</td>
                                    <td><a id="editCat" href="{{ route('categories.edit', $row->id) }}" class="btn btn-sm btn-outline-primary py-1">Edit</a></td>
                                    <td>
                                        <a id="delCategory" href="{{ route('categories.destroy', $row->id) }}" data-id="{{$row->id}}" class="btn btn-sm btn-outline-danger py-1">Delete</a>
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
        
             $('body').on('click','#delCategory',function(e){
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
        

        // $(document).ready(function(){  

        //     $('#catOptions').submit(function(e){
        //         e.preventDefault();
        //         var optAction = $(this).attr('action');
        //         var optData = $(this).serialize();

        //         var ids = [];  

        //         $('.checkBokes').each(function(){  
        //                 if($(this).is(":checked")){  
        //                     ids.push($(this).val());  
        //                 }  
        //         });

        //         ids = ids.toString();
        //          console.log(optData);

        //         $.ajax({  
        //                 url: optAction,  
        //                 type:"GET",  
        //                 data:{
        //                     data: optData
        //                     },
        //                 success:function(data){  
        //                     console.log(data);  
        //                 }  
        //         });  
        //     });  
        // });  




    </script>

@endsection