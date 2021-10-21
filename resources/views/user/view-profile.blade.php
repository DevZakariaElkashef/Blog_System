@extends('layouts/blog-layout')
@section('title') Blog CMS - {{ Auth::user()->user_name }} @endsection
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

<div class=" py-5">
    <div class="row align-items-center justify-content-around">
        <div class="col-4">
            <img src="{{asset('img/undraw_profile.svg')}}" alt="{{Auth::user()->first_name}}">
            <h2 class="text-center mt-2">{{Auth::user()->user_name}}</h2>
        </div>
        <div class="col-5">
            <ul class="list-group">
                <li class="list-group-item fs-4">First Name : <span class="fs-5 text-muted">{{Auth::user()->first_name}}</span></li>
                <li class="list-group-item fs-4">Last Name : <span class="fs-5 text-muted">{{Auth::user()->last_name}}</span></li>
                <li class="list-group-item fs-4">User Name : <span class="fs-5 text-muted">{{Auth::user()->user_name}}</span></li>
                <li class="list-group-item fs-4">Email : <span class="fs-5 text-muted">{{Auth::user()->email}}</span></li>
                <li class="list-group-item fs-4">Position : <span class="fs-5 text-muted">{{Auth::user()->role}}</span></li>
            </ul>
        </div>
    </div>
</div>

@endsection
