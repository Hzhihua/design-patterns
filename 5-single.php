<?php
/**
 * 单例模式
 */

class Single
{
    protected static $ins = null;

    public static function getIns()
    {
        if (self::$ins === null)
            self::$ins = new self();
        return self::$ins;
    }

    /**
     * final关键字  子类不可以重写
     */
    final protected function __construct()
    {}

    /**
     * 防止克隆
     */
    final protected function __clone()
    {}
}

// test1
// $s1 = new Single();
// $s2 = new Single();

// test2
// $s1 = Single::getIns();
// $s2 = clone $s1;
// if ($s1 === $s2){
//     echo '1';
// } else {
//     echo '0';
// }

// test3
// class Multi extends Single
// {

// }
// $s1 = new Sub();
// $s2 = new Sub();
// $s1 = Sub::getIns();
// $s2 = clone $s1;


// test4
// class MultiTest extends Single
// {
//     public function __construct()
//     {

//     }

//     public function __clone()
//     {

//     }
// }

// $s1 = new Sub();
// $s2 = new Sub();
// $s1 = Sub::getIns();
// $s2 = clone $s1;
