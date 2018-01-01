<?php

/**
 * 工厂模式
 * 接上一个 简单工厂模式
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

interface Factory
{
    public function createDB();
}

class MysqlFactory implements Factory
{
    public function createDB()
    {
        return new Dbmysql();
    }
}

class SqliteFactory implements Factory
{
    public function createDB()
    {
        return new Dbsqlite();
    }
}

// =====客户端
// 如果新增oracle数据库类型，怎么办？
// 服务器端要修改Factory的内容(在java,c++中,改后还得再编译,编译一次要几个小时)
// 在面向对象设计法则中，重要的开闭原则 --- 对于修改是封闭，对于拓展是开方的
$fact = new MysqlFactory();
$db = $fact->createDB();
$db->conn();

$fact = new SqliteFactory();
$db = $fact->createDB();
$db->conn();

// 新增oracle
class Dboracle implements Db
{
    public function conn()
    {
        echo '连接上了oracle';
    }
}

class OracleFactory implements Factory
{
    public function createDB()
    {
        return new Dboracle();
    }
}

$fact = new OracleFactory();
$db = $fact->createDB();
$db->conn();