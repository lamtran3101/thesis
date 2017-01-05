<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\VarDumper;
use linslin\yii2\curl;
use yii\helpers\Html;

class DBPedia extends Component
{

    public static function convert_predicate_link($uri) {
        if(!filter_var($uri, FILTER_VALIDATE_URL)) {
            return $uri;
        }
        $params = parse_url($uri);
        $host = $params['host'];
        $path = $params['path'];
        $query = isset($params['query']) ? $params['query'] : '';
        $hashtag = isset($params['fragment']) ? $params['fragment'] : '';

        if(DBPedia::_isDBPEDIA($host)) {
            $arr_path = explode('/', $path);
            $l  = sizeof($arr_path);
            if($l > 2) {
                $name = $arr_path[$l - 1];
                $class = $arr_path[$l - 2];
                $link = Yii::$app->getUrlManager()->getBaseUrl().'/dbpedia/'.$class.'/'.$name;
                return HTML::a($uri, $link);
            }
            
        }
        return HTML::a($uri, $uri);
    }

    private static function _isDBPEDIA($host) {
        if(strpos($host, 'dbpedia.org') !== FALSE) return true;
        return false;
    }
}