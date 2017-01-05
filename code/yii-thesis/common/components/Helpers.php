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

    public static function isImageUrl($uri) {
        $imgExts = array("gif", "jpg", "jpeg", "png", "tiff", "tif");
        $urlExt = pathinfo($uri, PATHINFO_EXTENSION);
        if (in_array($urlExt, $imgExts)) {
            return true;
        }
        return false;
    }

    public static function str_2_json($str)
    {
        $array = json_decode($str,TRUE);
        return $array;
    }
    
    public static function debug($var)
    {
    	VarDumper::dump($var);
    }

    public static function get_request($url) {
        //Init curl
        $curl = new curl\Curl();
        //set options
        $curl->setOption(CURLOPT_SSL_VERIFYPEER, false);

        $response = $curl->get($url);
        return $response;
    }

    public static function pretty_print($data) {
        echo '<pre>';
        print_r($data);
        echo '</pre>';
    }
}