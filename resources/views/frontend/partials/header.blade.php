<header class="header">
    <nav class="navbar navbar-default" id="navbar">
        <div class="container">
            <div class="header-topbar hidden-xs link-border">
                <ul class="site-nav topmenu">
                    {{--<li>--}}
                        {{--<a href="http://www.muzhuangnet.com/tags/">标签云</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="http://www.muzhuangnet.com/readers/" rel="nofollow">读者墙</a>--}}
                    {{--</li>--}}
                    {{--<li>--}}
                        {{--<a href="http://www.muzhuangnet.com/rss.html" title="RSS订阅">--}}
                            {{--<i class="fa fa-rss">--}}
                            {{--</i> RSS订阅--}}
                        {{--</a>--}}
                    {{--</li>--}}

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
                            <a href="#"><i class="fa fa-edit"></i> 写文章</a>
                        </li>
                    @endguest

                </ul>
                勤记录 懂分享
            </div>
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#header-navbar" aria-expanded="false"> <span class="sr-only"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                <h1 class="logo hvr-bounce-in">
                    <a href="{{ url('/') }}" title="laravel">
                        <img src="{{ asset('frontend/images/laravel.jpg') }}" class="logo" alt="laravel" style="width: 64px;">
                    </a>
                </h1>
            </div>
            <div class="collapse navbar-collapse" id="header-navbar">
                <ul class="nav navbar-nav navbar-right">
                    <li><a data-cont="木庄网络博客" title="木庄网络博客" href="index.html">首页</a></li>
                    <li><a data-cont="列表页" title="列表页" href="list.html">列表页</a></li>
                    <li><a data-cont="详细页" title="详细页" href="show.html">详细页</a></li>
                    <li><a data-cont="404" title="404" href="404.html">404</a></li>
                    <li><a data-cont="MZ-NetBolg主题" title="MZ-NetBolg主题" href="http://www.muzhuangnet.com/list/mznetblog/" >MZ-NetBolg主题</a></li>
                    <li><a data-cont="IT技术笔记" title="IT技术笔记" href="http://www.muzhuangnet.com/list/code/" >IT技术笔记</a></li>
                    <li><a data-cont="源码分享" title="源码分享" href="http://www.muzhuangnet.com/list/share/" >源码分享</a></li>
                    <li><a data-cont="靠谱网赚" title="靠谱网赚" href="http://www.muzhuangnet.com/list/money/" >靠谱网赚</a></li>
                    <li><a data-cont="资讯分享" title="资讯分享" href="http://www.muzhuangnet.com/list/news/" >资讯分享</a></li>
                </ul>
            </div>
        </div>
    </nav>
</header>