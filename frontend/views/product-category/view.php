<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use common\models\ProductCategory;
use common\models\ProductSubCategory;

$this->title = Yii::t('app', 'Sub-Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Sub-Categories'), 'url' => ['index']];
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
				'label'         => $model->getAttributeLabel('subCategory.label'), // TODO: change label name to Label when in edit mode
			],
			[
				'attribute'     => 'product_category_id',
				'label'         => $model->getAttributeLabel('productCategory.label'),
				'value'         => (null != $model->productCategory) ? $model->productCategory->label : null,
				'type'          => DetailView::INPUT_SELECT2, 
                'widgetOptions' => [
                    'data'    => ArrayHelper::map(ProductCategory::find()->orderBy('label')->asArray()->all(), 'id', 'label'),
                    'options' => [
						'placeholder' => 'Select ...',
					],
                    'pluginOptions' => [
						'allowClear' => true,
						'width'      => '100%',
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
