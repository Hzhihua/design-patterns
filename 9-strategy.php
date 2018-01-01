<?php
/**
 * @Author: Hzhihua
 * @Time: 2018/1/1 11:15
 * @Email: cnzhihua@gmail.com
 */
/**
 * 策略模式
 */

interface Math
{
    public function calc($op1, $op2);
}

class MathAdd implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 + $op2;
    }
}

class MathSub implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 - $op2;
    }
}

class MathMul implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 * $op2;
    }
}

class MathDiv implements Math
{
    public function calc($op1, $op2)
    {
        return $op1 / $op2;
    }
}

/**
 * @property Math calc
 */
class CMath
{
    private $calc = null;

    public function __construct($calc_name)
    {
        $math_name = 'Math'.$calc_name;
        $this->calc = new $math_name();
    }

    public function getResult($op1, $op2)
    {
        return $this->calc->calc($op1, $op2);
    }
}


// 接受数据处理
echo (new CMath($_POST['op']))->getResult($_POST['op1'], $_POST['op2']);