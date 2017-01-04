<?php
namespace common\components\translator;

use Yii;
use yii\base;


use linslin\yii2\curl;

class Translator
{
    public static function translate($text, $target, $origin = 'en')
	{
	 	return $text;
	}

	public function getSupportedLanguages($origin = 'en')
	{
		return array();
	}

	 protected static function _request($request) 
	 {
	 	//Init curl
        $curl = new curl\Curl();
        //set options
        $curl->setOption(CURLOPT_SSL_VERIFYPEER, false);

        $response = $curl->get($request);
		return $response;
	 }
   
}


