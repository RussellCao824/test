<?php
/**
 * php实现一些数据结构问题
 * Created by PhpStorm.
 * User: czn
 * Date: 19-1-4
 * Time: 下午4:48
 */


/**
 * 使用php  Iterator接口来实现对类中(私有的)属性的数组式遍历访问
 * Class
 */
class ergodicObject implements Iterator
{
    //对象属性的遍历指针
    private $position = 0;
    //对象属性的遍历数组(可将各个私有属性的地址指针传进此数组中,进行引用遍历,实现对象对属性的数组式遍历)
    private $attrArray = ['haha','gaga','jajia'];

    //获取下一个属性
    public function next()
    {
        ++$this->position;
    }

    //遍历复位
    public function rewind()
    {
        $this->position = 0;
    }

    //判断该属性是否存在(也就是遍历的结束条件)
    public function valid()
    {
        return isset($this->attrArray[$this->position]);
    }

    //获取当前的属性值
    public function current()
    {
        return $this->attrArray[$this->position];
    }

    //获取当前的属性名称
    public function key()
    {
        return $this->position;
    }
}


//$obj = new ergodicObject();
////实现对象私有属性的数组式遍历
//foreach ($obj as $key=>$value){
//    echo $key.'=>'.$value.'<br>';
//}


/**
 * 使用php实现队列结构
 * Class Queue
 */
class Queue
{
    //存储队列数据的数组
    private $queue;
    //队列的长度
    private $queueLength;


    /**
     * 初始化队列
     * Queue constructor.
     */
    public function __construct()
    {
        $this->queue = array();
        $this->queueLength = 0;
    }

    public function queuePrint()
    {
        try{
            return $this->queue;
        }catch (ErrorException $e){
            $e->getMessage();
        }
    }

    /**
     * 入队
     */
    public function pull($element)
    {
        try{
            array_push($this->queue,$element);
            ++$this->queueLength;
            return true;
        }catch (ErrorException $e){
            return false;
        }
    }

    /**
     * 出队
     */
    public function push()
    {
        try{
            //对于键名是递增数字的数组，array_shift($array）删除第一个元素，并且剩下元素的键名都会重新排列，并返回删除的值
            $head = array_shift($this->queue);
            --$this->queueLength;
            return $head;
        }catch (ErrorException $e){
            echo $e->getMessage();
        }
    }

    /**
     * 获取队列队首元素值
     */
    public function getHead()
    {
        try{
            return $this->queue[0];
        }catch (ErrorException $e){
            echo $e->getMessage();
        }
    }

    /**
     * 判断队列是否为空
     */
    public function queueEmpty()
    {
        return $this->queueLength == 0?true:false;
    }


    /**
     * 获取队列长度
     * @return int
     */
    public function queueLength()
    {
        return $this->queueLength;
    }

    /**
     * 将队列置空
     */
    public function queueClean()
    {
        try{
            $this->queue = array();
            $this->queueLength = 0;
            return true;
        }catch (ErrorException $e){
            $e->getMessage();
        }

    }


    /**
     * 销毁队列
     */
    public function queueDestroy()
    {
        try{
            unset($this->queue);
            unset($this->queueLength);
            return true;
        }catch (ErrorException $e){
            $e->getMessage();
        }
    }
}


//$queue = new Queue();
////进队
//var_dump($queue->pull(1));
////获取队首元素
//var_dump($queue->getHead());
////再进队
//var_dump($queue->pull('hah'));
////判断队列是否为空并获取队列长度
//var_dump($queue->queueEmpty());
//var_dump($queue->queueLength());
////出队并获取队列长度
//var_dump($queue->push());
//var_dump($queue->queueLength());
////打印队列
//var_dump($queue->queuePrint());
////清空队列并打印
//var_dump($queue->queueClean());
//var_dump($queue->queuePrint());
////销毁队列,并打印
//var_dump($queue->queueDestroy());
//var_dump($queue->queuePrint());


/**
 * 双向队列(实现需要使用四大php数组函数)
 * 1.头部进:array_unshift()
 * 2.尾部进:array_push()
 * 3.头部出:array_shift()
 * 4.尾部出:array_pop()
 * Class Dequeue
 */
class Dequeue
{
    private $queue;

    public function __construct()
    {
        $this->queue = array();
    }


    /**
     * 队头进
     * @param $element
     * @return bool
     */
    public function pullHead($element)
    {
        try{
            //array_unshift()函数实现了从数组头部插入元素,并重置键名
            array_unshift($this->queue,$element);
            return true;
        }catch(ErrorException $e){
            return false;
        }
    }

    /**
     * 队尾进
     * @param $element
     * @return bool
     */
    public function pullTail($element)
    {
        try{
            array_push($this->queue,$element);
            return true;
        }catch(ErrorException $e){
            return false;
        }
    }


    /**
     * 队头出
     * @return mixed|string
     */
    public function pushHead()
    {
        try{
            //array_shift()函数从数组头部删除元素,并重置键名
            return array_shift($this->queue);
        }catch(ErrorException $e){
            return $e->getMessage();
        }
    }


    /**
     * 队尾出
     * @return mixed|string
     */
    public function pushTail()
    {
        try{
            return array_pop($this->queue);
        }catch(ErrorException $e){
            return $e->getMessage();
        }
    }


    /**
     * 打印队列
     * @return array
     */
    public function printQueue()
    {
        return $this->queue;
    }

}

$queue = new Dequeue();
echo '头部进队';
$queue->pullHead('a');
var_dump($queue->printQueue());
echo '尾部进队';
$queue->pullTail('b');
var_dump($queue->printQueue());
echo '头部出队';
$queue->pushHead();
var_dump($queue->printQueue());
echo '尾部出队';
$queue->pushTail();
var_dump($queue->printQueue());
