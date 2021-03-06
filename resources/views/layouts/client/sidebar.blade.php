<nav class="navbar navbar-dark align-items-start sidebar sidebar-dark accordion bg-gradient-primary p-0 ">
    <div class="container-fluid d-flex flex-column p-0">
        <a class="navbar-brand d-flex justify-content-center align-items-center sidebar-brand m-0" href="{{ route('index') }} ">
            <div class="sidebar-brand-icon rotate-n-15"> <img src="{{ asset('assets/img/icons/brand-logo.png') }}" width=22px alt=""> </div>
            {{-- <div class="sidebar-brand-text mx-3"><span></span></div> --}}
            <div class="sidebar-brand-text mx-3"><span>Bookmyappoint.</span></div>
        </a>
        <hr class="sidebar-divider my-0">
        <ul class="nav navbar-nav text-light" id="accordionSidebar">
            <li class="nav-item" role="presentation"><a class="nav-link @yield('dashboardActive')" href="{{ route('client.home') }}"><i class="fas fa-tachometer-alt"></i><span>Dashboard</span></a></li>
            <li class="nav-item" role="presentation"><a class="nav-link @yield('profileActive')" href="{{ route('client.profile.index') }}/"><i class="fas fa-user"></i><span>Profile</span></a></li>
            <li class="nav-item" role="presentation">
                <a class="nav-link @yield('appointmentActive')" href="{{ route('client.appointment.index') }}"><i class="fas fa-table"></i><span>Appointment</span></a>
            </li>
        </ul>
        <div class="text-center d-none d-md-inline"><button class="btn rounded-circle border-0" id="sidebarToggle" type="button"></button></div>
    </div>
</nav>
