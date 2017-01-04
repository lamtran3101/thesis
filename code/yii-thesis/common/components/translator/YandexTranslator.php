<?php
namespace common\components\translator;

use common\components\translator\Translator;
use Yii;
use yii\base;


define('YANDEX_KEY','trnsl.1.1.20170104T122508Z.f21cb52090f7bf9b.80a809a7f5c0cf94f99efda2dfcb6ba994693dc6');

define('LANGUAGUES_URL_REQUEST', 'https://translate.yandex.net/api/v1.5/tr.json/getLangs?key='.YANDEX_KEY);

define('TRANSLATE_URL_REQUEST', 'https://translate.yandex.net/api/v1.5/tr.json/translate?key='.YANDEX_KEY);

class YandexTranslator extends Translator
{
    public static function translate($text, $target, $origin = 'en')
	{
		$request = TRANSLATE_URL_REQUEST.'&text='.$text.'&lang='.$origin.'-'.$target;
		$response = Translator::_request($request);
		$response = json_decode($response, true);
		YandexTranslator::_adapteResult($response);
		return $response;
	}

	public function getSupportedLanguages($origin = 'en')
	{
		$request = LANGUAGUES_URL_REQUEST.'&ui='.$origin;
		$response =  Translator::_request($request);
		$response = json_decode($response, true);
		YandexTranslator::_adapteResult($response);
		return $response;
	}

	private static function _adapteResult(&$response){
		$code = $response['code'];
		$response['status'] = 1;
		$response['t_message'] = 'ok';
		$response['result'] = '';
		if($code != 200) {
			$response['status'] = 0;
			$response['t_message'] = $response['message'];
		} else {
			$response['result'] = $response['text'][0];
		}
	}
    
}


