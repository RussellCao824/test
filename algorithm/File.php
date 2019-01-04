<?php
/**
 * php文件处理类
 * Created by PhpStorm.
 * User: czn
 * Date: 19-1-4
 * Time: 上午11:44
 */

class File
{

    /**
     * 遍历某个目录中所有的子文件以及子文件夹(使用递归)(在类方法中使用递归时,尽量使用方法内部定义的变量和该方法的参数,而不是类中的属性,否则,递归过程中,容易出现错误)
     * opendir()用来打开一个目录的句柄,成功返回句柄(resource),失败返回false
     * readdir($resource)用来遍历读取每个目录中的文件或者目录,成功返回文件或目录名称,失败返回false,(此处判断要用!==,因为在Linux中,文件名称可能是false)
     * is_dir(判断路径名是否是一个目录,是返回true,否则false)
     * @param $dir
     * @return array
     */
    public function getDirList($dir)
    {
        $dirList = array();//将数组初次定义在递归函数的内部,可以使每次递归调用该函数时,使该数组被子递归重新初始化调用
            if(($oh = opendir($dir)) != false){//判断是否成功获取文件打开句柄(当有权限问题时,会出现警告提示)
                while (($sonDir = readdir($oh)) !== false){
                    if($sonDir != '.' && $sonDir != '..'){
                        //判断该子文件是否是目录
                        if(is_dir($dir.'/'.$sonDir)){//若为目录则继续进行递归调用
                            $dirList[$sonDir] = $this->getDirList($dir.'/'.$sonDir);
                        }else{//若不为目录,曾将其加入数组
                            $dirList[] = $sonDir;//用该语法将元素推入数组之中
                        }
                    }
                }
                //在关闭文件句柄时,必须保证该句柄已经被打开存在
                closedir($oh);
                return $dirList;
            }
    }


    /**
     * 获取典型url中各个部分的数据,如文件名,扩展名等部分信息
     * @param $url
     * @return mixed
     */
    public function analyzeUrl($url)
    {
        //1.使用url中'/'分割和参数'?'分割的特点进行扩展名的获取
        //获取url的末尾部分
        $urlEnd = end(explode('.',end(explode('/',$url))));
        //考虑url中待参数的情况
        return explode('?',$urlEnd)[0];
//        //2.使用php内置url分析函数进行处理
//        $urlArray = parse_url($url);
//        $exName = basename($urlArray['path']);
//        return end(explode('.',$exName));
    }


    /**
     * 实现对含有中文字符串的正常截取()
     * @param $string
     * @return string
     */
    public function cutString($string)
    {
//        //使用substr函数,若字符串中含有中文字符,则可能截取的值是乱码
//        return substr($string,1,2);
        //使用mb_substr函数,可以指定该函数的第4个参数来指定字符串的编码类型,若指定为utf8时,则可以识别中文,将每个中文字符视为一个长度
        return mb_substr($string,1,2,'utf8');
    }

}

$file = new File();
//print_r($file->getDirList('/var/www'));
//$t1 = microtime();
//echo $file->analyzeUrl('http://localhost/test/algorithm/File.php');
//$t2 = microtime();
//echo $t2 - $t1;
echo $file->cutString('我爱1,中国');