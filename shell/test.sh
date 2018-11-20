#!/bin/bash
echo "this is a shell tracvel"
#shell中的for循环，可以使用命令来隐式的给变量赋值
for file in $(ls /var | grep local);
do 
echo ${file}
done
#设置只读变量
name="caozhennan"
readonly name
echo ${name}
#name="zhuzhu"

#删除变量
room=1
echo ${room}
unset room
#删除之后，再输出会输出为空
echo ${room}

#双引号中可以使用变量，单引号中无论什么都会原样输出
score='very heigh'
echo "your score is ${score}"
echo 'your score is ${score}'

#获取字符串长度
school="jiuchnagzidixiaoxue"
echo ${#school}
#截取子字符串
echo ${school:1:5}
#查找子字符串，哪个字母先出现就返回该字母位置
index=`expr index ${school} ech`
echo ${index}

#定义数组并读取所有元素
array=(
	1
	2
	3
	4
)
echo ${array[@]}
#获得数组及单个元素的长度
#shell脚本的多行注释
:<<EOF
echo ${#array[@]}
echo ${#array[*]}
echo ${#array[1]}
EOF

#在调用脚本时，向shell脚本中传递参数,以$N的形式直接调用，n为参数输入时的序列
echo "the first param is $1"
echo "the second param is $2"
echo "the number of param is $#"

echo $$

#原生bash支持运算符，但是不知处运算的计算，需要用到expr和awk来进行求值
num=`expr 2 \* 8`
num1=`expr 1 \* 16`
if [ $num == $num1 ]
	then
	echo 'num 等于 num1'
fi
echo ${num}

#文件测试运算符
file_name="/usr/local"
if [ -d ${file_name} ]
	then
	echo "${file_name} is a dictionary"
fi

#echo的使用,从标准输入行中读取参数并引用该数值,-e才能开启echo的转义功能
read age
echo -e "my age is ${age} \n\n"
#显示命令的执行结果
echo `date`

#test命令的使用数值测试，字符串测试，文件测试
cd /usr/local/bash_reponsity
if test -e test.sh
	then
	echo "文件存在"
fi

#shell的逻辑判断流程控制
#在shell的逻辑判断流程中中，如果某个判断分支的操作为空，就不要写该分支，不能写出then，里面没有操作
#if判断语句
a=1
b=`expr 2 / 2`
if [ $a == $b]
	then
	echo "equel"
else
	echo "unequel"
fi

#for循环
for var in 1 2 3 4
do
	echo ${var}
done

#while循环
con=5
while test con = 0
do
	echo ${con}
	con=`expr ${con} - 1`
done

#case判断
echo "请输出你相对我说的话"
read message
case ${message} in
	1) echo "你真帅"
;;
2) echo "你真丑"
;;
esac


#shell定义函数
function test1(){
	echo "请输入参数"
	read param
	echo "您输入的参数为${param}"
}

test1