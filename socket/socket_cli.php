<?php
    //客户端创建套接字
    $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);
    //在客户端向服务器端发起套接字连接。（实质上客户端和服务器端的通信端点进行连接）
    if(socket_connect($socket,"127.0.0.1",8888) == false){
        echo "client connect with server has failed";
    }else{
        $message = "dear server,have you get my message?";
        //连接成功后，客户端将数据通过建立连接的套接字写入套接流，发送至服务端
        if(socket_write($socket,$message,strlen($message)) == false){
            echo "the write of client has failed";
        }else{
            echo "the server has received your message successfully and response for you with the following message:".PHP_EOL;
            //从连接的服务端读取返回数据
            while($return_message = socket_read($socket,1024)){
                echo $return_message.PHP_EOL;
            }
        }
    }
    //关闭套接字
    socket_close($socket);