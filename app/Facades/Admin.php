<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2018/6/13
 * Time: 11:45
 */

namespace App\Facades;


use Illuminate\Support\Facades\Facade;

/**
 * Class Admin
 * @package App\Facades
 */
class Admin extends Facade
{
    protected static function getFacadeAccessor()
    {
        return \App\Classes\Admin::class;
    }
}