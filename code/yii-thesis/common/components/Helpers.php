<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\VarDumper;
use linslin\yii2\curl;

class Helpers extends Component
{
    public static function xml_2_json($xml_string)
    {
        $xml = simplexml_load_string($xml_string);
		$json = json_encode($xml);
		$array = json_decode($json,TRUE);
		return $array;
    }
    
    public static function debug($var)
    {
    	VarDumper::dump($var);
    }

    public static function request($url, $method = 'get') {

    }
}