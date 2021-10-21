<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('home') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Blog Home</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Interface
    </div>
    
    <!-- Nav Item - Pages categories Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#categories"
            aria-expanded="true" aria-controls="categories">
            <i class="fa fa-list-alt"></i>
            <span>Categories</span>
        </a>
        <div id="categories" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Categories:</h6>
                <a class="collapse-item" href="{{ route('categories.index') }}">View Categories</a>
                <a class="collapse-item" id="addCateoryPage" href="{{ route('categories.create') }}">Add Categories</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - Pages posts Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#posts"
            aria-expanded="true" aria-controls="posts">
            <i class="fas fa-shopping-basket"></i>
            <span>Posts</span>
        </a>
        <div id="posts" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Posts:</h6>
                <a class="collapse-item" href="{{ route('posts.index') }}">Veiw Posts</a>
                <a class="collapse-item" href="{{ route('posts.create') }}">Add Posts</a>
            </div>
        </div>
    </li>
    
    <!-- Nav Item - comments -->
    <li class="nav-item">
        <a class="nav-link" href="{{route('comments.index')}}">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Comments</span></a>
    </li>

    <!-- Nav Item - Pages Users Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#users"
            aria-expanded="true" aria-controls="users">
            <i class="fas fa-users"></i>
            <span>Users</span>
        </a>
        <div id="users" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Users:</h6>
                <a class="collapse-item" href="{{ route('users.index') }}">Veiw Users</a>
                @can('owner')
                <a class="collapse-item" href="{{ route('users.create') }}">Add Users</a>
                @endcan
            </div>
        </div>
    </li>

    

    

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block mt-5">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>
<!-- End of Sidebar -->