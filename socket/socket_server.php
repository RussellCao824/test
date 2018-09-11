<?php
    //在服务端初始化套接字
    $socket = socket_create(AF_INET,SOCK_STREAM,SOL_TCP);//初始化套接字设置套接字属性，参数1指定使用的ip协议，参数2指定使用TCP，UDP或者其他协议中的socket，参数3指定与参数2相应的协议
    //将该套接字绑定在服务器主机的某个端口上，形成网络中的数据通信端点，此处使用8888 port，注意很多协议使用的端口都已被绑定，而每个端口最多只能被绑定一个socket
    if(socket_bind($socket,"127.0.0.1",8888) == false){
        echo "the bind between server and socket has failed";
    }else{
        //对某个socket进行监听
        if(socket_listen($socket,4) == false){
            echo "the listen of serve socket has failed";
        }else{
            do{
                //获取从客户端传至此套接字的信息资源，若没有客户端数据资源请求，则程序一直阻塞在此处，直到客户端信息的到达
                $accept_resource = socket_accept($socket);
                if($accept_resource != false){
                    //将客户端传递至此socket的信息资源读出来，形成字符串
                    $accept_string = socket_read($accept_resource,1024);
                    if($accept_string != false){
                        echo "the message from client is:".PHP_EOL.$accept_string;
                        $return_message = "the server has received your message:".$accept_string;
                        //由服务端套接字接受的信息资源来确定客户端的套接字端点，将返回信息写入套接字发送到客户端
                        socket_write($accept_resource,$return_message,strlen($return_message));
                    }else{
                        echo "serve gets sockets's string which was converted by accept_respurce has falied ";
                    }
                }else{
                    echo "serve gets socket bind has failed";
                }
            }while(true);
        }
    }
    //关闭套接字（销毁）
    socket_close($socket);
