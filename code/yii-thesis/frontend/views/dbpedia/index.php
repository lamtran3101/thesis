<?php
/* @var $this yii\web\View */
use yii\helpers\Html;
use yii\base\view;
?>
<?php if($response) : ?>
<?php
	$class = $response['class'];
	switch ($class) {
		case 'resource':
			echo $this->render('_dbpedia_resource', array('response'=>$response));
			break;
		default:
			break;
	}
?>
<?php else: ?>
	<?php 
		echo HTML::tag('div', 'invalid url', array('class' => 'error'));
	?>
<?php endif; ?>