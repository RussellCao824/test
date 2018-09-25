<?php
    //初始化redis类
    $redis = new Redis();
    //连接redis服务断
    $redis->connect("127.0.0.1",6379);
    $name = $redis->get("name");
    echo "the name has saved in redis is:".$name.PHP_EOL;