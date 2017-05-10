<?php

/**
 * Application.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    2017/5/9
 */

namespace app\service;
use app\helpful\ErrorCode;

/**
 * 类演示文件
 * Class SiteService
 * @package app\service
 */
class SiteService
{

    public function index(){
        $existError = true;
        if($existError){
            echo ErrorCode::ERROR_DEMO1;//错误标识1
            echo ErrorCode::ERROR_DEMO2;//错误标识2
        }
    }
}