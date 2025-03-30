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
                    <li><a href="#"><i class="fa fa-home"></i> Dashboard</a></li>
                    <li><a><i class="fa fa-users"></i> Manage Members <span class="fa fa-chevron-down"></span></a>
                        <ul class="nav child_menu">
                            <li><a href="#">List Members</a></li>
                            <li><a href="#">Add Member</a></li>
                        </ul>
                    </li>
                    <li><a href="#"><i class="fa fa-briefcase"></i> Staff Management</a></li>
                    <li><a href="#"><i class="fa fa-calendar"></i> Attendence</a></li>
                    <li><a href="#"><i class="fa fa-users"></i> Users</a></li>
                </ul>
            </div>
        </div>
    </div>
</div>
