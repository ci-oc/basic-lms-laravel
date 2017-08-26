{{-- Side Navigation --}}
<div class="col-md-3">
    <div class="sidebar content-box" style="display: block;">
        <ul class="nav">
            <!-- Main menu -->
            <li class="current"><a href="{{route('admin.index')}}"><i class="glyphicon glyphicon-home"></i>
                    Dashboard</a></li>
            <li class="submenu">
                <a href="#">
                    <i class="fa fa-users"></i>User Management<span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li class="sub-menu"><a href="{{route('user.index')}}"><i class="fa fa-user"></i>
                            Users</a></li>
                </ul>
                <!-- Sub menu -->
                <ul>
                    <li class="sub-menu"><a href="{{route('role.index')}}"><i class="glyphicon glyphicon-briefcase"></i>
                            Roles</a></li>
                </ul>
                <ul>
                    <li class="sub-menu"><a href="{{route('register')}}"><i class="fa fa-address-book"
                                                                            aria-hidden="true"></i>
                            Add Instructor</a></li>
                </ul>
                <ul>
                    <li class="sub-menu"><a href="{{route('news.index')}}"><i class="fa fa-newspaper-o"
                                                                            aria-hidden="true"></i> Add News</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div> <!-- ADMIN SIDE NAV-->