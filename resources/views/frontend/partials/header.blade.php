<header>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#">Laravel</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <form class="navbar-form visible-xs">
                    <div class="form-group">
                        <div class="input-group input-group-md">
                            <input type="search" class="search-field form-control" value="" name="keyword">
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-default">
                                    <span class="ipt-icon-search"><i class="fa fa-search"></i></span>
                                </button>
                            </span>
                        </div>
                    </div>
                </form>

                <ul class="nav navbar-nav">
                    <li class="active"><a href="{{ url('/') }}">首页</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#contact">Contact</a></li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Dropdown <span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="#">Action</a></li>
                            <li><a href="#">Another action</a></li>
                            <li><a href="#">Something else here</a></li>
                            <li role="separator" class="divider"></li>
                            <li class="dropdown-header">Nav header</li>
                            <li><a href="#">Separated link</a></li>
                            <li><a href="#">One more separated link</a></li>
                        </ul>
                    </li>
                </ul>

                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('login') }}">登 录</a>
                        </li>

                        <li class="nav-item">
                            <a class="nav-link" href="{{ url('register') }}">注 册</a>
                        </li>
                    @else
                        <li class="dropdown nav-item user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown" aria-expanded="false">

                                <img src="{{ Auth::user()->avatar }}" class="user-avatar" alt="avatar">

                                <span class="">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li>
                                    <a class="dropdown-item" href="#"><i class="fa fa-user"></i> 个人中心</a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="#"><i class="fa fa-gear"></i> 设 置</a>
                                </li>

                                <li>
                                    <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> 注 销
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>

                        <li class="nav-item">
                            <a class="" href="{{ url('register') }}">投 稿</a>
                        </li>
                    @endguest
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</header>