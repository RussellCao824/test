<?php
/**
 * Created by PhpStorm.
 * User: czn
 * Date: 19-1-3
 * Time: 下午2:20
 */
//ini_set('memory_limit','2048M');
class Sort
{
    //待排序数组
    public $array;
    //数组排序的依据,增序为"asc"(默认),减序为"desc"
    public $order;

    /**
     * Sort constructor.
     */
    public function __construct($array,$order='asc')
    {
        $this->array = $array;
        $this->order = $order;
    }


    /**
     * 冒泡排序(时间复杂度为n方)
     */
    public function bubbleSort()
    {
        //数组长度为1或为空数组时,返回false,数组不变
        if(count($this->array) <= 1){
            return false;
        }
        for($i=1;$i<count($this->array);$i++){
            for($j=0;$j<(count($this->array)-$i);$j++){
                //增序排列
                if($this->order == 'asc'){
                    if($this->array[$j]>$this->array[$j+1]){
                        $tem = $this->array[$j];
                        $this->array[$j] = $this->array[$j+1];
                        $this->array[$j+1] = $tem;
                    }
                }else{//倒叙排列
                    if($this->array[$j]<$this->array[$j+1]){
                        $tem = $this->array[$j];
                        $this->array[$j] = $this->array[$j+1];
                        $this->array[$j+1] = $tem;
                    }
                }
            }
        }
    }


    /**
     * 选择排序
     */
    public function selectSort()
    {
        //数组长度为1或为空数组时,返回false,数组不变
        if(count($this->array) <= 1){
            return false;
        }
        $selectStart = 0;
        $selectEnd = count($this->array)-1;
        while($selectStart < $selectEnd){
            for($i=$selectStart+1;$i<=$selectEnd;$i++){
                //增序排列
                if($this->order == 'asc'){
                    if($this->array[$i]<$this->array[$selectStart]){
                        $tem = $this->array[$i];
                        $this->array[$i] = $this->array[$selectStart];
                        $this->array[$selectStart] = $tem;
                    }
                }else{//倒叙排列
                    if($this->array[$i]>$this->array[$selectStart]){
                        $tem = $this->array[$i];
                        $this->array[$i] = $this->array[$selectStart];
                        $this->array[$selectStart] = $tem;
                    }
                }
            }
            $selectStart++;
        }
    }


    /**
     * 插入排序
     */
    public function insertSort()
    {
        //数组长度为1或为空数组时,返回false,数组不变
        if(count($this->array) <= 1){
            return false;
        }
        //无序子序列的开始指针
        $unOrderStart = 1;
        //有序子序列的结束指针
        $orderEnd = 0;
        //依次遍历无序序列的第一个元素
        for($m=1;$m<count($this->array);$m++){
            //升序排列
            if($this->order == 'asc'){
                //拿无序序列的首元素依次与有序序列元素进行比较
                for($i=0;$i<=$orderEnd;$i++){
                    if($this->array[$unOrderStart] < $this->array[$i]){
                        //首先设置临时变量记录要挪动位置的无序序列第一个元素
                        $tem = $this->array[$unOrderStart];
                        //遍历剩余的有序数组,将其元素位置都加1
                        for($j=$unOrderStart;$j>$i;$j--){
                            $this->array[$j] = $this->array[$j-1];
                        }
                        //最后将无序数组的第一个值赋给第一个小于该元素的位置
                        $this->array[$i] = $tem;
                        //将无序序列第一个元素的数据进行位置移动后,(位置确定后),直接跳出该循环
                        break;
                    }

                }
            }else{//减序排列
                for($i=0;$i<=$orderEnd;$i++){
                    if($this->array[$unOrderStart] > $this->array[$i]){
                        //首先设置临时变量记录要挪动位置的无序序列第一个元素
                        $tem = $this->array[$unOrderStart];
                        //遍历剩余的有序数组,将其元素位置都加1
                        for($j=$unOrderStart;$j>$i;$j--){
                            $this->array[$j] = $this->array[$j-1];
                        }
                        //最后将无序数组的第一个值赋给第一个小于该元素的位置
                        $this->array[$i] = $tem;
                        break;
                    }

                }
            }
            $unOrderStart++;
            $orderEnd++;
        }
    }


    /**
     *快速排序(使用递归方法)
     * @param $arr
     * @return array
     */
    public function quickSort($arr) {
        //先判断是否需要继续进行
        $length = count($arr);
        if($length <= 1) {
            return $arr;
        }
        //如果没有返回，说明数组内的元素个数 多余1个，需要排序
        //选择一个标尺
        //选择第一个元素
        $base_num = $arr[0];
        //遍历 除了标尺外的所有元素，按照大小关系放入两个数组内
        //初始化两个数组
        $left_array = array();//小于标尺的
        $right_array = array();//大于标尺的
        for($i=1; $i<$length; $i++) {
            //增序排列
            if($this->order == 'asc'){
                if($base_num > $arr[$i]) {
                    //放入左边数组
                    $left_array[] = $arr[$i];
                } else {
                    //放入右边
                    $right_array[] = $arr[$i];
                }
            }else{//倒序排列
                if($base_num > $arr[$i]) {
                    //放入左边数组
                    $right_array[] = $arr[$i];
                } else {
                    //放入右边
                    $left_array[] = $arr[$i];
                }
            }
        }
        //再分别对 左边 和 右边的数组进行相同的排序处理方式
        //递归调用这个函数,并记录结果
        $left_array = $this->quickSort($left_array);
        $right_array = $this->quickSort($right_array);
        //合并左边 标尺 右边
        return array_merge($left_array, array($base_num), $right_array);
    }

}

$array = [2,3,4,7,5,54,-2];
$sort =new Sort($array,'desc');
print_r($sort->quickSort($array));

