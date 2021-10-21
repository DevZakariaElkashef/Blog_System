@extends('layouts/blog-layout')
@section('title') Blog CMS - {{ $cat_name }} @endsection
@section('content')
    <div class="col-lg-8">
        
        <div class="container-fluid">
            <div class="row d-flex align-items-baseline">
                @foreach ($rows as $row)
                    <div class="col-11 post">
                        <a href="{{url('post',$row->id)}}"><img class="card-img-top" src="{{asset('img/posts/'.$row->image)}}" alt="..." /></a>
                        <div class="card-body">
                            <div class="small text-muted">{{$row->created_at}}</div>
                            <h2 class="card-title">{{$row->title}}</h2>
                            <p class="card-text">{!! substr($row->content, 0, 100) !!}</p>
                            <a class="btn btn-outline-primary" href="{{url('post',$row->id)}}">Read more →</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection

@section('js')
<script>
    ClassicEditor
        .create( document.querySelector( '#postContent' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection