<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\detail\DetailView;

?>
<?php
//	var_dump($model->makeTree());
	$attrs = [];
/*
	$attrs = ArrayHelper::merge($attrs, [
		[
			'attribute'       => 'description',
			'format'          => 'ntext',
			'valueColOptions' => [
				'style' => 'white-space: normal',
			],
		],
	]);
*/
	$attrs = ArrayHelper::merge($attrs, [
		[
			'label'           => '',
	//		'group'           => true,
			'value'           => $model->makeTreeUL(),
			'format'          => 'raw',
			'valueColOptions' => [
				'style' => 'white-space: normal',
			],
		],
	]);

?>
<div class="category-expanded-row-detail-view">
	<?= DetailView::widget([
		'model'          => $model,
		'mode'           => 'view',
		'bordered'       => false ,
		'striped'        => true  ,
	//	'condensed'      => true  ,
		'responsive'     => true  ,
	//	'hover'          => true  ,
		'enableEditMode' => false ,
		'formatter' => [
			'class' => '\yii\i18n\Formatter',
			'nullDisplay' => '',
		],
	//	'panel'          => [
	//		'heading' => false,
	//		'footer'  => false,
	//		'after'   => false,
	//		'before'  => false,
	//	],
		'attributes' => isset($attrs) ? $attrs : [],
	]) ?>
</div>
