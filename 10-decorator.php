<?php
/**
 * @Author: Hzhihua
 * @Time: 2018/1/1 12:39
 * @Email: cnzhihua@gmail.com
 */
/**
 * 装饰者模式
 */

class BaseArt
{
    protected $art = '';
    protected $content = '';

    public function __construct($content)
    {
        $this->content = $content;
    }

    public function decorator()
    {
        return $this->content;
    }
}

class BianArt extends BaseArt
{
    public function __construct(BaseArt $art)
    {
        $this->art = $art;
    }

    public function decorator()
    {
        return $this->art->decorator() . '<br />小编摘要<br />';
    }
}

class AdArt extends BaseArt
{
    public function __construct(BaseArt $art)
    {
        $this->art = $art;
    }

    public function decorator()
    {
        return $this->art->decorator() . '<br />广告摘要<br />';
    }
}

class SeoArt extends BaseArt
{
    public function __construct(BaseArt $art)
    {
        $this->art = $art;
    }

    public function decorator()
    {
        return $this->art->decorator() . '<br />搜索摘要<br />';
    }
}

// 装饰者模式 可以随意修改对文章加工的顺序
$decorator =  new SeoArt(new AdArt(new BianArt(new BaseArt('天天向上'))));
echo $decorator->decorator();
echo '<hr />';
$decorator =  new BianArt(new SeoArt(new AdArt(new BaseArt('天天向上'))));
echo $decorator->decorator();
