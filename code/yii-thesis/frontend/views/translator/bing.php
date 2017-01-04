
<?php
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<?= Html::beginForm(Url::to(['translator/bing']), 'get'); ?>
<?= Html::input('text', 'query', isset($query) ? $query: '')?>
<div class="form-group">
    <?= Html::submitButton('POST', ['class' => 'btn btn-primary']) ?>
</div>
<?= Html::endForm() ?>
<h2>Result</h2>
<?php 
$status = $result['status'];
if($status == 0) {
	echo HTML::tag('div', $result['t_message'], array('class' => 'error'));
} else {
	echo HTML::tag('div', $result['lang'].' : '.$result['result'], array('class' => 'success'));
}
?>