@extends('layouts/blog-layout')
@section('title') Blog CMS - {{ Auth::user()->user_name }} @endsection
@section('content')

    @if (count($rows) > 0)
        <div class="col-lg-8">
            <div class="container-fluid">
                <div class="row d-flex align-items-baseline">
                    @foreach ($rows as $row)
                        <div id="{{ $row->id }}" class="col-11 post mb-3 @if ($row->status == 'drafted') opacity-50 @endif">
                            <a href="{{url('post',$row->id)}}"><img class="card-img-top" src="{{asset('img/posts/'.$row->image)}}" alt="..." /></a>
                            <div class="card-body">
                                <div class="small text-muted">{{$row->created_at}}</div>
                                <h2 class="card-title">{{$row->title}}</h2>
                                <p class="card-text">{!! substr($row->content, 0, 100) !!}</p>
                                <div class="d-flex justify-content-between align-items-center">
                                    <a class="btn btn-outline-primary py-1" href="{{url('post',$row->id)}}">Read more →</a>
                                    <a href="{{ route('user_post.destroy', $row->id) }}" id="delPost" data-id="{{$row->id}}" class="btn btn-outline-danger py-1">Delete</a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
            <div class="d-flex justify-content-center">
                {!! $rows->links() !!}
            </div>
        </div>
    @else
        <div class="d-flex justify-content-center align-items-center col-md-8" style="height:80vh;">
            <h1 class="text-muted">No Posts To View</h1>
        </div>
    @endif            
        
@endsection

@section('js')
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
    ClassicEditor
        .create( document.querySelector( '#postContent' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection