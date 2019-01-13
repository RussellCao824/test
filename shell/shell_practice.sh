#!bin/bash -xv
:<<!
    练习一：写一个脚本
    1.设定变量FILE的值为/etc/passwd
    2.依次向/etc/passwd中的每个用户问好，并且说出对方的ID是什么
    形如：（提示：LINE=`wc -l /etc/passwd | cut -d" " -f1`)
     Hello,root，your UID is 0.
    3.统计一个有多少个用户
!



##方法一(使用计数器来遍历文章内容)
##将文件路径放入变量中
#FILE="/etc/passwd"
#
#
##根据/etc/passwd中文件内容的格式,先获取文件中的行数(即用户的总数)
##先使用wc -l file来获取文件中内容的行数(返回行数后,还会返回文件名)
##使用 "|"来在上个命令的基础上进行串行命令操作
##使用cut命令来对数据进行截取获取,-d "param"来指定截取数据的分隔符,-f number来获取要保留前多少个截取内容
#userNumber=`wc -l $FILE | cut -d " " -f 1`
#
#
#
##使用seq命令,seq n m,生成从n到m的整数序列,作为for循环的判断条件
##所有的shell变量在定义时都是单词本身,但在定义过后开始调用的时候,则需要加上shell
##使用for i in queue do done循环,来对数据进行遍历输出
#for i in `seq 1 $userNumber`
#do
#    #使用基于父命令操作结果的链式命令操作附"|"来依次操作去除用户名和用户id
#    #使用命令head -n file 来取出前n行的数据,在此结果基础之上,使用tail -j命令取出后j行数据来取出精确的数据行
#    userName=`head -$i $FILE | tail -1 | cut -d ":" -f 1`
#    userId=`head -$i $FILE | tail -1 | cut -d ":" -f 3`
#    echo "dear user $userName,your id is $userId"
#done
#echo "the number of all user is $userNumber"

:<<!
1.切换工作目录至/var
      2.依次向/var目录中的每个文件或子目录问好，形如：
      3.统计/var目录下共有多个文件，并显示出来
!

##切换目录
#cd /var
#FileSum=0;
##向子目录或者子文件夹问好
#for SonFile in `ls /var`
#do
#    echo "hello,$SonFile"
#    #shell中不支持数学计算.所以不能直接写为$FileSum+1,要在外面加上$[],这样才能够使用其他命令来进行数学运算
#    FileSum=$[$FileSum+1]
#done
#echo "the sum number of file is $FileSum"



:<<!
练习三：写一个脚本
      1.设定变量file的值为/etc/passwd
      2.使用循环读取文件/etc/passwd的第2,4,6,10,13,15行，并显示其内容
      3.把这些行保存至/tmp/mypasswd文件中
!

#file="/etc/passwd"
##设置要取的行数数组
#line=(2 4 6 10 13 15)
##创建文件mypasswd,在bash中可以直接使用bash命令
#touch /tmp/mypasswd
##获取数组
#lineNumber=${#line[*]}
##循环遍历行数数组
#for i in `seq 1 $lineNumber`
#do
#    #使用exec命令创建文件标示符并打开对文件的操作流
#    #一个>号对于文件做的时写入操作(不是追加操作)
#    #exec 4>/tmp/mypasswd
#    #两个大于号对于文件做的是追加操作
#    exec 4>>/tmp/mypasswd
#    #获取每行数据
#    lineData=`head -${line[$i]} $file | tail -1`
#    echo "$lineData"
#    echo "$lineData" >&4
#    #关闭文件操作标示符(每次操作完成之后关闭该文件标示符)
#    exec 4>&-
#done


:<<EOF
练习四：写一个脚本
传递两个整数给脚本，让脚本分别计算并显示这两个整数的和，差，积，商
EOF

##如何在执行脚本的时候给脚本传递参数,脚本中怎么引用到传递进来的参数
#echo "the first param is $1"
#echo "the second param is $2"
#echo "两数的和,差,积,商分别为:"
##bash shell本身时不支持基本数学运算的,但是通过调用其他函数可以实现,如下时调用的简化
#echo $[$1+$2]
#echo $[$1-$2]
#echo $[$1*$2]
#echo $[$1/$2]


:<<EOF
练习五
    写一个脚本：
       1.创建目录/tmp/scripts
       2.切换工作目录至此目录中
       3.复制/etc/pam.d目录至当前目录，并重命名为test
       4.将当前目录的test及其里面的文件和子目录的属主改为redhat
       5.将test及其子目录中的文件的其它用户的权限改为没有任何权限
EOF

#mkdir /tmp/scripts
#cd /tmp/scripts
##在写脚本时,如果不知道是否有权限,就加入sudo,注意cd命令前不能加入sudo
##注意cp命令的用法:
##1.将文件复制进目录时,cp file destination(目标目录不存在时,自动创建文件)
##2.将文件复制进另一个文件时,cp file1 file2(目标文件不存在时,则自动创建目录,若存在,系统会提示是否选择覆盖文件原内容)
##3.将目录中的内容复制进另一个目录 cp -r dic1 dic2(若目标目录不存在,则自动创建,若已经存在,则应使用cp -r dic1/. dic2)
#sudo cp -r /etc/pam.d ./test
##更改文件,目录的所有者和所属群组:chmod chgrp -R参数为包含旗下的所有文件和目录.chmod命令也一样
##注意:更改文件的所属用户和用户组时,新指定的用户名和用户组一定要是存在的,否则将会出错
#sudo chown -R czn ./test
##对应权限分数:读写执行,4,2,1
#sudo chmod -R 000 ./test
#echo "动作执行成功"



:<<EOF
练习六
    写一个脚本
       1.显示当前系统日期和时间，而后创建目录/tmp/lstest
       2.切换工作目录至/tmp/lstest
       3.创建目录a1d，b56e，6test
       4.创建空文件xy，x2y，732
       5.列出当前目录下以a，x或者6开头的文件或目录
       6.列出当前目录下以字母开头，后跟一个任意数字，而后跟任意长度字符的文件或目录
EOF

#date
#sudo mkdir /tmp/lstest
#cd /tmp/lstest
#sudo mkdir a1d b56e 6test
#sudo touch xy x2y 732
##shell中的常用正则([abc],是个匹配字符的集合,通配符是*),[[:alpha:]]是指字母,[[:digit:]]是指数字,[[:alnum:]]是指字母或者数字
#ls [ax6]*
#echo "运行成功"
#ls . | grep [[:alpha:]][[:digit:]][[:alpha:]]*
#echo "运行成功"



:<<EOF
练习七
    写一个脚本
        添加10个用户user1到user10，但要求只有用户不存在的情况下才能添加
EOF

#for i in `seq 1 10`
#do
#    #判断是否有该用户,没有则创建
#    #不论有或者没有,存在情况的查询信息和不存在情况的标准错误输出都会被定向到一个无底洞/dev/null或者其他文件中,而不在终端上显示
#    #> >>两个命令都是将内容重定向,>将重定向目的地文件先清空,然后在将内容写入到目的地,>>是将内容追加到重定向文件的末尾.
#    #在linux中,有三种标准的输入输出流,分别为:标准输入(STDIN),标准输出(STDOUT),标准错误输出(STDERR)分别用常量0,1,2表示,在linux中,只要是没有得到预想结果的输出,均为标准错误输出,譬如说查找某个文件夹,无此文件夹,则为标准错误输出,认为该条命令返回了否
#    #0>>  1>>  2>>  &>> 分别代表将标准输入,标准输出,标准错误信息,所有信息都定向输出到某个文件中
#    #/dev/null可以看作是linux中的无底洞,很多不想在终端显示的提示信息都可以重定向放进这里面
#    # shell命令的逻辑是非判断以及运算符&& 与 ||的使用:&&与的关系,只有前面的命令成功了,才会执行下面的命令,||或关系,前面的命令执行成功后,就不会执行后面的命令,优先级:&& > ||
#    #head tail 命令实现了对文件内容的定行查看(也就是横向查看)
#    #cut 命令实现对文件内容的纵向查看,两者结合,可以实现准确定位
#    #useradd name 添加用户  userdel  name删除用户
#    cut -d ':' -f 1 /etc/passwd | grep "user$i" &>>/tmp/err || sudo useradd user$i
#done
#echo "用户添加成功,请查看用户列表"
#cut -d ':' -f 1 /etc/passwd

:<<EOF
练习八
    写一个脚本
        删除10个用户user1到user10，但要求只有用户只有在存在的情况下才能删除
EOF

#for i in `seq 1 10`
#do
#    cut -d ':' -f 1 /etc/passwd | grep "user$i" &>>/tmp/err && sudo userdel user$i
#done
#echo "user1 -- user10 删除成功,请查看用户列表"
#cut -d ':' -f 1 /etc/passwd


:<<EOF
练习九
    写一个脚本
       通过ping命令测试192.168.0.151到192.168.0.254之间的所有主机是否在线
       如果在线，就显示“ip is up”
       如果不在线，就显示“ip is down”
EOF

#ping 命令 -c 1 表示只重复发送ping命令的次数,-W表示每次ping的超时时间,一般为10ms
#for i in `seq 103 110`
#do
#    ping -c 1 -W 5  192.168.1.$i &>>/dev/null && echo "192.168.1.$i is up" || echo "192.168.1.$i" is down
#done


:<<EOF
练习十
    如何在脚本中获取脚本名称
EOF
##0这个参数就代表shell脚本的名称
#echo $0
##如何检查之前的命令是否运行成功,成功返回0,不成功返回1(和一般的逻辑刚好相反)
#echo $?
#
##获取文件的最后一行,/etc/passwd
#tail -1 /etc/passwd
#
##获取文件的第一行
#head -1 /etc/passwd
#
##获取一个文件内容的总行数(在使用wc -l命令时,同时会返回文件的名称,和行数之间有个空格)
#
#wc -l /etc/passwd | cut -d ' ' -f 1
#
##获取文件每一行的第三个元素,/etc/passwd
#
##cut -d ':' -f 3 /etc/passwd
###使用awk,来对各行进行列处理更加简单,进行格式化处理输出
##awk -F ':' '{print $0}' /etc/passwd
#
##如果每行的第一个元素是root,则获取第二个元素,否则不获取,awk的脚本中可以直接写简单的条件判断
#awk -F ':' '{if($1!="root") print $2}' /etc/passwd


:<<EOF
练习十一
    声明一个函数()
    脚本的传入参数在函数定义中是不能调用的,函数只能调用自己的参数,和脚本内调用传入参数的形式一样
    shell函数的参数不用声明,直接在调用函数时传递,和向脚本传参和调用的方式一样
EOF

function test()
{
    #$1为该函数的第一个参数
    echo $1
}
#调用函数时进行传参
test 2

#连接连个字符串,(直接连续输出两个变量,无空格)
str1="my"
str2="baby"
echo $str1$str2

#进行两个整数的四则运算(shell中该方法不适用于浮点数的运算)
num1=9
num2=3
echo $[$num1+$num2]
echo $[$num1-$num2]
echo $[$num1*$num2]
echo $[$num1/$num2]

