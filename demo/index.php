<?php
/**
 * Created by IntelliJ IDEA.
 * User: tao
 * Date: 2017/5/9
 * Time: 19:13
 */

include "app/helpful/ErrorCode.php";
include "../src/create_code/Application.php";
use app\helpful\ErrorCode;
use create_code\Application;

$option = [
    "target"=>new ErrorCode(),  //错误文件类
    "root"=>__DIR__,    //项目根目录
];

(new Application($option))->run();