@extends('frontend::layouts.layout')
<style>
    .profile-user-img {
        margin: 0 auto;
        width: 100px;
        padding: 3px;
        border: 3px solid #d2d6de;
    }
    .img-circle {
        border-radius: 50%;
    }
</style>
@section('content')

    <div class="main-container container">

        <!-- Content -->
        <div class="row">
            <div class="col-lg-4">
                <div class="box">
                    <div class="box-body box-profile" style="text-align: center;">
                        <img class="profile-user-img img-responsive img-circle" src="{{ $user->avatar }}" alt="User profile picture">

                        <h3 class="profile-username text-center">{{ $user->name }}</h3>
                    </div>

                    <hr>

                    <div class="widget widget_nav_menu">
                        <ul>
                            <li><a class="active" href="about.html">我的主页</a></li>
                            <li><a href="contact.html">我的文章</a></li>
                            <li><a href="categories.html">我的收藏</a></li>
                        </ul>
                    </div>
                    <!-- /.box-body -->
                </div>
            </div> <!-- end posts -->

            <!-- Posts -->
            <div class="col-lg-8">
                <div class="widget">
                    <h3 class="widget-title">
                        个人档案
                        <span class="profile__heading-edit pull-right  btn btn-xs" data-type="base"><i class="fa fa-pencil" aria-hidden="true"></i>编辑</span>
                    </h3>

                    <hr>
                    <div class="row">
                        <div class="col-lg-6 mt-20">
                            <div class="mb-10">
                                <label>用户名：</label>
                                <span>{{ $user->name }}</span>
                            </div>

                            <div class="mb-10">
                                <label>手机号：</label>
                                <span>{{ $user->mobile }}</span>
                            </div>
                        </div>
                        <div class="col-lg-6 mt-20">
                            <div class="mb-10">
                                <label>昵称：</label>
                                <span>{{ $user->nickname }}</span>
                            </div>

                            <div class="mb-10">
                                <label>邮箱：</label>
                                <span>{{ $user->email }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end posts -->

        </div> <!-- end content -->

    </div> <!-- end main container -->

@endsection
