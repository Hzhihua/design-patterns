<?php

/**
 * php实现观察者模式 
 * (其实是事件的监听与删除)
 */

/**
 * 被观察者
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class User implements \SplSubject
{
    private $loginnum = 0;
    private $hobby = null;
    private $observers = null;

    public function __construct($hobby)
    {
        $this->hobby = $hobby;
        $this->loginnum = rand(1,10);
        $this->observers = new \SplObjectStorage();
    }

    public function login()
    {
        $this->notify();
    }

    public function getLoginNum()
    {
        return $this->loginnum;
    }

    public function getHobby()
    {
        return $this->hobby;
    }

    public function attach(\SplObserver $observer, $data=null)
    {
        $this->observers->attach($observer, $data);
    }

    public function detach(\SplObserver $observer)
    {
        $this->observers->detach($observer);
    }

    public function notify()
    {
        $this->observers->rewind();
        while ($this->observers->valid()) {
            $observer = $this->observers->current();
            $observer->update($this);
            $this->observers->next();
        }
    }
}

/**
 * 观察者
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class Security implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        $loginNum = $subject->getLoginNum();
        if ($loginNum < 3) {
            echo '这是第' . $loginNum . '次安全登录<br />';
        } else {
            echo '这是第' . $loginNum . '次登录，异常<br />';
        }
    }
}

/**
 * 观察者
 * @Author Hzhihua <cnzhihua@gmail.com>
 */
class Ad implements \SplObserver
{
    public function update(\SplSubject $subject)
    {
        if ($subject->getHobby() == 'sports') {
            echo '你喜欢运动<br />';
        } else {
            echo '好好学习，天天向上<br />';
        }
    }
}

$subject = new User('sports');
$subject->attach(new Security());
$subject->attach(new Ad());
$subject->login();
