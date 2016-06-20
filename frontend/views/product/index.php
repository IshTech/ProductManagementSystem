<?php

use yii\helpers\Html;
use kartik\grid\GridView;

$this->title = Yii::t('app', 'Products');
$this->params['breadcrumbs'][] = $this->title;

/**
 * TODO: addtional features commented out, can be sold to customer
 * TODO: to reset / clear search filters
 *
 */
?>
<div class="product-index">

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
			'after'   => false,
		],
	//	'toolbar'          => [
	//		[
	//			'content' =>
	//				Html::a('<i class="glyphicon glyphicon-refresh"></i>', ['index'], ['data-pjax' => 0, 'class' => 'btn btn-default', 'title' => Yii::t('app', 'Reset Search Filters')])
	//		],
	//		'{toggleData}',
	//	],
		'columns'          => [
			[
				'class'    => 'kartik\grid\ActionColumn',
				'template' => '{view}',
			],
	//		'id',
			[
				'attribute' => 'productCategory.label',
			],
			[
				'attribute' => 'productSubCategory.label',
			],
			[
				'attribute' => 'label',
			],
			'description:ntext',
		],
	]); ?>

</div>
