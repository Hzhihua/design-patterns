<?php

/**
 * 简单工厂方法
 * 数据库连接
 */

interface Db
{
    public function conn();
}

class Dbmysql implements Db
{
    public function conn()
    {
        echo '连上了mysql';
    }
}

class Dbsqlite implements Db
{
    public function conn()
    {
        echo '连上了sqlite';
    }
}

/**
 * 简单工厂方法
 */
class Factory
{
    public static function createDB($type)
    {
        if ($type == 'mysql')
            return new Dbmysql();
        else if ($type == 'sqlite')
            return new Dbsqlite();
        else
            throw new Exception("Error db type", 1);
    }
}

// =====客户端 现在不知道服务器端到底有哪些类名了
// 只知道对方开放了一个Factory::createDB()方法
// 方法允许传递数据库名称

$mysql = Factory::createDB('mysql');
$mysql->conn();

$sqlite = Factory::createDB('sqlite');
$sqlite->conn();

// 如果新增oracle数据库类型，怎么办？
// 服务器端要修改Factory的内容(在java,c++中,改后还得再编译,编译一次要几个小时)
// 在面向对象设计法则中，重要的开闭原则 --- 对于修改是封闭，对于拓展是开方的