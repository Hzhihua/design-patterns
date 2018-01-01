<?php
/**
 * @Author: Hzhihua
 * @Time: 2018/1/1 10:26
 * @Email: cnzhihua@gmail.com
 */
/**
 * 责任链模式
 *      版主 -> 管理员 -> 警察
 *      版主不能处理，交给管理员处理，管理员不能处理，最终交给警察处理
 *      当新增一个权限管理时，需要修改源代码
 */

abstract class Report
{
    public abstract function process($dev);
}

/**
 * @property Report _top
 */
class Borad extends Report
{
    private $power = 1;
    private $top = 'admin';
    private $_top = null;

    public function __construct()
    {
        $this->_top = new $this->top;
    }

    public function process($dev)
    {
        if ($dev > $this->power) {
            $this->_top->process($dev);
        } else {
            echo '版主处理';
        }
    }
}

/**
 * @property Report _top
 */
class Admin extends Report
{
    private $power = 2;
    private $top = 'police';
    private $_top = null;

    public function __construct()
    {
        $this->_top = new $this->top;
    }

    public function process($dev)
    {
        if ($dev > $this->power){
            $this->_top->process($dev);
        } else {
            echo '管理员处理';
        }
    }
}

class Police extends Report
{
    public function process($dev)
    {
        echo '公关处理,处理级别为:' . $dev;
    }
}

// 接受举报
$zeren = $_POST['zeren'] + 0; // 转整型
(new Borad())->process($zeren);