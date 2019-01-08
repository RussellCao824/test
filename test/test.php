<?php
/**
 * Created by PhpStorm.
 * User: czn
 * Date: 19-1-7
 * Time: 下午5:53
 */
/**
 * 1.php中的引用赋值.只是将指向该变量的指针值赋给了变量,所以在释放这个$b变量时,只是删除了存在变量b中的指针值,而并没有销毁真正的值,php中只有到一个值的所有指针变量都被释放之后,该变量才会被释放
*/
//$a = 1;
//$b = &$a;
//$b = 2;
//echo $a;
//unset($b);
//echo $a;


/**
 * 2.在php中使用exec(),system()函数来执行linux命令
 * exec($command,$resultArray,$status):$command:命令字符串,$resultArray:存储命令结果的回调数组,$status:执行成功返回0,否则返回1
 * system($command,$status),该函数直接返回结果数组,$status返回执行状态,成功为0,否则为1
 */
//$command = 'ls -al /var/www';
////exec($command,$array,$execStatus);
//var_dump(system($command,$status));
//var_dump($status);
//var_dump($execStatus);
//var_dump($array);


/**
 * 3.php中对于http请求一些常量的打印
 */
echo $_SERVER['HTTP_REFERER'];

/**
 * 4.echo print区别
 */
echo 'a','b';


/**
 * 5.php获取图片尺寸大小
 */
var_dump(getimagesize('http://www.runoob.com/wp-content/uploads/2014/11/redis.gif'));

/**
 * 6.常量的定义
 */
define('Score',60);
define('Score',70);//常量定义之后就不允许在重新定义更改其值
echo Score;

/**
 * 7.php序列化和逆序列化
 * serialize()与unserialize(),其实就相当于php内部的加强版json串,能把任何类型的数据加密,转为字符串,再转化出来
 */
$array = array('a','b',3,4);
echo serialize($array);
var_dump(unserialize(serialize($array)));

/**
 * 8.session与cookie能够完成的记录工作,redis与memcached等基本都可以更好,更安全的完成
 */


/**
 * 9.面向对象的三大特性:封装,继承,多态(方法重用)
 * php中的抽象类使用abstruct关键字进行标识(其中至少有一个方法是抽象方法,不能被实例化)
 * php接口 interface 定义,其中只能存在常量和抽象方法.接口中的常量在使用该接口的类中不能被再次重新定义覆盖
 * php类最多只能继承一个父类,但是可以同时继承(implements)多个接口,与函数重构结合弥补了php子类只能继承一个父类的缺陷
 *php类中的方法,不写函数体时,就是抽象函数
 */


/**
 * 10.include,require,include_once,require_once的区别
 * 区别在于处理操作失败的提示上
 * include出错会发出警告,但脚本继续运行,
 * require出错,会抛出致命错误,脚本停止运行.
 * include_once与require_once与上述差别一致,只是在前文已经include或者require过之后,不再执行此操作
 */


/**
 * 11.php中的一系列魔术方法
 */
//(1).类的构造函数和析构函数
class Test
{
    public $name;

    public function __construct()
    {
        $this->name = 'gag';
        print 'it consutruct ,the attribute of name is'.$this->name."\n";
    }

    /**
     * 注意析构函数的调用时机:在脚本中显示的销毁实例或者所有对于该实例的调用都被删除或者执行过之后(接下来不会有对该实例调用的任何可能),则该实例析够,调用析构函数
     *需要注意,父类的析构函数不会被php引擎暗中调用,必须在子类中显示调用(parent::__destruct()),父类才会析构
     */

    public function __destruct()
    {
        print 'the class of test has destroyed'."\n";
    }


    /**
     * __call()与__callStatic(),方法触发时机:在调用类中一个不可访问(没有定义或者没有权限)的方法(或静态方法)时触发调用
     */
    public function __call($name, $arguments)
    {
        echo 'you have call a method which is not unuseable'."\n";
    }


    public static function __callStatic($name, $arguments)
    {
        echo 'you have call a static method which is not unuseable'."\n";
    }


    /**
     * __set(),给类中不可访问(没有定义或者权限不够)属性赋值时,触发调用该方法
     * __get(),读取类中不可访问属性时,触发调用该方法
     * __isset(),给类中不可调用属性使用isset()或者empty()时,触发调用该函数
     * __unset(),给类中不可调用属性使用unset()时,触发该函数
     * 这几个方法与上述call,callStatic方法更像是构建了php类中的异常处理方法群,或者是缺省处理
     */

    public function __set($name, $value)
    {
        echo 'you have set '.$value.'to '.$name.'which is not useful'."\n";
    }

    public function __get($name)
    {
        echo 'you have get the attribute of '.$name.'which is not useful'."\n";
    }

    public function __isset($name)
    {
        echo 'you have validate the attribute of '.$name.'which is not useful'."\n";
    }

    public function __unset($name)
    {
        echo 'you have unset the attribute of '.$name.'which is not useful'."\n";
    }

    /**
     * serialize()函数可以对任何类型的数据进行字符串化,包括实例化的对象,在对对象进行编码时进行调用
     */
    public function __sleep()
    {
        echo 'get the method sleep'."\n";
        return array('name');
    }

    /**
     * 在将实例化的对象进行编码之后解码时进行调用
     */
    public function __wakeup()
    {
        echo 'get the method wakeup'."\n";
    }


    /**
     * 当对象被以字符串的形式返回时,触发调用,必须返回字符串
     */
    public function __toString()
    {
        return 'the name of this class is Test'."\n";
    }


    public function __invoke($param)
    {
        echo 'you has get this object for function ,the param is'.$param."\n";
    }
}

$test = new Test();
$test->noMethod();
Test::noStaticMethod();

$test->age = 23;
echo $test->age;
var_dump(isset($test->age));
unset($test->age);

echo serialize($test);

var_dump((unserialize(serialize($test))->name));
echo $test;

$test(4);