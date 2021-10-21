<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <meta name="csrf-token" content="{!! csrf_token() !!}">

        <title>@yield('title')</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="{{asset('assets/favicon.ico')}}" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
        <!-- Custom fonts for this template-->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="{{ asset('css/sb-admin-2.min.css') }}" rel="stylesheet">


        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="{{asset('css/styles.css')}}" rel="stylesheet" />
        <style>
            
            .header{
                max-height: 500px;
            }
            .header img{
                width: 100%;
                max-height: 500px;
            }
        </style>
        
        <script src="https://cdn.ckeditor.com/ckeditor5/30.0.0/classic/ckeditor.js"></script>
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
              <a class="navbar-brand" href="{{route('home')}}">Home Page</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>
              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mb-2 mb-lg-0">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{route('home')}}">Home</a>
                        </li>
                        @can('bloger')
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ route('user_post.show', Auth::user()->id) }}">My Posts</a>
                        </li>
                        @endcan
                          @can('admins')
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('admin') }}">Admin</a>
                            </li>
                        @endcan
                    </ul>


                <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                    @if (Auth::user())

                    <!-- Nav Item - Alerts -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="alertsDropdown" role="button"
                            data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bell fa-fw"></i>
                            <!-- Counter - Alerts -->
                            <span class="badge badge-danger badge-counter"></span>
                        </a>
                        <!-- Dropdown - Alerts -->
                        <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                            aria-labelledby="alertsDropdown">
                            <h6 class="dropdown-header">
                                Alerts Center
                            </h6>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)">
                                <div class="mr-3">
                                    <div class="icon-circle bg-primary">
                                        <i class="fas fa-file-alt text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 12, 2019</div>
                                    <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)">
                                <div class="mr-3">
                                    <div class="icon-circle bg-success">
                                        <i class="fas fa-donate text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 7, 2019</div>
                                    $290.29 has been deposited into your account!
                                </div>
                            </a>
                            <a class="dropdown-item d-flex align-items-center" href="javascript:void(0)">
                                <div class="mr-3">
                                    <div class="icon-circle bg-warning">
                                        <i class="fas fa-exclamation-triangle text-white"></i>
                                    </div>
                                </div>
                                <div>
                                    <div class="small text-gray-500">December 2, 2019</div>
                                    Spending Alert: We've noticed unusually high spending for your account.
                                </div>
                            </a>
                            <a class="dropdown-item text-center small text-gray-500" href="javascript:void(0)">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link" href="javascript:void(0)">
                            <i class="fas fa-globe"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-success badge-counter "></span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="javascript:void(0)" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"> {{ Auth::user()->user_name }} </span>
                                <img class="img-profile rounded-circle" width="30" src="{{asset('img/undraw_profile.svg')}}" alt="{{ Auth::user()->name }}">
                            </a>
                        <!-- Dropdown - User Information -->
                        <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in w-50"
                        aria-labelledby="userDropdown">
                        <a class="dropdown-item" href="{{route('profile.index')}}">
                            <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                            Profile
                        </a>
                        <a class="dropdown-item" href="{{route('profile.edit', Auth::user()->id)}}">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                            Settings
                        </a>
                        <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" class="d-flex align-items-center justify-content-center mx-1">
                                @csrf
                                <a href="route('logout')"
                                    onclick="event.preventDefault();
                                    this.closest('form').submit();"
                                    class="dropdown-item">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    {{ __('Log Out') }}
                                </a>
                            </form>
                        </div>
                    </li>
                  @endif

                   @if (Route::has('login'))
                        <ul class="navbar-nav mb-2 mb-lg-0">
                    @auth
                        
                    @else
                        <li class="nav-item">
                            <a href="{{ route('login') }}" class=" nav-link">Log in</a>
                        </li>
                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a href="{{ route('register') }}" class="ml-4  nav-link">Register</a>
                        </li>
                    @endif
                    @endauth
                        </ul>
                    @endif
                  
                </ul>
                
              </div>
            </div>
          </nav>
        <!-- Page header with logo and tagline-->
        @yield('header');

       
        <!-- Page content-->
        <div class="container">
            <div class="row">
                <!-- Blog entries-->
                @yield('content')
                @if (isset($cats))
                 <!-- Side widgets-->
                 <div class="col-md-4">
                    <!-- Search widget-->
                    <div class="card mb-4">
                        <div class="card-header">Search</div>
                        <div class="card-body">
                            <form action="{{url('search')}}" method="GET">
                                @csrf
                                <div class="input-group">
                                    <input class="form-control" type="text" placeholder="Enter search term..." name="search"/>
                                    <button class="btn btn-primary" id="button-search" type="submit">Go!</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    @can('bloger')
                    <!-- Write post -->
                    <div class="card mb-4">
                        <div class="card-header">Write Post</div>
                        <div class="card-body">
                            
                            <!-- Button trigger modal -->
                            <a class="btn w-100"  data-bs-toggle="modal" data-bs-target="#exampleModal">
                                <input role="button" type="text" class="form-control w-100 rounded-pill" placeholder="What's On Your Mind?..">
                            </a>
                            
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Write Post</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        <div id="posterrors" class=" bg-danger text-light text-center rounded"></div>
                                        <div id="postsuccess" class=" bg-success text-light text-center rounded"></div>
                                    <form action="{{route('user_post.store')}}" method="post" id="addPost">
                                        @csrf
                                        <div class="form-group">
                                            <label>Category Name</label>
                                            <select name="category_id" class="form-select form-select-sm">
                                                @foreach ($cats as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Post Title" type="text" name="title" class="form-control">
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Post Author" type="text" name="author" class="form-control">
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input placeholder="Post Tags" type="text" name="tags" class="form-control">
                                        </div>
                                        <div class="form-group ">
                                            <select name="status" class="form-select form-select-sm">
                                                <option selected>Select Status</option>
                                                <option value="published">Publish</option>
                                                <option value="drafted">Draft</option>
                                            </select>
                                        </div>
                                        <div class="form-group ">
                                            <textarea placeholder="Post Content" type="text" name="content" class="form-control" id="postContent"></textarea>
                                        </div>
                                        <div class="input-group input-group-sm mb-3">
                                            <input type="file" name="image" class="form-control form-control-sm">
                                        </div>
                                
                                        
                                    </div>
                                    <div class="modal-footer">
                                        <button class="btn btn-primary" type="submit">Submit</button>
                                </div>
                            </form>
                                </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endcan
                    <!-- Categories widget-->
                    <div class="card mb-4">
                        <div class="card-header">Categories</div>
                        <div class="card-body">
                            <div class="row">
                                @if (isset($cats))
                                @foreach ($cats as $cat)
                                <div class="col-md-6 d-flex align-items-center">
                                    <ul class="list-unstyled mb-0">
                                        <li><a href="{{url('category/'.$cat->id)}}" class="text-decoration-none">{{$cat->name}}</a></li>
                                    </ul>
                                </div>
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                    <!-- Side widget-->
                    <div class="card mb-4">
                        <div class="card-header">Side Widget</div>
                        <div class="card-body">You can put anything you want inside of these side widgets. They are easy to use, and feature the Bootstrap 5 card component!</div>
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Footer-->
        <footer class="py-5 bg-dark">
            <div class="container"><p class="m-0 text-center text-white">Copyright &copy; Your Website 2021</p></div>
        </footer>



        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
        <!-- jquery-->
        <script src="{{asset('vendor/jquery/jquery.min.js')}}"></script>
        <!-- Core theme JS-->
        <script src="{{asset('js/scripts.js')}}"></script>
        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script>
            $('#addPost').submit(function(e){
                e.preventDefault();
                var action = $(this).attr('action');
                
                
                $.ajax({
                    url: action,
                    type: 'POST',
                    data: new FormData( this ),
                    processData: false,
                    contentType: false,
                    success:function(result){
                        $('#postsuccess').append(`<p class="text-center p-3 m-2"> ${result.message} </p>`);
                        setTimeout(function() { 
                            $('#postsuccess').html('');
                        }, 2700);
        
                    },error:function(xhr, status, error){
                        $('#posterrors').html('');
                        $.each(xhr.responseJSON.errors,function(key,item){
                            $('#posterrors').append(`<p class="text-center p-3 m-2"> ${item} </p>`);
                        })
                        setTimeout(function() { 
                            $('#posterrors').html('');
                        }, 2700);
                    }
                
                });
            });
        
        </script>
        @yield('js')
    </body>
</html>