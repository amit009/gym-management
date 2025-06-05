<div class="col-md-3 left_col menu_fixed ">
    <div class="left_col scroll-view">
        <div class="navbar nav_title">
            <a href="#" class="site_title">
                <!-- <i class="fa fa-paw"></i>  -->
                 <img src="{{ asset('build/images/muscle.png') }}" alt="">
                <span>{{ config('app.name') }}</span></a>
        </div>
        <div class="clearfix"></div>
        <br>
        <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
            <div class="menu_section">
                <ul class="nav side-menu">
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a><i class="fa fa-users"></i> Members <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('members') }}">All Members</a></li>
                            <li><a href="{{ route('member.create') }}">Add Member</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-users"></i> Services <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('services') }}">All Services</a></li>
                            <li><a href="{{ route('service.create') }}">Add Service</a></li>
                        </ul>
                    </li>
                    <li><a><i class="fa fa-users"></i> Tainers <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('trainers') }}">All Trainers</a></li>
                            <li><a href="{{ route('trainer.create') }}">Add Trainer</a></li>
                        </ul>
                    </li>
                    @if(auth()->user()->hasRole('admin'))
                    <li><a href="#"><i class="fa fa-briefcase"></i> Staff Management</a></li>
                    <li><a href="#"><i class="fa fa-calendar"></i> Attendence</a></li>
                    <li><a><i class="fa fa-users"></i> Manage Users & Roles <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="{{ route('users') }}">Users</a></li>
                            <li><a href="{{ route('roles') }}">Roles and Permissions</a></li>
                        </ul>
                    </li>
                    @endif
                </ul>
            </div>
        </div>
    </div>
</div>
