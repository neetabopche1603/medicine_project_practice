<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">Jay Mahakal Pharma</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{route('admin.dashboard')}}">St</a>
        </div>
        <ul class="sidebar-menu">
          <li><a class="nav-link" href="{{route('admin.dashboard')}}"><i class="fas fa-home"></i> <span>Dashboard</span></a>
          </li>

          <li><a class="nav-link" href="{{route('admin.company')}}"><i class="fas fa-pencil-ruler"></i> <span>Company</span></a>
          </li>

          <li><a class="nav-link" href="{{route('admin.category')}}"><i class="fas fa-pencil-ruler"></i><span>Category</span></a>
          </li>

          <li><a class="nav-link" href="{{route('admin.products')}}"><i class="fas fa-pencil-ruler"></i><span>Product</span></a>
          </li>
           
            <li><a class="nav-link" href="blank.html"><i class="far fa-square"></i> <span>Blank Page</span></a></li>
            <li class="dropdown">
                <a href="#" class="nav-link has-dropdown"><i class="fas fa-exclamation"></i>
                    <span>Errors</span></a>
                <ul class="dropdown-menu">
                    <li><a class="nav-link" href="errors-503.html">503</a></li>
                    <li><a class="nav-link" href="errors-403.html">403</a></li>
                    <li><a class="nav-link" href="errors-404.html">404</a></li>
                    <li><a class="nav-link" href="errors-500.html">500</a></li>
                </ul>
            </li>
            

            <li><a class="nav-link" href="{{route('adminLogout')}}" onclick="return confirm('Are you sure logout this site!')"><i class="fas fa-pencil-ruler"></i> <span>Logout</span></a>
            </li>
        </ul>

    </aside>
</div>
