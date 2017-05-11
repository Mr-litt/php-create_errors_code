# php-create_errors_code

## Description
这是一个生成PHP错误码的工具类。

借用Linux下Xargs命令在项目所有文件中寻找错误码类标识的常量，处理之后生成新的错误码类文件。
 
## Feature

 - 自动搜寻项目中的错误码；
 - 根据已有错误码生成新的错误码类文件；
 - 不影响已定义的错误码；
 - 详细的错误报告，一切交互都一目了然；

## Requirement

1. Linux(windows下不支持xargs命令)
2. PHP >= 5.4.0

> 本应用到对所使用的框架并无特别要求

## Installation

1. [composer](http://www.phpcomposer.com/)安装
```shell
composer require mr-litt/create_errors_code
```

2. 直接安装
```shell
# change into app library directory
cd php/app/library

# clone repository into app library dir
git clone https://github.com/Mr-litt/php-create_errors_code.git
```

## Usage

基本使用(此处可结合demo):

1. 生成你的错误类文件

```php
<?php

namespace app\helpful;

class ErrorCode
{
    const MY_DEFINE_ERROR = 403;    //自己定义的错误码
}
```

2. 在你项目里使用定义错误标识

```php
<?php

namespace app\service;
use app\helpful\ErrorCode;

class SiteService
{
    public function index(){
        $existError = true;
        if($existError){
            echo ErrorCode::ERROR_DEMO1;    //错误标识1
            echo ErrorCode::ERROR_DEMO2;    //错误标识2
        }
    }
}
```


3. 使用CreateErrorsCode类生成错误码

```php
<?php

use app\helpful\ErrorCode;
use create_code\CreateErrorsCode;

$option = [
    "target"=>new ErrorCode(),  //错误文件类
    "root"=>__DIR__,    //项目根目录
    "min"=>10000,    //选填，生成错误码基数,默认10000
];

(new CreateErrorsCode($option))->run();
```

## Demo

文件目录说明：
```
    app //你的应用目录
        -helpful
            -ErrorCode.php  //生成你的错误类文件
            ...
        -service
            -SiteSerive.php //在你项目里使用定义错误标识
            ...
        index.php   //使用CreateErrorsCode类生成错误码
```

## License

MIT