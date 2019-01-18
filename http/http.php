<?php
    //网络请求初始化
    function phpPost($url){
        $cu = curl_init($url);
        curl_exec($cu);
        $result = curl_getinfo($cu);
        curl_close($cu);
        return $result;
    }

    $result = phpPost("localhost:8002");
    print_r($result);