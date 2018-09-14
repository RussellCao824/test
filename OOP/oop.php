<?php
    echo NAME;//常量在定以后才能正常使用，在常量定义前使用常量，则直接输出常量标识符
    define("NAME","caozhennan");
    define("NAME"," caozhen");//常量定义之后再次定义或者取消定义，都不会改变常量第一次定义的数值

    //使用关键字const定义常量，php5.3之后可以在类声明外部定义常量
//    const AGE = 26;
//    echo AGE;

    echo NAME;