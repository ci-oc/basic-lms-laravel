{{-- Side Navigation --}}
<div class="col-md-3">
    <div class="sidebar content-box" style="display: block;">
        <ul class="nav">
            <!-- Main menu -->
            <li class="current"><a href="{{route('admin.index',$valid_url)}}"><i class="glyphicon glyphicon-home"></i>
                    @lang('module.bars.sidebar_dashboard')</a></li>
            <li class="submenu">
                <a href="">
                    <i class="fa fa-users"></i>@lang('administration.bars.sidebar_user_management')<span class="caret pull-right"></span>
                </a>
                <!-- Sub menu -->
                <ul>
                    <li class="sub-menu"><a href="{{route('user.index')}}"><i class="fa fa-user"></i>
                            @lang('administration.bars.sidebar_users')</a></li>
                </ul>
                <!-- Sub menu -->
                <ul>
                    <li class="sub-menu"><a href="{{route('role.index')}}"><i class="glyphicon glyphicon-briefcase"></i>
                            @lang('administration.bars.sidebar_roles')</a></li>
                </ul>
                <ul>
                    <li class="sub-menu"><a href="{{route('register')}}"><i class="fa fa-address-book"
                                                                            aria-hidden="true"></i>
                            @lang('administration.bars.sidebar_add_instructor')</a></li>
                </ul>
                <ul>
                    <li class="sub-menu"><a href="{{route('news.index')}}"><i class="fa fa-newspaper-o"
                                                                            aria-hidden="true"></i> @lang('administration.bars.sidebar_add_news')</a></li>
                </ul>
                <ul>
                    <li class="sub-menu"><a href="{{route('securityQuestions.index2')}}"><i class="fa fa-shield"
                                                                              aria-hidden="true"></i> @lang('administration.bars.sidebar_security_questions')</a></li>
                </ul>
                <ul>
                    <li class="sub-menu"><a href="{{route('Judge.index')}}"><i class="fa fa-cogs"
                                                                                            aria-hidden="true"></i> @lang('administration.bars.sidebar_judge_configuration')</a></li>
                </ul>
            </li>

        </ul>
    </div>
</div> <!-- ADMIN SIDE NAV-->