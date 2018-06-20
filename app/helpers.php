<?php
/**
 * Created by PhpStorm.
 * User: chen
 * Date: 18-4-6
 * Time: 下午11:18
 */

use HyperDown\Parser;

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

if ( !function_exists('markdown_to_html') ) {
    /**
     * 把markdown转为html
     *
     * @param $markdown
     * @return mixed|string
     */
    function markdown_to_html($markdown)
    {
        // 正则匹配到全部的iframe
        preg_match_all('/&lt;iframe.*iframe&gt;/', $markdown, $iframe);
        // 如果有iframe 则先替换为临时字符串
        if (!empty($iframe[0])) {
            $tmp = [];
            // 组合临时字符串
            foreach ($iframe[0] as $k => $v) {
                $tmp[] = '【iframe'.$k.'】';
            }
            // 替换临时字符串
            $markdown = str_replace($iframe[0], $tmp, $markdown);
            // 将iframe转义
            $replace = array_map(function ($v){
                return htmlspecialchars_decode($v);
            }, $iframe[0]);
        }
        // markdown转html
        $parser = new Parser();
        $html = $parser->makeHtml($markdown);
        $html = str_replace('<code class="', '<code class="lang-', $html);
        // 将临时字符串替换为iframe
        if (!empty($iframe[0])) {
            $html = str_replace($tmp, $replace, $html);
        }
        return $html;
    }
}

if (!function_exists('frontend_view_path')) {
    /**
     * Get admin url.
     *
     * @param string $path
     *
     * @return string
     */
    function frontend_view_path($path = '')
    {
        return 'frontend'.'.'.trim($path, '.');
    }
}