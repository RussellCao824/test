<?php
/**
 * Created by PhpStorm.
 * User: 曹振南
 * Date: 2018/10/26
 * Time: 13:10
 */

/*
 * TP中，每个控制器文件在创建生成的时候，框架都会根据该控制器的位置自动默认匹配根据规定生成的命名空间，
 * 若在该控制器中定义控制器时，没有声明namespace或者没有根据tp框架的namespace规定来声明namespace，则写入该控制器文件的控制器都不会
 * 在该系统默认命名空间中被找到。
 */
namespace app\index\controller;
/*
 * 当声明过namespace之后，在引用其他类的时候，若不在同一个namespace之下，则需要根据引用类所在的namespace，使用use关键字来
 * 进行跨namespace的类引入。
 */
use app\admin\controller\Test;

//若控制器的名字过长，需要驼峰式命名时，在url访问时，需要小写并把驼峰变为_，如take_test
class TakeTest extends Test
{
    public function demo()
    {
        return "it is another controller";
    }
}