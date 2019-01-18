<?php
/**
 * Created by PhpStorm.
 * User: czn
 * Date: 19-1-5
 * Time: 下午4:41
 */
//1.一群猴子排成一圈，按1，2，...，n依次编号。然后从第1只开始数，数到第m只,把它踢出圈，
//从它后面再开始数，再数到第m只，在把它踢出去...，如此不停的进行下去，直到最后只剩下一只猴子为止，
//那只猴子就叫做大王。要求编程模拟此过程，输入m、n,输出最后那个大王的编号。（新浪）（小米）
/**
 * 使用php数组实现循环队列的定点元素去除问题
 * @param $n
 * @param $m
 */
function getMonkeyKing($n,$m)
{
    //range(low,height)函数通过指定下限和上限来创造连续整数的数组
    $monkey = range(1,$n);
    //定义计数器
    $count = 0;

    //异常处理
    if(count($monkey) == 0){
        return false;
    }

    //只剩一个猴子时退出循环
    while(count($monkey) > 1){
        //数每只猴子前,进行计数器的增加
        ++$count;
        //重点:数过的猴子使用array_shift()进行出队,并使用array_pop()将其加入到尾部,实现了圈型的循环队列的数据结构
        $outMonkey = array_shift($monkey);
        if($count % $m != 0){//根据计数器是否为m的倍数,将该计数器对应的元素去除出循环队列
            array_push($monkey,$outMonkey);
        }
    }

    //返回剩下的唯一元素
    return $monkey[0];
}

echo getMonkeyKing(10,3);