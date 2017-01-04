<?php


namespace frontend\controllers;
use Yii;

define('DBPEDIA_URL', 'http://dbpedia.org/');

class DbpediaController extends \yii\web\Controller
{
    public function actionIndex()
    {
    	$request = Yii::$app->request;
    	$url_request = $this->_build_url($request);
    	if($url_request) {
    		$response = Yii::$app->help
    	}
        return $this->render('index');
    }

    private function _build_url($request) {
    	$class = $request->get('class');
    	$name = $request->get('name');
    	$url_request = null;
    	if(isset($class) && isset($name)) {
    		$url_request = DBPEDIA_URL;
    		switch ($class) {
    			case 'page':
    				$url_request .= 'data/';
    				break;
    			default:
    				$url_request .= 'data3/';
    				break;
    		}
    		$url_request .= $name.'.json';
    	}
    	return $url_request;
    }

}
