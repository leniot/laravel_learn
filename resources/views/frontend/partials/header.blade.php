<header id="top" role="banner" class="transition">
    <!--搜索弹窗 开始-->
    <div class="box">
        <div class="box2">
            <div class="icon icon-search-close js-show-search-box"><a class="close"></a></div>
            <div class="search-content overlay-dialog-animate">
                <div class="search-input">
                    <form role="search" method="get" action="/search.html" onsubmit="return checkinput()">
                        <button type="submit"></button>
                        <input placeholder="请输入关键字" name="s" id="search-input">
                    </form>
                </div>
                <div class="search-history hide" id="history">
                    <span>我的搜索历史</span>
                    <ul class="transition" id="history_ul">
                        <li class="transition"><a href="#">数码</a></li>
                        <li class="transition"><a href="#">科技</a></li>
                        <li class="transition"><a href="#">科技</a></li>
                        <li class="transition"><a href="#">互联网</a></li>
                        <li class="transition"><a href="#">汽车之家</a></li>
                    </ul>
                    <div class="pull-right empty-history js-empty-history">清空历史</div>
                </div>
                <div class="search-history search-hot">
                    <strong>热搜词</strong>
                    <ul>
                        <li class="transition"><a href="#">数码</a></li>
                        <li class="transition"><a href="#">科技</a></li>
                        <li class="transition"><a href="#">互联网</a></li>
                        <li class="transition"><a href="#">汽车之家</a></li>
                        <li class="transition"><a href="#">Uber</a></li>
                        <li class="transition"><a href="#">支付宝</a></li>
                        <li class="transition"><a href="#">大数据</a></li>
                        <li class="transition"><a href="#">创业</a></li>
                        <li class="transition"><a href="#">旅游</a></li>
                        <li class="transition"><a href="#">美团</a></li>
                        <li class="transition"><a href="#">社交</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!--搜索弹窗 结束-->
    <script>
        function checkinput(){
            var input = $("#search-input").val();
            if(input ==  null || input == ''){
                return false;
            }
            return true;
        }
    </script>

    <div class="container">
        <div class="navbar-header transition">
            <a href="#" title="首页"><img src="{{ asset('frontend/images/logo.png') }}" alt="{{ config('app.name', 'Laravel') }}" title="首页" /></a>
        </div>

        <ul class="nav navbar-nav navbar-left" id="jsddm">
            <li class="nav-news js-show-menu">
                <a href="#">资讯 <span class="caret"></span></a>
                <ul>
                    <li><a href="#" target="_blank">电商消费</a></li>
                    <li><a href="#" target="_blank">娱乐淘金</a></li>
                    <li><a href="#" target="_blank">雪花一代</a></li>
                    <li><a href="#" target="_blank">人工智能</a></li>
                    <li><a href="#" target="_blank">车与出行</a></li>
                    <li><a href="#" target="_blank">智能终端</a></li>
                    <li><a href="#" target="_blank">医疗健康</a></li>
                    <li><a href="#" target="_blank">金融地产</a></li>
                    <li><a href="#" target="_blank">企业服务</a></li>
                    <li><a href="#" target="_blank">创业维艰</a></li>
                    <li><a href="#" target="_blank">社交通讯</a></li>
                    <li><a href="#" target="_blank">全球热点</a></li>
                    <li><a href="#" target="_blank">生活腔调</a></li>
                </ul>
            </li>
            <style>
                #jsddm ul{position: absolute; visibility: hidden; background:#fff; width:250px;  top:60px; left:-50px; z-index:9999; box-shadow:0 1px 15px rgba(18,21,21,.2);padding:10px 5px;}
                #jsddm ul li{ float:left; width:105px; padding-left:20px; line-height:40px;}
            </style>
            <li class="nav-news"><a href="#" target="_blank">热议<span class="nums-prompt nums-prompt-topic"></span></a></li>
            <li class="nav-news"><a href="#" target="_blank">活动</a></li>
            <li class="nav-news"><a href="#" target="_blank">创业白板<span class="nums-prompt"></span></a></li>
            <li class="nav-news"><a href="#" target="_blank">会员专享<em class="nums-prompt"></em></a></li>
            <li class="nav-news"><a href="#" target="_blank">官方Blog</a></li>
        </ul>

        <ul class="nav navbar-nav navbar-right transition xiala main_nav">
            {{--<li class="app-guide js-app-guide" >--}}
                {{--<div class="app-guide-box">--}}
                    {{--<img src="images/1448211685.png">--}}
                    {{--<div class="app-guide-title">--}}
                        {{--<span>微信扫一扫</span><br>--}}
                        {{--<span>下载虎嗅APP</span>--}}
                    {{--</div>--}}
                {{--</div>--}}
                {{--<i class="icon icon-sm-phone"></i>APP下载<em class="guide-prompt"></em>--}}
            {{--</li>--}}
            <li class="search-li js-show-search-box">
                <a>
                    <i class="icon icon-search"></i>
                </a>
                <span>搜索</span>
            </li>

            @guest
            <li class="login-link-box">
                <a class="cd-signin">登录</a>
            </li>

            <li>
                <a class="cd-signup" >注册</a>
            </li>
            @endguest

            <li>
                <a class="cd-tougao">投稿</a>
            </li>
        </ul>
    </div>

    <div class="cd-user-modal">
        <div class="cd-user-modal-container">
            <div id="cd-login"> <!-- 登录表单 -->
                <div class="modal-alert-title">登录</div>
                <div class="register" >
                    <div class="register-top" id="reg-top"><i><a id="qrcode" href="#"></a></i></div>
                    <div class="register-con" id="rc">
                        <div class="login-form username-box " style="margin-top:52px;">
                            <a class="js-open-sms-login sms-text">短信快捷登录</a>
                            <label class="login-label transition" >
                                <input id="login_username" class="login-input" placeholder="手机号／邮箱／虎嗅账号">
                            </label>
                            <label class="login-label">
                                <input id="login_password" class="login-input password" type="password" placeholder="输入6～24位密码">
                            </label>
                            <a class="js-label-select label-select-box hide login-label-select text-center"><span class="js-country-user">+86</span><i class="icon-modal icon-l-caret"></i></a>
                            <div class="login-operation">
                                <label><input id="autologin" type="checkbox">&nbsp;2周内自动登录</label>
                                <a href="/user/reset_password" class="js-forget-passward pull-right">忘记密码</a>
                            </div>
                            <button class="js-btn-login btn-login">登&nbsp;录</button>
                        </div>
                        <div class="js-open-register register-text">极速注册</div>
                        <div class="third-box">
                            <div class="title"><span>第三方登录</span></div>
                            <a href="#"><i class="icon-modal icon-login-qq"></i></a>
                            <a class="js-login-switch"><i class="icon-modal icon-login-wx"></i></a>
                            <a href="#"><i class="icon-modal icon-login-wb"></i></a>
                            <a href="#"><i class="icon-modal icon-login-zfb"></i></a>
                        </div>
                    </div>
                </div>
                <div class="saoma" id="sm">
                    <div class="qr-code" style="text-align:center">
                        <div class="title">微信登录</div>
                        <div class="waiting panelContent">
                            <div class="wrp_code"><img class="qrcode lightBorder" src="images/150943753529.png"></div>
                            <div class="info">
                                <div class="status status_browser js_status" id="wx_default_tip">
                                    <p>请使用微信扫描二维码登录</p>
                                    <p>"虎嗅网"</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="screen-tu" id="screen"></div>
                </div>
            </div>

            <div id="cd-signup"> <!-- 注册表单 -->
                <div class="modal-alert-title">极速注册</div>
                <div class="user-register-box">
                    <div class="login-form sms-box">
                        <label class="login-label col-xs-label transition"><input id="sms_username" class="login-input username" placeholder="手机号"></label>
                        <div class="geetest_login_sms_box" >
                            <div id="geetest_1496454436837" class="gt_holder gt_float" style="touch-action: none;">
                                <div class="gt_slider">
                                    <div class="gt_guide_tip gt_show">按住左边滑块，拖动完成上方拼图</div>
                                    <div class="gt_slider_knob gt_show" style="left: 0px;"></div>
                                    <div class="gt_curtain_knob gt_hide">移动到此开始验证</div>
                                    <div class="gt_ajax_tip gt_ready"></div>
                                </div>
                            </div>
                        </div>
                        <label class="login-label captcha"><input id="sms_captcha" class="login-input" placeholder="输入6位验证码" maxlength="6">
                            <span class="js-btn-captcha btn-captcha">获取验证码</span></label>
                        <a class="js-label-select label-select-box text-center"><span class="js-country-sms">+86</span><i class="icon-modal icon-l-caret"></i></a>
                        <button class="js-btn-sms-login btn-login">注&nbsp;册</button>
                    </div>
                    <div class="js-user-login register-text">已有账号，立即登录</div>
                </div>
            </div>

            <a href="#" class="cd-close-form ">关闭</a>
        </div>
    </div>

    <script src="{{ asset('frontend/js/d-login.js') }}"></script>

    <div id="cd-signup"> <!-- 注册表单 -->
        <div class="modal-alert-title">极速注册</div>
        <div class="user-register-box">
            <div class="login-form sms-box">
                <label class="login-label col-xs-label transition"><input id="sms_username" class="login-input username" placeholder="手机号"></label>
                <div class="geetest_login_sms_box" >
                    <div id="geetest_1496454436837" class="gt_holder gt_float" style="touch-action: none;">
                        <div class="gt_slider">
                            <div class="gt_guide_tip gt_show">按住左边滑块，拖动完成上方拼图</div>
                            <div class="gt_slider_knob gt_show" style="left: 0px;"></div>
                            <div class="gt_curtain_knob gt_hide">移动到此开始验证</div>
                            <div class="gt_ajax_tip gt_ready"></div>
                        </div>
                    </div>
                </div>
                <label class="login-label captcha"><input id="sms_captcha" class="login-input" placeholder="输入6位验证码" maxlength="6">
                    <span class="js-btn-captcha btn-captcha">获取验证码</span></label>
                <a class="js-label-select label-select-box text-center"><span class="js-country-sms">+86</span><i class="icon-modal icon-l-caret"></i></a>
                <button class="js-btn-sms-login btn-login">注&nbsp;册</button>
            </div>
            <div class="js-user-login register-text">已有账号，立即登录</div>
        </div>
    </div>

</header>