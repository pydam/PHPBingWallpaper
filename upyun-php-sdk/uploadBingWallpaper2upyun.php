<?php
// 又拍云 设置
// 包含文件
require_once('vendor/autoload.php');

use Upyun\Upyun;
use Upyun\Config;

// 创建实例
$bucketConfig = new Config('您的服务名', '您的操作员名', '您的操作员密码');
$client = new Upyun($bucketConfig);

// 读文件
// $file = true;
$file = fopen('http://workspace.damonwang.cn/bing.php?day=0', 'r');    
// 这里缺文件判断，判断 $file 文件是否正常
$remoteDomain = 'https://upyun-cdn.damonwang.cn/';

// 当前日期
$day = '/blog/bing/'.(date("Ymd",time())).'.jpg';

// 上传文件
$res = $client->write($day, $file);

// 返回结果
if ( array_key_exists('x-upyun-content-type',$res) ) {
    $type = explode('/', $res['x-upyun-content-type']);
    if ($type[0] == 'image') {
        $out['code'] = 0;
        $out['msg'] = 'success';
        $out['data'] = $remoteDomain.$day;
    }else {
        $out['code'] = 201;
        $out['msg'] = 'upload no-image file';
        $out['data'] = $remoteDomain.$day;
    }
}else{
        $out['code'] = 401;
        $out['msg'] =  'fail';
        $out['data'] =  'none';
}
echo( json_encode($out) );
?>