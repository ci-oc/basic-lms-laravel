<div class="header">
    <div class="container">
        <div class="row">
            <div class="col-md-5">
                <li>
                    {!! Form::open(['method' => 'POST', 'route' => ['lang'], 'enctype' => 'multipart/form-data'])!!}
                    <select name="locale" onchange="this.form.submit()">
                        <option value="en" {{ App::getLocale() == 'en' ? 'selected' : '' }}>English
                        </option>
                        <option value="ar" {{ App::getLocale() == 'ar' ? 'selected' : ''}}>Arabic
                        </option>
                    </select>
                    {{ csrf_field() }}

                    {!! Form::close() !!}
                </li>
            </div>
            <div class="col-md-5">
                <!-- Logo -->
                <div class="logo">
                    <h1><a href="{{route('admin.index',$valid_url)}}">Administration</a></h1>
                </div>
            </div>

            <div class="col-md-2 pull-right">
                <div class="navbar navbar-inverse" role="banner">
                    <nav class="collapse navbar-collapse bs-navbar-collapse navbar-right" role="navigation">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{Auth::user()->name}}<b
                                            class="caret"></b></a>
                                <ul class="dropdown-menu animated fadeInUp">
                                    <li><a href="{{url('/')}}">Front End</a></li>
                                    {{--<li><a href="{{url('/logout')}}">Logout</a></li>--}}
                                    <li>
                                        <div>
                                            <a class="dropdown-item" href="{{ url('/logout') }}" onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                                Logout
                                            </a>
                                            <form action="{{ url('/logout') }}" id="logout-form" method="POST"
                                                  style="display: none;">
                                                {{ csrf_field() }}
                                            </form>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>