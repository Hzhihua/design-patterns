<?php

/**
 * 面向接口开发
 * 服务器端与客户端统一接口开发
 * 
 * 服务器端面向接口开发
 * 
 * 客户端面向接口使用
 * 
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

// =====客户端，看不到dbmysql,dbsqlite的内部细节
// 只知道，上两个类实现了db接口
$db = new Dbmysql();
$db->conn();