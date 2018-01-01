<?php
/**
 * @Author: Hzhihua
 * @Time: 2018/1/1 15:20
 * @Email: cnzhihua@gmail.com
 */
/**
 * 适配器模式
 *      假设在php中开放了一个接口，在php内调用不出问题，
 *      过段时间新增了java客户端，但java客户端不认识php接口的数据类型，
 *      那么如何保证此接口在原来php内部可以调用，在java中也可以调用??
 */

class Weather
{
    public static function show()
    {
        $data = [
            'tep' => 28,
            'wind' => 7,
            'sun' => '晴朗',
        ];

        return serialize($data);
    }
}

// ======== php内部调用 ========
$wea = Weather::show();
$data = unserialize($wea);
echo "温度：{$data['tep']}<br />";
echo "风力：{$data['wind']}<br />";
echo "天气：{$data['sun']}<br />";


// ======== 新增java客户端调用=======
class JavaWeather extends Weather
{
    public static function show()
    {
        $data = parent::show();
        $data = unserialize($data);
        $data = json_encode($data);
        return $data;
    }
}

echo '<hr />Java客户端调用<br />';

$wea = JavaWeather::show();
$data = json_decode($wea);
echo "温度：{$data->tep}<br />";
echo "风力：{$data->wind}<br />";
echo "天气：{$data->sun}<br />";