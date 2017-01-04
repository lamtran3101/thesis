
<?php
/* @var $this yii\web\View */
?>
<?php
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\GridView;

?>
<?= Html::beginForm(Url::to(['lookup/index']), 'get'); ?>
<?= Html::input('text', 'query', isset($query) ? $query: '')?>
<div class="form-group">
    <?= Html::submitButton('POST', ['class' => 'btn btn-primary']) ?>
</div>
<?= Html::endForm() ?>
<h2>Result</h2>
<?php 
if($result):
echo GridView::widget([
    'dataProvider' => $result,
    'columns' => [
        ['class' => 'yii\grid\SerialColumn'],
	    'Label',
	    [
	        'attribute' => 'URI',
	        'format' => 'raw',
	        'value' => function($data) {
		        return Html::a($data['URI'], $data['URI']);
	        }
	    ],
    ],
]);
endif;
?>