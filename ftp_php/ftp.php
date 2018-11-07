<?php
//曹振南正在研究
//生成的html页面乱码，强制将返回页面信息编码转化为UTF-8
header("Content-Type:text/html;charset=utf-8");

    //以主机地址（绑定解析域名）和FTP服务器端口为参数进行FTP服务器连接，返回连接资源句柄
    $conn = ftp_connect("localhost",21);

    //判断与FTP服务器是否连接成功
    if(!$conn){
        echo "与FTP服务器连接失败";
        exit();
    }else{
        echo "与FTP服务器连接成功".PHP_EOL;

        //服务器连接成功后，进行FTP登录
        ftp_login($conn,"RussellCao824","czn824");

        //获取服务器所在系统信息
        echo ftp_systype($conn).PHP_EOL;

        //列出指定目录的文件名称
        $file_list = ftp_nlist($conn,".");
        echo print_r($file_list);

        //上传文件
        $file_source = fopen("file_upload.txt","r");//首先获取待上传文件资源
        $file_put = ftp_fput($conn,"upload.txt",$file_source,FTP_ASCII);
        if($file_put == 1){
            echo "文件上传成功";
        }else{
            echo "文件上传失败";
        }

        //下载文件
        $file_get = ftp_get($conn,"file_download.txt","file.txt",FTP_BINARY);
        if($file_get == 1){
            echo "文件下载成功";
        }else{
            echo "文件下载失败";
        }
    }