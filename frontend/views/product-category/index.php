<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

/**
 * TODO: addtional features commented out, can be sold to customer
 * TODO: to reset / clear search filters
 *
 */
?>
<div class="category-index">

	<?= GridView::widget([
		'dataProvider'     => $dataProvider ,
		'filterModel'      => $searchModel  ,
		'responsive'       => true      ,
	//	'bordered'         => false     ,
	//	'striped'          => false     ,
		'condensed'        => true      ,
		'hover'            => true      ,
		'resizableColumns' => false     ,
		'pjax'             => true      ,
		'panel'            => [
			'type'    => GridView::TYPE_PRIMARY ,
			'heading' => Html::encode($this->title),
	//		'footer'  => false,
			'before'  => false,
			'after'   => false,
		],
	//	'toolbar'          => false,
	//	'toolbar'          => [
	//		[
	//			'content' =>
	//				Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('app', 'Reset Search Filters')])
	//		],
	//		'{toggleData}',
	//	],
		'formatter' => [
			'class' => '\yii\i18n\Formatter',
			'nullDisplay' => '',
		],
		'columns'          => [
			[
				'class' => 'kartik\grid\ExpandRowColumn',
				'width' => '50px',
				'value' => function ($model, $key, $index, $column) {
					return GridView::ROW_COLLAPSED;
				},
				'detail' => function ($model, $key, $index, $column) {
					return Yii::$app->controller->renderPartial('expand-row-details', ['model' => $model]);
				},
				'headerOptions' => [
					'class' => 'kartik-sheet-style',
				],
				'expandOneOnly' => true,
			],
			[
				'class'    => 'kartik\grid\ActionColumn',
				'template' => '{view}',
			],
	//		'id',
	//		[
	//			'attribute' => 'name',
	//		],
			[
				'attribute'  => 'primaryProductCategoryImage.local_url',
				'format'     => 'html',
				'value'      => function ($model, $key, $index, $column) {
					if(null != $model->primaryProductCategoryImage && null != $model->primaryProductCategoryImage->local_url) {
						return Html::img('@web' . '/images/product-category/' . $model->primaryProductCategoryImage->local_url, ['width' => 80, 'height' => 60, ]);
					} else {
						return '';
					}
				},
			],
			[
				'attribute' => 'label',
			],
			'description:ntext',
		],
	]); ?>

</div>
<!--
<script type="text/javascript">
$(document).ready(function () {
	$('ul.tree li:last-child').addClass('last');
});
</script>
-->