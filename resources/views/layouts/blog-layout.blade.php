<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Blog CMS - Home</title>
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
                        <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
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
                            <a class="dropdown-item d-flex align-items-center" href="#">
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
                            <a class="dropdown-item d-flex align-items-center" href="#">
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
                            <a class="dropdown-item d-flex align-items-center" href="#">
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
                            <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                        </div>
                    </li>

                    <!-- Nav Item - Messages -->
                    <li class="nav-item dropdown no-arrow mx-1">
                        <a class="nav-link" href="#">
                            <i class="fas fa-globe"></i>
                            <!-- Counter - Messages -->
                            <span class="badge badge-success badge-counter "></span>
                        </a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
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

        @yield('content')

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
        
        @yield('js')
    </body>
</html>