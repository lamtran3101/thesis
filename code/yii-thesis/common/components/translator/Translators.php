<?php
namespace common\components\translator;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use linslin\yii2\curl;
use Yandex;

class Translators extends Component
{
 public static function translate($text, $target, $origin = 'en')
 {
 	$response = YandexTranslator::translate($text, $target,$origin);
 	return $response;
 }

 
}