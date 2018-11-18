<?php
/**
 * 初始化redis类
 */
    $redis = new Redis();
    //连接redis服务断
    echo($redis->connect("127.0.0.1",6379));//php链接redis-server成功之后，会返回true，输出为1
    $redis->set("name","Russell");
    $name = $redis->get("name");
    echo "the name has saved in redis is:".$name.PHP_EOL;

    /**
     * php_redis的一些简单命令操作
     */

    /**
     * 无序集合
     */
    //向集合中添加元素并初始化set
    $setIniArray = array("xiaoji","Russell");
//redis在Php中的命令语法也是遵守redis命令的，不接受参数为对象，数组，并返回所添成员中的非重复成员数量,也就是真正添加进去的数量
echo($redis->sAdd("room","xiaoji","Russell","yuanyuan"));//redis在Php中的命令语法也是遵守redis命令的，不接受参数为对象，数组
    $Smembers = $redis->sGetMembers("room");//获取set中的所有成员
    //移出set中N个元素，并返回移出元素的个数
    echo($redis->sRem("room","xiaoji"));
    //判断元素是否属于集合，返回bool
    if(!$redis->sIsMember("room","xiaoji")){
        echo "<br>xiaoji has leaved<br>";
    };
    //返回set中元素的个数
    echo $redis->sCard("room")."<br>";
    //随机返回SET中的元素，若count为正数，则不会重复，为负数可能重复
    print_r($redis->sRandMember("room",1));
    echo "<br>";
    //随机移除set中一个元素，并返回该元素
    echo ($redis->sPop("room"));
    echo "<br>";
    //新建set  room1
    $redis->sAdd("room1","xiaoli","xiaohong");
    //将room 中的 Russell移入room1中,并返回结果
    if($redis->sMove("room","room1","Russell")){
        echo "Russell is a GOD";
    }
    print_r($redis->sGetMembers("room"));
