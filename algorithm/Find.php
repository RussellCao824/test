<?php
/**
 * 查找类
 * Created by PhpStorm.
 * User: czn
 * Date: 19-1-4
 * Time: 上午9:57
 */

class Find
{
    public $array = array();//查找数组
    public $key;//待查找关键字
    public $findStart;//二分搜索范围开始索引
    public $findEnd;//二分查找搜索范围的结束索引
    public $middle;//二分查找的中间位置索引

    public function __construct($array,$key)
    {
        $this->array = $array;
        $this->key = $key;
        $this->findStart = 0;
        $this->findEnd = count($array)-1;
    }


    /**
     * 二分查找(使用while循环的普通过程式查找)
     * @return string
     */
    public function binSearch()
    {
        //首先判断关键词和查找数组是否为空
        if(empty($this->array) || empty($this->key)){
            return '输入关键词或者数组有误';
        }

        //二分法的循环终止条件(查找区域的起始指针大于中止指针)
        while($this->findStart <= $this->findEnd){
            //初始化二分查找的中间索引(当二分查找的middle指针计算不对称时,一般采用向下取整)
            //php中有两个向下取整的函数,floor()和intval(),前者返回的是浮点型,不适用作为数组索引,后者返回整形
            $this->middle = intval(($this->findEnd + $this->findStart)/2);

            //采用三等,保证比较的严谨
            if($this->key === $this->array[$this->middle]){
                return '该值存在于该数组中,其所在位置索引为'.$this->middle;
            }

            //在变换二分区域时,在不论变换的查找区域的开始还是结束位置,都应该将其在middle的基础上加1或者减1,应为middle已经比较过,不应该再化为比较范围之内的数据
            //若查找值大于中间值,则该值位于middle索引之前,该更改findEnd的值为middle值减1
            if($this->key < $this->array[$this->middle]){
                $this->findEnd = $this->middle - 1;
                continue;
            }
            //若查找值小于中间值,则该值位于middle索引之后,该更改findStart的值为middle值加1
            if($this->key > $this->array[$this->middle]){
                $this->findStart = $this->middle + 1;
                continue;
            }
        }
        return '该值不存在于该数组中';
    }


    /**
     * 二分查找的递归使用方法
     * 将过程化的循环放在递归调用中,将函数的定义实现可重复使用
     * 递归就是层次的return接力循环调用
     * @return string
     */
    public function binSearchPro()
    {
        //首先判断关键词和查找数组是否为空
        if(empty($this->array) || empty($this->key)){
            return '输入关键词或者数组有误';
        }

        //二分法的循环终止条件(查找区域的起始指针大于中止指针)
        if($this->findStart <= $this->findEnd){
            //初始化二分查找的中间索引(当二分查找的middle指针计算不对称时,一般采用向下取整)
            //php中有两个向下取整的函数,floor()和intval(),前者返回的是浮点型,不适用作为数组索引,后者返回整形
            $this->middle = intval(($this->findEnd + $this->findStart)/2);

            //采用三等,保证比较的严谨
            if($this->key === $this->array[$this->middle]){
                return '该值存在于该数组中,其所在位置索引为'.$this->middle;
            }

            //在变换二分区域时,在不论变换的查找区域的开始还是结束位置,都应该将其在middle的基础上加1或者减1,应为middle已经比较过,不应该再化为比较范围之内的数据
            //若查找值大于中间值,则该值位于middle索引之前,该更改findEnd的值为middle值减1
            if($this->key < $this->array[$this->middle]){
                $this->findEnd = $this->middle - 1;
                return $this->binSearchPro();
            }
            //若查找值小于中间值,则该值位于middle索引之后,该更改findStart的值为middle值加1
            if($this->key > $this->array[$this->middle]){
                $this->findStart = $this->middle + 1;
                return $this->binSearchPro();
            }
        }else{
            return '该值不存在于该数组中';
        }

    }


    /**
     * 顺序查找
     * @return string
     */
    public function orderFind()
    {
        foreach ($this->array as $key=>$data){
            if($this->key === $data){
                return '该值存于数组中,其索引值为:'.$key;
            }
        }
        return '该值不存在数组中';
    }

}

$array = [1,2,3,4,5,6];
$find = new Find($array,-4);
echo $find->orderFind();