@inject('request', 'Illuminate\Http\Request')
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Styles -->
    <!--Loading bootstrap css-->
    <link type="text/css" rel="stylesheet" href="{{asset('fonts/opensans.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('fonts/oswald.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bars/jquery-ui-1.10.4.custom.min.css')}}">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bars/bootstrap.min.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bars/animate.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bars/main.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bars/style-responsive.css')}}">
    <link type="text/css" rel="stylesheet" href="{{asset('css/bars/jquery.news-ticker.css')}}">
</head>
<body>
<div>
    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#"><i class="fa fa-angle-up"></i></a>
    <!--END BACK TO TOP-->
    <!--BEGIN TOPBAR-->
    <div id="header-topbar-option-demo" class="page-header-topbar">
        <nav id="topbar" role="navigation" style="margin-bottom: 0;" data-step="3"
             class="navbar navbar-default navbar-static-top">
            <div class="navbar-header">
                <button type="button" data-toggle="collapse" data-target=".sidebar-collapse" class="navbar-toggle"><span
                            class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span
                            class="icon-bar"></span><span class="icon-bar"></span></button>
                <a id="logo" href="{{route('home')}}" class="navbar-brand"><span class="fa fa-rocket"></span><span
                            class="logo-text">FCI-H Module</span><span style="display: none"
                                                                       class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <div class="news-update-box hidden-xs"><span
                            class="text-uppercase mrm pull-left text-white">News:</span>
                    <ul id="news-update" class="ticker list-unstyled">
                        <li>Welcome to KAdmin - Responsive Multi-Style Admin Template</li>
                    </ul>
                </div>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img
                                    src="{{Auth::user()->avatar}}" alt="" class="img-responsive img-circle"/>&nbsp;<span
                                    class="hidden-xs">{{ ucfirst(Auth::user()->name) }}</span>&nbsp;<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="{{ route('profile') }}"><i class="fa fa-user"></i>My Profile</a></li>
                            <li class="divider"></li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fa fa-key"></i>Log Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                            </li>
                            <br>
                            <br>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>
    </div>
    <!--END TOPBAR-->
    <div id="wrapper">
        <!--BEGIN SIDEBAR MENU-->
        <nav id="sidebar" role="navigation" data-step="2"
             data-intro="Template has &lt;b&gt;many navigation styles&lt;/b&gt;"
             data-position="right" class="navbar-default navbar-static-side">
            <div class="sidebar-collapse menu-scroll">
                <ul id="side-menu" class="nav">

                    <div class="clearfix"></div>
                    <li class="{{ $request->segment(1) == 'dashboard' ? 'active' : '' }}"><a
                                href="{{ route('home') }}"><i
                                    class="fa fa-tachometer fa-fw">
                                <div class="icon-bg bg-orange"></div>
                            </i><span class="menu-title">@lang('module.bars.sidebar_dashboard')</span></a></li>
                    <li class="{{ $request->segment(1) == 'courses' ? 'active' : '' }}"><a
                                href="{{ route('courses.index') }}"><i
                                    class="fa fa-graduation-cap" aria-hidden="true">
                                <div class="icon-bg bg-pink"></div>
                            </i><span class="menu-title">Courses</span></a>

                    </li>
                    @if(Auth::user()->isInstructor())
                        <li class="{{ $request->segment(1) == 'quizzes' ? 'active' : '' }}"><a
                                    href="{{route('quizzes.index')}}"><i
                                        class="fa fa-exclamation fa-fw">
                                    <div class="icon-bg bg-green"></div>
                                </i><span class="menu-title">@lang('module.bars.sidebar_quizzes')</span></a>

                        </li>
                        <li class="{{ $request->segment(1) == 'problems' ? 'active' : '' }}"><a href="Forms.html"><i
                                        class="fa fa-code fa-fw">
                                    <div class="icon-bg bg-violet"></div>
                                </i><span class="menu-title">@lang('module.bars.sidebar_problems')</span></a>

                        </li>
                        <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a href="Charts.html"><i
                                        class="fa fa-bar-chart-o fa-fw">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">Charts</span></a>

                        </li>
                    @endif
                    @if(Auth::user()->isStudent())
                        <li class="{{ $request->segment(1) == 'results' ? 'active' : '' }}"><a
                                    href="{{route('results.index')}}"><i
                                        class="fa fa-th-list fa-fw">
                                    <div class="icon-bg bg-blue"></div>
                                </i><span class="menu-title">@lang('module.bars.sidebar_results')</span></a>

                        </li>
                    @endif
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a href="DataGrid.html"><i
                                    class="fa fa-database fa-fw">
                                <div class="icon-bg bg-red"></div>
                            </i><span class="menu-title">Data Grids</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a href="Pages.html"><i
                                    class="fa fa-file-o fa-fw">
                                <div class="icon-bg bg-yellow"></div>
                            </i><span class="menu-title">Pages</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a href="Extras.html"><i
                                    class="fa fa-gift fa-fw">
                                <div class="icon-bg bg-grey"></div>
                            </i><span class="menu-title">Extras</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a href="Dropdown.html"><i
                                    class="fa fa-sitemap fa-fw">
                                <div class="icon-bg bg-dark"></div>
                            </i><span class="menu-title">Multi-Level Dropdown</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a href="Email.html"><i
                                    class="fa fa-envelope-o">
                                <div class="icon-bg bg-primary"></div>
                            </i><span class="menu-title">Email</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a href="Animation.html"><i
                                    class="fa fa-slack fa-fw">
                                <div class="icon-bg bg-green"></div>
                            </i><span class="menu-title">Animations</span></a></li>
                </ul>
            </div>
        </nav>
        <!--END SIDEBAR MENU-->
        <!--BEGIN PAGE WRAPPER-->
        <div id="page-wrapper">
            <!--BEGIN TITLE & BREADCRUMB PAGE-->
            <div id="title-breadcrumb-option-demo" class="page-title-breadcrumb">
                <div class="page-header pull-left">
                    <div class="page-title">
                        {{ ucfirst($request->segment(1)) }}
                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a href="{{ route('home') }}">Home</a>&nbsp;&nbsp;<i
                                class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li class="hidden"><a href="#">{{ ucfirst($request->segment(1)) }}</a>&nbsp;&nbsp;<i
                                class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li class="active">{{ ucfirst($request->segment(1)) }}</li>
                </ol>
                <div class="clearfix">
                </div>
            </div>
            <!--END TITLE & BREADCRUMB PAGE-->
            <!--BEGIN CONTENT-->
            <div class="page-content">
                <div id="tab-general">
                    <div id="sum_box" class="row mbl">
                        <!--Content-->
                        <div class="container-fluid">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!--END CONTENT-->
            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="copyright">
                    <a href="http://themifycloud.com">2017 © FCI-H Module</a></div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END PAGE WRAPPER-->
    </div>
</div>
<!-- /#wrapper -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script src="{{asset('js/app.js')}}"></script>
<script src="{{asset('js/bars/jquery-1.10.2.min.js')}}"></script>
<script src="{{asset('js/bars/jquery-migrate-1.2.1.min.js')}}"></script>
<script src="{{asset('js/bars/jquery-ui.js')}}"></script>
<script src="{{asset('js/bars/bootstrap.min.js')}}"></script>
<script src="{{asset('js/bars/bootstrap-hover-dropdown.js')}}"></script>
<script src="{{asset('js/bars/html5shiv.js')}}"></script>
<script src="{{asset('js/bars/respond.min.js')}}"></script>
<script src="{{asset('js/bars/jquery.metisMenu.js')}}"></script>
<script src="{{asset('js/bars/icheck.min.js')}}"></script>
<script src="{{asset('js/bars/custom.min.js')}}"></script>
<script src="{{asset('js/bars/jquery.news-ticker')}}"></script>
<script src="{{asset('js/bars/jquery.slimscroll.js')}}"></script>
<script src="{{asset('js/bars/jquery.cookie.js')}}"></script>
<script src="{{asset('js/bars/jquery.menu.js')}}"></script>
<script src="{{asset('js/bars/responsive-tabs.js')}}"></script>
<!--CORE JAVASCRIPT-->
</body>
</html>