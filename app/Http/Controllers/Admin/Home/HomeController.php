<?php

namespace App\Http\Controllers\Admin\Home;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        return view(admin_view_path('home.index'));
    }
}
