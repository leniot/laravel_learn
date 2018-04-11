<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AdminServiceProvider extends ServiceProvider
{
    /**
     * 路由中间件
     * @var array
     */
    protected $routeMiddleware = [
        'admin.auth' => \App\Http\Middleware\Admin\Authenticate::class,
        'admin.pjax' => \Spatie\Pjax\Middleware\FilterIfPjax::class,
        'admin.permission' => \App\Http\Middleware\Admin\Permission::class,
    ];

    /**
     * 中间件组
     * @var array
     */
    protected $middlewareGroups = [
        'admin' => [
            'admin.auth',
            'admin.pjax',
            'admin.permission',
        ],
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadViewsFrom(resource_path('views/admin'), 'admin');

        if (file_exists($routes = base_path('routes/admin.php'))) {
            $this->loadRoutesFrom($routes);
        }
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->loadAdminAuthConfig();

        $this->registerRouteMiddleWare();
    }

    /**
     * 注册路由中间件
     */
    public function registerRouteMiddleWare()
    {
        // 注册路由中间件
        foreach ($this->routeMiddleware as $key => $middleware) {
            app('router')->aliasMiddleware($key, $middleware);
        }

        // 注册路由中间件组
        foreach ($this->middlewareGroups as $key => $middleware) {
            app('router')->middlewareGroup($key, $middleware);
        }
    }

    /**
     * Setup auth configuration.
     *
     * @return void
     */
    protected function loadAdminAuthConfig()
    {
        config(array_dot(config('admin.auth', []), 'auth.'));
    }
}
