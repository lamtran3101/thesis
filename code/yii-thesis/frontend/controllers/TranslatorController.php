<?php

namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;

class TranslatorController extends \yii\web\Controller
{
    public function actionBing()
    {
    	$request = Yii::$app->request;
    	$query = $request->get('query');
    	$result = null;
    	if(!empty($query)) {
    		$result = Yii::$app->translator->translate($query, 'es');
    	}
        return $this->render('bing', array('result' => $result, 'query' => $query));
    }

}
