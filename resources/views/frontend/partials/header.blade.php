<!-- Navigation -->
<header class="nav">

    <div class="nav__holder nav--sticky">
        <div class="container relative">
            <div class="flex-parent">

                <!-- Side Menu Button -->
                <button class="nav-icon-toggle" id="nav-icon-toggle" aria-label="Open side menu">
                    <span class="nav-icon-toggle__box">
                        <span class="nav-icon-toggle__inner"></span>
                    </span>
                </button> <!-- end Side menu button -->

                <!-- Mobile logo -->
                <a href="index.html" class="logo logo--mobile d-lg-none">
                    <img class="logo__img" src="{{ asset('frontend/img/logo_mobile.png') }}" srcset="{{ asset('frontend/img/logo_mobile.png') }} 1x, {{ asset('frontend/img/logo_mobile@2x.png') }} 2x" alt="logo">
                </a>

                <!-- Nav-wrap -->
                <nav class="flex-child nav__wrap d-none d-lg-block">
                    <ul class="nav__menu">

                        <li class="active">
                            <a href="{{ url('/') }}">主页</a>
                        </li>

                        {{--<li class="nav__dropdown">--}}
                            {{--<a href="#">Posts</a>--}}
                            {{--<ul class="nav__dropdown-menu">--}}
                                {{--<li><a href="single-post-gallery.html">Gallery Post</a></li>--}}
                                {{--<li><a href="single-post.html">Video Post</a></li>--}}
                                {{--<li><a href="single-post.html">Audio Post</a></li>--}}
                                {{--<li><a href="single-post-quote.html">Quote Post</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}

                        {{--<li class="nav__dropdown">--}}
                            {{--<a href="#">Pages</a>--}}
                            {{--<ul class="nav__dropdown-menu">--}}
                                {{--<li><a href="about.html">About</a></li>--}}
                                {{--<li><a href="contact.html">Contact</a></li>--}}
                                {{--<li><a href="search-results.html">Search Results</a></li>--}}
                                {{--<li><a href="categories.html">Categories</a></li>--}}
                                {{--<li><a href="404.html">404</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}

                        {{--<li class="nav__dropdown">--}}
                            {{--<a href="#">Features</a>--}}
                            {{--<ul class="nav__dropdown-menu">--}}
                                {{--<li><a href="lazyload.html">Lazy Load</a></li>--}}
                                {{--<li><a href="shortcodes.html">Shortcodes</a></li>--}}
                            {{--</ul>--}}
                        {{--</li>--}}

                        {{--<li>--}}
                            {{--<a href="#">Purchase</a>--}}
                        {{--</li>--}}

                    </ul> <!-- end menu -->
                </nav> <!-- end nav-wrap -->

                <!-- Nav Right -->
                <div class="nav__right nav--align-right d-lg-flex">

                    <!-- Socials -->
                    {{--<div class="nav__right-item socials nav__socials d-none d-lg-flex">--}}
                        {{--<a class="social social-facebook social--nobase" href="#" target="_blank" aria-label="facebook">--}}
                            {{--<i class="ui-facebook"></i> 登 录--}}
                        {{--</a>--}}
                        {{--<a class="social social-twitter social--nobase" href="#" target="_blank" aria-label="twitter">--}}
                            {{--<i class="ui-twitter"></i>--}}
                        {{--</a>--}}
                        {{--<a class="social social-google social--nobase" href="#" target="_blank" aria-label="google">--}}
                            {{--<i class="ui-google"></i>--}}
                        {{--</a>--}}
                    {{--</div>--}}

                    <div class="nav__right-item socials nav__socials d-none d-lg-flex">
                        @guest
                            <a href="{{ url('login') }}" class="btn btn-sm btn-color" style="margin-right: 5px;">登 录</a>

                            <a href="{{ url('register') }}" class="btn btn-sm btn-color">注 册</a>
                        @else
                            <div class="" style="margin-right:15px;float:left;">
                                <img alt="" src="{{ Auth::guard()->user()->avatar }}" class="avatar" style="width: 40px;height: 40px;margin-right: 5px;">
                                <a href="{{ url('profile/'.Auth::guard()->user()->id) }}">{{ Auth::guard()->user()->name }}</a>
                            </div>
                            <a href="#" class="btn btn-sm btn-color">发 文</a>
                        @endguest
                    </div>

                    <!-- Search -->
                    <div class="nav__right-item nav__search">
                        <a href="#" class="nav__search-trigger" id="nav__search-trigger">
                            <i class="ui-search nav__search-trigger-icon"></i>
                        </a>
                        <div class="nav__search-box" id="nav__search-box">
                            <form class="nav__search-form">
                                <input type="text" placeholder="搜索文章" class="nav__search-input">
                                <button type="submit" class="search-button btn btn-lg btn-color btn-button">
                                    <i class="ui-search nav__search-icon"></i>
                                </button>
                            </form>
                        </div>

                    </div>

                </div> <!-- end nav right -->

            </div> <!-- end flex-parent -->
        </div> <!-- end container -->

    </div>
</header>
<!-- end navigation -->