<?php

/**
 * Application.php
 *
 * @author  Mr.litt<137057181@qq.com>
 * @date    17-5-9
 */

namespace create_code;

class Application
{
    private $errorClass = null;
    private $webRoot = "";
    private $minNum = 10000;

    public function __construct($config)
    {
        try{
            if(!isset($config["target"]) || !is_object($config["target"])){
                throw new \Exception("请选择需要生成的错误类对象");
            }
            if(!isset($config["root"]) || !is_dir($config["root"])){
                throw new \Exception("请选择项目跟路径");
            }
            $this->errorClass = $config["target"];
            $this->webRoot = $config["root"];
            if(isset($config["min"]) && $config["min"]>0){
                $this->minNum = intval($config["min"]);
            }
        }catch (\Exception $e){
            $this->errorReport($e->getMessage());
        }
    }

    public function run(){
        try{

            try{
                $reflection = new \ReflectionClass($this->errorClass);
            }catch (\Exception $e){
                throw new \Exception("类不存在");
            }

            $classNameSpaceName = $reflection->getNamespaceName();
            $tmp = explode("\\",$reflection->getName());
            $className = end($tmp);
            $classPath = $reflection->getFileName();
            if(!is_writable($classPath)){
                throw new \Exception("文件不可写");
            }

            echo "start generate...\n";
            $start = $className.'::';
            $return = shell_exec("find $this->webRoot -name '*.php' ! -path './vendor' | xargs grep '$start'");
            $arr = explode("\n",$return);
            $codeList = [];
            foreach($arr as $str){
                $str = str_replace(array(" "),array(""),$str);
                $match = [];
                $result = preg_match("/$start(.*?)[,|)|;]/s",$str,$match);
                if(isset($match[1])){
                    $codeList[$match[1]] = 1;
                }
            }

            $max = $this->minNum;
            $write_list = [];
            foreach($reflection->getConstants() as $const_name=>$val){
                $write_list[$const_name] = $val;
                unset($codeList[$const_name]);
                if($val>$max) $max = $val;
            }
            foreach ($codeList as $name=>$val){
                $write_list[$name] = ++$max;
            }
            $template = <<<EOT
<?php
/**
 * 自动生成的文件 ,请不要手动修改.
 * @Author:\$Id$
 */

namespace $classNameSpaceName;

class $className
{

EOT;
            foreach($write_list as $name=>$val) {
                $template.="    const $name = $val;\n";
            }
            $template .= "}";
            file_put_contents($classPath,$template);
            echo "sucess\n";

        }catch (\Exception $e){
            $this->errorReport($e->getMessage());
        }
    }


    private function errorReport($msg){
        echo $msg."\n";
        exit;
    }
}