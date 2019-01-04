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


$obj = new ergodicObject();
//实现对象私有属性的数组式遍历
foreach ($obj as $key=>$value){
    echo $key.'=>'.$value.'<br>';
}


/**
 * 使用php实现队列结构
 * Class Queue
 */
class Queue
{
    //存储队列数据的数组
    private $queue = array();
    //队列的长度
    public $queueLength = 0;

    /**
     * 入队
     */
    public function push()
    {

    }

    /**
     * 出队
     */
    public function pull()
    {

    }

    /**
     * 获取队列队首元素值
     */
    public function getFront()
    {

    }

    /**
     * 判断队列是否为空
     */
    public function validateEmpty()
    {

    }

    /**
     * 将队列置空
     */
    public function reset()
    {

    }
}