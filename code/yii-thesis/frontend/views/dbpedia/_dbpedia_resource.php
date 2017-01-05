<?php
use yii\helpers\Html;

echo HTML::tag('H1', $response['title'], array('class' => 'page-title'));
if(isset($response['comment'])) {
	$comments = $response['comment'];
	$about = '';
	foreach ($comments as $c) {
		$lang  = $c['lang'];
		if($lang == 'en') {
			$about = $c['value'];
		}
	}
	echo HTML::tag('p', $about, array('class' => 'page-description'));
}

?>

<div class="page-content"> 
<?php
	$exceptions = array('title', 'class' , 'type');

	echo HTML::beginTag('table', array('class' => 'table table-striped table-hover table-condensed table-responsive'));
		foreach ($response as $key => $data) {
			if(in_array($key, $exceptions)) continue;
			echo HTML::beginTag('tr');
				echo HTML::beginTag('td');
				echo $key;
				echo HTML::endTag('td');
				echo HTML::beginTag('td');
				foreach ($data as $row) {
					echo HTML::beginTag('div');
					if(isset($row['lang'])) {
						echo HTML::tag('span', $row['lang'], array('class' => 'lang'));
					}
					$type = $row['type'];
					$v = $row['value'];
					switch ($type) {
						case 'uri':
							if(Yii::$app->helpers->isImageUrl($v))
								echo HTML::img($v, array('class'=> 'img-thumbnail'));
							else 
								echo HTML::a($v, $v);
							break;
						default:
							echo HTML::tag('p', $v);
							break;
					}
					echo HTML::endTag('div');
				}
				echo HTML::endTag('td');
			echo HTML::endTag('tr');
		}
	echo HTML::endTag('table');
?>
</div>