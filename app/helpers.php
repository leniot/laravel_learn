<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-4-6
 * Time: 下午11:18
 */

if (!function_exists('admin_base_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_base_path($path = '')
    {
        $prefix = '/'.trim(config('admin.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        return $prefix.'/'.trim($path, '/');
    }
}

if (!function_exists('admin_view_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function admin_view_path($path = '')
    {
        $prefix = trim(config('admin.route.prefix'), '/');

        $prefix = ($prefix == '/') ? '' : $prefix;

        return $prefix.'.'.trim($path, '.');
    }
}

if (!function_exists('admin_toastr')) {

    /**
     * Flash a toastr message bag to session.
     *
     * @param string $message
     * @param string $type
     * @param array  $options
     *
     * @return string
     */
    function admin_toastr($message = '', $type = 'success', $options = [])
    {
        $toastr = new \Illuminate\Support\MessageBag(get_defined_vars());

        \Illuminate\Support\Facades\Session::flash('toastr', $toastr);
    }
}

if (!function_exists('admin_asset')) {

    /**
     * @param $path
     *
     * @return string
     */
    function admin_asset($path)
    {
        return asset($path, config('admin.secure'));
    }
}

if (!function_exists('strCut')) {
    //$str为要进行截取的字符串，$length为截取长度（汉字算一个字，字母算半个字）
    function strCut($str, $length)
    {
        $str = trim($str);
        $string = "";
        if(strlen($str) > $length)
        {
            for($i = 0 ; $i < $length ; $i++)
            {
                if (ord($str) > 127) {
                    $string .= $str[$i] . $str[$i+1] . $str[$i+2];
                    $i = $i + 2;
                } else{
                    $string .= $str[$i];
                }
            }
            $string .= "...";

            return $string;
        }
        return $str;
    }
}