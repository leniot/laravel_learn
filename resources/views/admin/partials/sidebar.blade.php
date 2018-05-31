<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{{ Auth::guard('administrator')->user()->avatar }}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{{ Auth::guard('administrator')->user()->login_name }}</p>
                <!-- Status -->
                <a href="#"><i class="fa fa-circle text-success"></i>在 线</a>
            </div>
        </div>

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="搜索...">
                <span class="input-group-btn">
              <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
              </button>
            </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">菜 单</li>
            <!-- Optionally, you can add icons to the links -->
            <li>
                <a href="{{ admin_base_path('blog/articles') }}">
                    <i class="fa fa-book"></i>
                    <span>文章管理</span>
                </a>
            </li>
            <li>
                <a href="{{ admin_base_path('blog/tags') }}">
                    <i class="fa fa-book"></i>
                    <span>标签管理</span>
                </a>
            </li>

            <li>
                <a href="{{ admin_base_path('blog/categories') }}">
                    <i class="fa fa-book"></i>
                    <span>类别管理</span>
                </a>
            </li>
            {{--<li><a href="#"><i class="fa fa-link"></i> <span>Another Link</span></a></li>--}}

            <li class="treeview">
                <a href="#"><i class="fa fa-gear"></i> <span>系统设置</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{{ admin_base_path('auth/permissions') }}">
                            <i class="fa fa-ban"></i>
                            <span>权限管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ admin_base_path('auth/policies') }}">
                            <i class="fa fa-toggle-on"></i>
                            <span>权限策略</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ admin_base_path('auth/roles') }}">
                            <i class="fa fa-group"></i>
                            <span>角色管理</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ admin_base_path('auth/administrators') }}">
                            <i class="fa fa-user"></i>
                            <span>管理员</span>
                        </a>
                    </li>
                </ul>
            </li>

        </ul>
        <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>