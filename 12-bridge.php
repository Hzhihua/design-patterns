<?php
/**
 * @Author: Hzhihua
 * @Time: 2018/1/1 15:32
 * @Email: cnzhihua@gmail.com
 */
/**
 * 桥接模式
 *      论坛给用户发送信息，可以是站内信息(Zn),email,手机
 *      内容分普通，加急，特急
 */

// 论坛给用户发送信息，可以是站内信息(Zn),email,手机
abstract class Msg
{
    public abstract function send($to, $content);
}

class Zn extends Msg
{
    public function send($to, $content)
    {
        return "站内信息：{$content} To: {$to}<br />";
    }
}

class Email extends Msg
{
    public function send($to, $content)
    {
        return "Email信息：{$content} To: {$to}<br />";
    }
}

class Sms extends Msg
{
    public function send($to, $content)
    {
        return "手机信息：{$content} To: {$to}<br />";
    }
}

// ======= 调用 =======
// 站内发送消息
echo (new Zn())->send('小明', '吃饭了');
// Email发送消息
echo (new Email())->send('小刚', '我们去打篮球');
// Sms发送消息
echo (new Sms())->send('小红', '天要下雨啦！！');


/**
 * 现在突然间要给信息内容分类，分为 普通，加急，特急
 */

// 方法一：
/*
class ZnCommon extends Msg
class ZnWarn extends Msg
class ZnDanger extends Msg

class EmailCommon extends Msg
class EmailWarn extends Msg
class EmailDanger extends Msg

...
...
*/

// 方法二：
/*
         |
    特急  |
         |
    加急  |
         |
    普通  |
         |     站内信息     email    手机
-----------------------------------------------

现在只需再增加3个信息内容紧急情况的类即可
*/

/**
 * 信息内容紧急情况抽象类
 * @property Msg send
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
abstract class Info
{
    private $send = null;

    public function __construct($send)
    {
        $this->send = $send;
    }

    public abstract function getContent($content);

    public function send($to, $content)
    {
        $content = $this->getContent($content);
        return $this->send->send($to, $content);
    }
}

class Common extends Info
{
    public function getContent($content)
    {
        return "普通信息：{$content}";
    }
}

class Warn extends Info
{
    public function getContent($content)
    {
        return "<span style='color: red'>加急信息</span>：{$content}";
    }
}

class Danger extends Info
{
    public function getContent($content)
    {
        return "<span style='color: red'>特急信息</span>：{$content}";
    }
}

echo '<hr/>'; //华丽的分割线

// 站内发送消息
echo (new Common(new Zn()))->send('小明', '吃饭了');
// Email发送消息
echo (new Warn(new Email()))->send('小刚', '我们去打篮球');
// Sms发送消息
echo (new Danger(new Sms()))->send('小红', '天要下雨啦！！');