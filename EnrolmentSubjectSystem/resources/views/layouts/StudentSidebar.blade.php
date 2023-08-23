<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('Studentdashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fa fa-user"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Student Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->


   

    <li class="nav-item">
        <a class="nav-link" href="{{ route('student.edit',session('user')->userID) }}">
            <i class="fa fa-edit"></i>
            <span>Edit Personal Information</span></a>
    </li>

    <li class="nav-item">
        <a class="nav-link" href="StudentViewTimetable">
            <i class="fa fa-calendar"></i>
            <span>View Timetable</span></a>
    </li>

 


    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>


</ul>