<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use linslin\yii2\curl;
use common\components\Helpers;
use yii\data\ArrayDataProvider;

define('LOOKUP_ENDPOINT' , 'http://lookup.dbpedia.org/api/search/PrefixSearch?QueryClass=&MaxHits=5&QueryString=');

class LookupController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	$query = $request->get('query');
    	$result = null;
    	if(!empty($query)) {
    		$url_request = $this->_build_request_url($query);
	    	$data = $this->_make_request($url_request);
	    	$result = $this->_convert_2_provide($data);
    	}
        return $this->render('index', array('result' => $result, 'query' => $query));
    }

    /**
     * Create request url
     */
    private function _build_request_url($query) {
    	return LOOKUP_ENDPOINT.$query;
    }

    /**
     * connect to dbpedia api
     * http://lookup.dbpedia.org/api/search/KeywordSearch?QueryClass=place&QueryString=berlin
     * http://lookup.dbpedia.org/api/search/PrefixSearch?QueryClass=&MaxHits=5&QueryString=berl
     */
    private function _make_request($url) {
    	//Init curl
        $curl = new curl\Curl();
        $response = $curl->get($url);
        $data = Helpers::xml_2_json($response);
        return $data;
    }

    /**
     * Convert to Yii data provider
     */
    private function _convert_2_provide($data) {
    	$provider = new ArrayDataProvider([
		    'allModels' => $data['Result'],
		    'sort' => [
		        'attributes' => ['Label', 'URI'],
		    ],
		    'pagination' => [
		        'pageSize' => 10,
		    ],
		]);
		return $provider;
    }
}
