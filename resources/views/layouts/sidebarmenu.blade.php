<!-- Menu lateral-->  
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
  <div class="sidebar-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link " href="/home">
          <span data-feather="home"></span>
          Home <span class="sr-only">(current)</span>
        </a>
      </li>
      @if(Auth::user()->role_id < 3)
        <li class="nav-item">
          <a class="nav-link " href="/admin/users">
            <span data-feather="users"></span>
            Usuarios <span class="sr-only"></span>
          </a>
        </li>
     
        <li class="nav-item">
          <a class="nav-link " href="/admin/areas">
            <span data-feather="briefcase"></span>
            Areas <span class="sr-only"></span>
          </a>
        </li>
     
      <li class="nav-item">
        <a class="nav-link " href="/admin/rosters">
          <span data-feather="clock"></span>
          Rosters <span class="sr-only"></span>
        </a>
      </li>
      @endif 

      @if(Auth::user()->role_id < 4)
        <li class="nav-item">
          <a class="nav-link" href="/workers">
            <span data-feather="activity"></span>
            Trabajadores
          </a>
        </li>
      @endif 
      
      @if(Auth::user()->role_id < 3)
        <li class="nav-item">
          <a class="nav-link" href="/reports">
            <span data-feather="bar-chart-2"></span>
            Reportes
          </a>
        </li>
      @endif      
    </ul>
  </div>
</nav>


 