<header>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">Laravel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars" aria-controls="navbars" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbars">

                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="#">首 页</a>
                    </li>

                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="http://example.com" id="dropdown07" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Dropdown</a>
                        <div class="dropdown-menu" aria-labelledby="dropdown07">
                            <a class="dropdown-item" href="#">Action</a>
                            <a class="dropdown-item" href="#">Another action</a>
                            <a class="dropdown-item" href="#">Something else here</a>
                        </div>
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

                                <span class="hidden-xs">{{ Auth::user()->login_name }}</span>
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
                            <a class="btn btn-sm btn-primary" href="{{ url('register') }}">投 稿</a>
                        </li>
                    @endguest
                </ul>

            </div>
        </div>
    </nav>
</header>