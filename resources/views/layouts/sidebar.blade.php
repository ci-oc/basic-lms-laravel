@inject('request', 'Illuminate\Http\Request')
        <!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>

    <noscript>
        <META HTTP-EQUIV="Refresh" CONTENT="0;URL={{route('noScript')}}">
    </noscript>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ucfirst(trans('module.bars.sidebar_' . $request->segment(1))) }}</title>
    <!-- Styles -->
    @include('layouts.css')
    {{--Data tables CSS--}}
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.1.1/css/responsive.dataTables.min.css">
    <link rel="stylesheet"
          href="https://cdn.datatables.net/select/1.2.0/css/select.dataTables.min.css"/>
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.4.0/css/buttons.dataTables.min.css">
    {{-------------------}}
    {{--DateTime Picker --}}
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/jquery-ui-timepicker-addon/1.4.5/jquery-ui-timepicker-addon.min.css"/>
    <link rel="stylesheet"
          href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.5.0/css/bootstrap-datepicker.standalone.min.css"/>
    {{------------}}
    @yield('css')

</head>
<body>
<div>
    <!--BEGIN BACK TO TOP-->
    <a id="totop" href="#" dir=""><i class="fa fa-angle-up"></i></a>
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
                            class="logo-text">FCI-H LMS</span><span style="display: none"
                                                                       class="logo-text-icon">µ</span></a></div>
            <div class="topbar-main"><a id="menu-toggle" href="#" class="hidden-xs"><i class="fa fa-bars"></i></a>
                <div class="news-update-box hidden-xs"><span
                            class="text-uppercase mrm pull-left text-white">@lang('module.bars.top-bar-news')</span>
                    <ul id="news-update" class="ticker list-unstyled">

                        @if(count($all_news) > 0 )
                            <marquee direction="right" scrollamount="5" behavior="scroll" onmouseover="this.stop()"
                                     onmouseout="this.start()">
                                @foreach($all_news as $news)
                                    <a href="" class="hvr-float">{{$news->news}}</a> <<i class="fa fa-newspaper-o"
                                                                                         aria-hidden="true"></i>>
                                @endforeach
                            </marquee>
                        @else
                            @lang('module.bars.top-bar-no-news')
                        @endif
                    </ul>
                </div>
                <ul class="nav navbar navbar-top-links navbar-right mbn">
                    <li>
                        {!! Form::open(['method' => 'POST', 'route' => ['lang'], 'enctype' => 'multipart/form-data'])!!}
                        <select name="locale" onchange="this.form.submit()">
                            <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English
                            </option>
                            <option value="ar" {{ App::getLocale() == 'ar' ? 'selected' : ''}} >العربية
                            </option>
                        </select>
                        {{ csrf_field() }}

                        {!! Form::close() !!}
                    </li>
                    <li class="dropdown topbar-user"><a data-hover="dropdown" href="#" class="dropdown-toggle"><img
                                    src="{{asset(Auth::user()->avatar)}}" alt="" class="img-responsive img-circle"/>&nbsp;<span
                                    class="hidden-xs">{{ ucfirst(Auth::user()->name) }}</span>&nbsp;<span
                                    class="caret"></span></a>
                        <ul class="dropdown-menu dropdown-user pull-right">
                            <li><a href="{{ route('profile.index') }}"><i class="fa fa-user"
                                                                          aria-hidden="true"></i>@lang('module.bars.top-bar-profile')
                                </a></li>
                            <li class="divider"></li>
                            <a href="{{ route('logout') }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i
                                        class="fa fa-sign-out"
                                        aria-hidden="true"></i>@lang('module.bars.top-bar-logout')</a>
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

                    @if(Auth::user()->can('security-questions-read'))
                        <li class="{{ $request->segment(1) == 'securityQuestions' ? 'active' : '' }}"><a
                                    href="{{route('securityQuestions.index')}}"><i
                                        class="fa fa-bullhorn">
                                    <div class="icon-bg bg-green"></div>
                                </i><span class="menu-title">@lang('module.bars.sidebar_security_questions')</span></a>
                        </li>
                    @else

                        <li class="{{ $request->segment(1) == 'dashboard' ? 'active' : '' }}"><a
                                    href="{{ route('home') }}"><i
                                        class="fa fa-tachometer fa-fw">
                                    <div class="icon-bg bg-orange"></div>
                                </i><span class="menu-title">@lang('module.bars.sidebar_dashboard')</span></a></li>
                        @if(Auth::user()->can('add-announcement') or Auth::user()->can('view-announcement'))
                            <li class="{{ $request->segment(1) == 'announcements' ? 'active' : '' }}"><a
                                        href="{{route('announcements.index')}}"><i
                                            class="fa fa-bullhorn">
                                        <div class="icon-bg bg-green"></div>
                                    </i><span class="menu-title">@lang('module.bars.sidebar_announcements')</span></a>

                            </li>
                        @endif
                        @if(Auth::user()->can('join-course') or Auth::user()->can('create-course') or Auth::user()->can('edit-course') or Auth::user()->can('drop-quiz'))
                            <li class="{{ $request->segment(1) == 'courses' ? 'active' : '' }}"><a
                                        href="{{ route('courses.index') }}"><i
                                            class="fa fa-graduation-cap" aria-hidden="true">
                                        <div class="icon-bg bg-pink"></div>
                                    </i><span class="menu-title">@lang('module.bars.sidebar_courses')</span></a>

                            </li>
                        @endif
                        @if(Auth::user()->can('solve-quiz') or Auth::user()->can('create-quiz') or Auth::user()->can('edit-quiz') or Auth::user()->can('delete-quiz'))
                            <li class="{{ $request->segment(1) == 'quizzes' ? 'active' : '' }}"><a
                                        href="{{route('quizzes.index')}}"><i
                                            class="fa fa-exclamation fa-fw">
                                        <div class="icon-bg bg-green"></div>
                                    </i><span class="menu-title">@lang('module.bars.sidebar_quizzes')</span></a>

                            </li>
                        @endif
                        @if(Auth::user()->can('create-quiz'))
                            <li class="{{ $request->segment(1) == 'problems' ? 'active' : '' }}"><a
                                        href="{{route('problems.index')}}"><i
                                            class="fa fa-code fa-fw">
                                        <div class="icon-bg bg-violet"></div>
                                    </i><span class="menu-title">@lang('module.bars.sidebar_problems')</span></a>

                            </li>
                            <li class="{{ $request->segment(1) == 'questions' ? 'active' : '' }}"><a
                                        href="{{route('questions.index')}}"><i
                                            class="fa fa-sitemap fa-fw">
                                        <div class="icon-bg bg-dark"></div>
                                    </i><span class="menu-title">@lang('module.bars.sidebar_questions')</span></a>

                            </li>
                        @endif
                        @if(Auth::user()->can('add-students'))
                            <li class="{{ $request->segment(1) == 'users' ? 'active' : '' }}"><a
                                        href="{{route('users.create')}}"><i
                                            class="fa fa-users fa-fw">
                                        <div class="icon-bg bg-orange"></div>
                                    </i><span class="menu-title">@lang('module.bars.sidebar_users')</span></a>

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
                        @if(Auth::user()->can('view-course'))
                            <li class="{{ $request->segment(1) == 'enroll' ? 'active' : '' }}"><a
                                        href="{{ route('enroll.index') }}"><i
                                            class="fa fa-plus" aria-hidden="true">
                                        <div class="icon-bg bg-pink"></div>
                                    </i><span class="menu-title">@lang('module.bars.sidebar_enroll')</span></a>

                            </li>
                        @endif

                    @endif
                    <li class="{{ $request->segment(1) == 'submissions' ? 'active' : '' }}"><a
                                href="{{ route('submissions.index') }}"><i
                                    class="fa fa-database fa-fw">
                                <div class="icon-bg bg-red"></div>
                            </i><span class="menu-title">@lang('module.bars.sidebar_submissions')</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'plagiarism' ? 'active' : '' }}"><a
                                href="{{route('plagiarism')}}"><i
                                    class="fa fa-files-o" aria-hidden="true"></i><span
                                    class="menu-title">@lang('module.bars.sidebar_plagiarism')</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a
                                href="{{route('under_construction')}}"><i
                                    class="fa fa-bar-chart-o fa-fw">
                                <div class="icon-bg bg-orange"></div>
                            </i><span class="menu-title">Charts</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a
                                href="{{route('under_construction')}}"><i
                                    class="fa fa-gift fa-fw">
                                <div class="icon-bg bg-grey"></div>
                            </i><span class="menu-title">Extras</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a
                                href="{{route('under_construction')}}"><i
                                    class="fa fa-envelope-o">
                                <div class="icon-bg bg-primary"></div>
                            </i><span class="menu-title">Email</span></a>

                    </li>
                    <li class="{{ $request->segment(1) == 'tests' ? 'active' : '' }}"><a
                                href="{{route('under_construction')}}"><i
                                    class="fa fa-slack fa-fw">
                                <div class="icon-bg bg-green"></div>
                            </i><span class="menu-title">Slack</span></a></li>

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
                        {{ ucfirst(trans('module.bars.sidebar_' . $request->segment(1)))}}
                    </div>
                </div>
                <ol class="breadcrumb page-breadcrumb pull-right">
                    <li><i class="fa fa-home"></i>&nbsp;<a class="btn-xs btn-link"
                                                           href="{{ route('home') }}">@lang('module.bars.home')</a>&nbsp;&nbsp;<i
                                class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li class="hidden"><a href="#">{{ ucfirst($request->segment(1)) }}</a>&nbsp;&nbsp;<i
                                class="fa fa-angle-right"></i>&nbsp;&nbsp;
                    </li>
                    <li class="active"> {{ ucfirst(trans('module.bars.sidebar_' . $request->segment(1))) }}</li>
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
                        <div class="container-fluid" dir="{{ App::getLocale() == 'en' ? 'ltr' : 'rtl' }}">
                            @yield('content')
                        </div>
                    </div>
                </div>
            </div>
            <!--END CONTENT-->
            <!--BEGIN FOOTER-->
            <div id="footer">
                <div class="row">
                    <div class="col-xs-12">
                        <div class="col-sm-8">
                            <div class="copyright">
                                <a href="#">@lang('module.copyright')</a>
                            </div>
                        </div>
                        <div class="col-sm-4">
                            <a href="https://www.youtube.com/user/FCIHOCW" target="_blank">
                                <i style="font-size: large" class="icon fa fa-youtube fa-5x" aria-hidden="true"></i>
                            </a>
                            <a href="https://www.linkedin.com/edu/school?id=12171" target="_blank">
                                <i style="font-size: large" class="fa fa-linkedin" aria-hidden="true"></i>
                            </a>
                            <a href="http://fcih.helwan.edu.eg/index.php" target="_blank">
                                <i style="font-size: large" class="fa fa-globe" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <!--END FOOTER-->
        </div>
        <!--END PAGE WRAPPER-->
    </div>
</div>
@include('layouts.javascript')
<!--CORE JAVASCRIPT-->
@yield('javascript')
</body>
</html>