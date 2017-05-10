<?php

namespace app\service;
use app\helpful\ErrorCode;

/**
 * Created by IntelliJ IDEA.
 * User: tao
 * Date: 2017/5/9
 * Time: 20:45
 */

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
            echo ErrorCode::ERROR_DEMO1;
            echo ErrorCode::ERROR_DEMO1;
        }
    }
}