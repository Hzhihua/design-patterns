<?php
/**
 * 多态设计模式
 *      **多态**指同一特种的多种表现形态.
 *      如:西伯利亚虎一般重210-260公斤,而孟加拉虎一般180-230公斤
 *      在面向对象中,指某种对象实例的不同表现形态.
 *      以对象作为实参，所有的对象都有共同的调用接口
 *
 *      问题：
 *        西伯利亚虎不能爬树
 *        孟加拉虎可以爬树
 *        那么老虎,到底能否爬树?
 *
 * 
 */

abstract class Tiger
{
    public abstract function climb();
}

class XTiger extends Tiger
{
    public function climb()
    {
        echo '不会爬树<br />';
    }
}

class MTiger extends Tiger
{
    public function climb()
    {
        echo '爬到树顶<br />';
    }
}

class Cat
{
    public function climb()
    {
        echo 'i am Cat, i can climb at the tree<br />';
    }
}

// ====== 客户端调用 ======
class Client
{
    public static function call(Tiger $animal)
    {
        $animal->climb();
    }
}


Client::call(new XTiger());
Client::call(new MTiger());
//Client::call(new Cat());  // 只能接受老虎对象