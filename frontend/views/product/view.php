<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use common\models\ProductCategory;
use common\models\ProductSubCategory;

$this->title = Yii::t('app', 'Product');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Products'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="product-view">
	<?= DetailView::widget([
		'model'          => $model,
		'formOptions'    => [
			'enableClientValidation' => true,
			'action' =>
				isset($enableEditMode) ?
					(isset($saveButtonAction) ?
						Url::to([$saveButtonAction])
					:
						Url::to(['view', 'id' => isset($model->id) ? $model->id : isset($id) ? $id : null]))
				:
					Url::to(['view', 'id' => isset($model->id) ? $model->id : isset($id) ? $id : null])
				,
			'method' => 'post',
		],
		'mode'           => isset($mode) ? $mode : DetailView::MODE_VIEW ,
		'bordered'       => true                    ,
		'striped'        => true                    ,
		'condensed'      => true                    ,
		'responsive'     => true                    ,
		'hover'          => true                    ,
		'enableEditMode' => isset($enableEditMode) ? $enableEditMode : false ,
		'buttons1'       => '{update}'              ,
		'buttons2'       => '{view} {reset} {save}' ,
		'saveOptions'    => [
			'formmethod' => 'post',
			'name'       => 'saveButtonAction',
			'value'      => isset($saveButtonAction) ? $saveButtonAction : null,
		],
		'formatter' => [
			'class' => '\yii\i18n\Formatter',
			'nullDisplay' => '',
		],
		'panel'          => [
			'heading' => Html::encode($this->title)     ,
	//		'type'    => DetailView::TYPE_DEFAULT       ,
			'type'    => DetailView::TYPE_PRIMARY       ,
			'after'   => false                          ,
	//		'footer' => ' '                             ,
		],
		'attributes' => [
			[
				'attribute'     => 'id'                     ,
				'type'          => DetailView::INPUT_HIDDEN ,
	//			'visible'       => false,
	//			'rowOptions'    => [
	//				'class' => 'kv-edit-hidden kv-view-hidden'
	//			],
				'labelColOptions'    => [
					'class' => 'kv-view-hidden'
				],
				'valueColOptions'    => [
					'class' => 'kv-view-hidden'
				],
			],
			[
				'attribute'     => 'name',
				'rowOptions'    => [
					'class' => 'kv-view-hidden'
				],
			],
			[
				'attribute'     => 'label',
				'label'         => $model->getAttributeLabel('product.label'), // TODO: change label name to Label when in edit mode
			],
			[
				'attribute'     => 'product_category_id',
				'label'         => $model->getAttributeLabel('productSubCategory.productCategory.label'),
				'value'         => (null != $model->productSubCategory && null != $model->productSubCategory->productCategory) ? $model->productSubCategory->productCategory->label : null,
				'type'          => DetailView::INPUT_SELECT2, 
				'widgetOptions' => [
					'data'    => ArrayHelper::map(ProductCategory::find()->orderBy('label')->asArray()->all(), 'id', 'label'),
					'options' => [
						'id' => 'product_category_id',
						'placeholder' => 'Select ...',
					],
					'pluginOptions' => [
						'allowClear' => true,
						'width'      => '100%',
					],
				],
			],
			[
				'attribute'     => 'product_sub_category_id',
				'label'         => $model->getAttributeLabel('productSubCategory.label'),
				'value'         => (null != $model->productSubCategory) ? $model->productSubCategory->label : null,
/*
				'type'          => DetailView::INPUT_DEPDROP, 
				'widgetOptions' => [
	//				'data'    => ArrayHelper::map(ProductSubCategory::find()->orderBy('label')->asArray()->all(), 'id', 'label'),
					'type'    => \kartik\widgets\DepDrop::TYPE_SELECT2,
					'options' => [
						'id' => 'product_sub_category_id',
						'placeholder' => 'Select ...',
					],
					'select2Options' => [
						'pluginOptions' => [
							'allowClear' => true,
						],
					],
					'pluginOptions' => [
						'width'       => '100%',
						'initialize'  => true,
						'initDepends' => ['product_category_id'], 
						'active'      => true,
						'depends'     => ['product_category_id'],
						'url'         => Url::to(['/sub-category/for-category'])
					],
				],
*/
				'type'          => DetailView::INPUT_WIDGET, 
				'widgetOptions' => [
					'class' => '\kartik\widgets\DepDrop',
					'options' => [
						'id' => 'product_sub_category_id',
					],
					'type' => \kartik\widgets\DepDrop::TYPE_SELECT2,
					'select2Options' => [
						'pluginOptions' => [
							'allowClear' => true,
						],
					],
					'pluginOptions' => [
						'initialize' => true,
						'initDepends' => ['product_category_id'], 
						'active' => true,
						'depends' => ['product_category_id'],
	//					'placeholder' => '-- Valitse kaupunki --',
						'url' => Url::to(['/sub-category/for-category', 'selected_sub_category_id' => $model["product_sub_category_id"],])
					],
				],
			],
			[
				'attribute'     => 'description'             ,
				'format'        => 'ntext'                   ,
				'type'          => DetailView::INPUT_TEXTAREA,
			],
		],
	]) ?>
</div>
