<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0">
  <div class="container-fluid d-flex flex-column p-0">
    <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="/">
      <div class="sidebar-brand-icon rotate-n-15"> <img src="{{ asset('assets/img/icons/brand-logo.png') }}" width=22px alt=""> </div>
      <div class="sidebar-brand-text mx-3"><span>Bookmyappoint.</span></div>
    </a>
    <hr class="sidebar-divider my-0">
    <ul class="nav navbar-nav text-light" id="accordionSidebar">
      <li class="nav-item" role="presentation">
        <a class="nav-link @yield('dashboardActive')" href="{{ route('admin.home') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link @yield('profileActive')" href="{{ route('admin.profile.index') }}"><i class="fas fa-user"></i><span>Profile</span></a>
      </li>

      <li class="nav-item" role="presentation">
        <a class="nav-link @yield('usersActive')" href="{{ route('admin.users.index') }}"><i class="fa fa-user-circle" aria-hidden="true"></i><span>Users Table</span>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link @yield('clientsActive')" href="{{ route('admin.clients.index') }}"><i class="fa fa-users" aria-hidden="true"></i><span>Clients Table</span>
        </a>
      </li>
      <li class="nav-item" role="presentation">
        <a class="nav-link @yield('ManAppActive')" href="{{ route('admin.appointment.index') }}"><i class="fas fa-table" aria-hidden="true"></i><span>Manaege Appointments</span>
        </a>
      </li>
      <li role="presentation" class="nav-item">
        <div><a class="btn btn-link nav-link @yield('tokkendetailsActive')" data-toggle="collapse" aria-expanded="false" aria-controls="collapse-1" href="#collapse-1" role="button"><i class="fas fa-user"></i><span>Tokken details</span></a>
          <div class="collapse" id="collapse-1" style="margin-right: 0px;margin-left: 0px;">
            <div class="bg-white border rounded-0 py-2 collapse-inner">
              <h6 class="collapse-header" style="padding-left: 8px;">Enter Tokken no.</h6>
              <form action="{!! route('admin.tokkendetails.store') !!}"method="post" class="form-inline d-none d-sm-inline-block mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                @csrf
                <div class="input-group"><input style="
                width: 150px;
                " type="text" class="bg-light form-control border-0 small" placeholder="ATN######" name="t_no" />
                <div class="input-group-append"><button  class="btn btn-primary py-0" style="
                background-color: #343a40;
                border-color: #343a40;
                " type="submit"><i class="fas fa-search"></i></button></div>
              </div>
            </form>
            </div>
          </div>
        </div>
      </li>
    </ul>
    <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
  </div>
</nav>
