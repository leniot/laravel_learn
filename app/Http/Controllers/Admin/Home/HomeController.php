<?php

namespace App\Http\Controllers\Admin\Home;

use App\Http\Controllers\Admin\BaseController;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends BaseController
{
    public function index()
    {
        return view(admin_view_path('home.index'));
    }
}
