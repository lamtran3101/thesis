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
        $response = null;
    	if($url_request) {
    		$response = Yii::$app->helpers->get_request($url_request);
            $response =  Yii::$app->helpers->str_2_json($response);
            $response =  $this->_parse_data($response, $request);
    	}
        return $this->render('index' , array('response' => $response));
    }

    private function _parse_data($response, $request) {
        $key = DBPEDIA_URL;
        $class = $request->get('class');
        $name = $request->get('name');
        $data = null;
        if(isset($class) && isset($name)) {
            switch ($class) {
                case 'resource':
                    $key .= 'resource/';
                    break;
                case 'ontology':
                    $key .= 'ontology/';
                    break;
                default:
                    $key .= 'resource/';
                    break;
            }
            $key .= $name;
            foreach ($response as $uri => $refs) {
                if($key == $uri) {
                    $data = $response[$key];
                } else {
                    foreach ($refs as $k => $ref) {
                        if(!isset( $data[$k]))  $data[$k] = array();
                        foreach ($ref as $r) {
                           $data[$k][] = array(
                                'type' => $r['type'],
                                'value' => $uri
                            );
                        }
                    }
                }
            }
        }
        return $this->_adjust_data($data, $class, $name);
    }

    private function _adjust_data($response, $tipo, $title) {

        $data = null;
        if($response) {
            $data['class'] = $tipo;
            $data['title'] = $title;


            foreach ($response as $key => $value) {
                $data[$key] = $value;
                // if(preg_match('/#type$/', $key)) {
                //     $data['type'] = $value;
                // }
                if(preg_match('/#comment$/', $key)) {
                    $data['comment'] = $value;
                }
                // if(preg_match('/#label$/', $key)) {
                //     $data['label'] = $value;
                // }
                // if(preg_match('/#sameAs$/', $key)) {
                //     $data['sameAs'] = $value;
                // }
                // if(preg_match('/abstract$/', $key)) {
                //     $data['abstract'] = $value;
                // }
                // if(preg_match('/thumbnail$/', $key)) {
                //     $data['thumbnail'] = $value;
                // }
            }
        }

        return $data;
    }

    private function _build_url($request) {
    	$class = $request->get('class');
    	$name = $request->get('name');
    	$url_request = null;
    	if(isset($class) && isset($name)) {
    		$url_request = DBPEDIA_URL;
    		switch ($class) {
    			case 'resource':
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
