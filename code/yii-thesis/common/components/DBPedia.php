<?php
namespace common\components;

use Yii;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\VarDumper;
use linslin\yii2\curl;

class DBPedia extends Component
{
    public static $class = array(
        'RESOURCE' => 'resource'
    );
}