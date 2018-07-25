<header class="header">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container">

            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false">
                    <span class="sr-only"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="" alt="logo">
                </a>
            </div>

            <div class="collapse navbar-collapse" id="header-navbar">

                <ul class="nav navbar-nav">
                    <li><a data-cont="" title="" href="{{ url('/') }}">首页</a></li>
                </ul>


                <ul class="nav navbar-nav navbar-right">
                    @guest
                        <li>
                            <a href="{{ url('login') }}" title="立即登录">立即登录</a>
                        </li>
                        <li>
                            <a href="{{ url('register') }}" title="免费注册">免费注册</a>
                        </li>
                    @else
                        <li class="dropdown">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                <!-- The user image in the navbar-->
                                <img src="{{ Auth::user()->avatar }}" class="user-image" alt="头像" style="width: 20px;border-radius: 50%;">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="">{{ Auth::user()->name }}</span>
                            </a>
                            <ul class="dropdown-menu">
                                <li style="padding: 10px; text-align: center;">
                                    <a href=""><i class="fa fa-user"></i> 我的主页</a>
                                </li>
                                <li style="padding: 10px; text-align: center;">
                                    <a href=""><i class="fa fa-gear"></i> 设置</a>
                                </li>
                                <li style="padding: 10px; text-align: center;">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                        <i class="fa fa-power-off"></i> 注销
                                    </a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </li>
                            </ul>
                        </li>
                        <li>
                            <a href="#"><i class="fa fa-edit"></i> 投稿</a>
                        </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
</header>