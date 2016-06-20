<?php

use kartik\detail\DetailView;
use yii\helpers\Url;

?>
<div class="sub-category-expanded-row-detail-view">
	<?= DetailView::widget([
		'model'          => $model,
		'mode'           => 'view',
		'bordered'       => false ,
		'striped'        => true  ,
		'condensed'      => true  ,
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
	//	],
		'attributes' => [
	//		[
	//			'attribute'       => 'id'                     ,
	//			'type'            => DetailView::INPUT_HIDDEN ,
	//			'visible'         => false,
	//			'labelColOptions' => [
	//				'class' => 'kv-view-hidden'
	//			],
	//			'valueColOptions' => [
	//				'class' => 'kv-view-hidden'
	//			],
	//		],
			[
				'attribute'       => 'description',
				'format'          => 'ntext',
				'valueColOptions' => [
					'style' => 'white-space: normal',
				],
			],
		],
	]) ?>
</div>
