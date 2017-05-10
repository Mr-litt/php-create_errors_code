<?php

/**
 * Application.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    2017/5/9
 */

include "app/helpful/ErrorCode.php";
include "../src/create_code/Application.php";
use app\helpful\ErrorCode;
use create_code\Application;

$option = [
    "target"=>new ErrorCode(),  //错误文件类
    "root"=>__DIR__,    //项目根目录
    "min"=>10000,    //选填，生成错误码基数,默认10000
];

(new Application($option))->run();