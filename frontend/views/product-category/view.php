<?php

use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\helpers\Url;
use kartik\detail\DetailView;
use metalguardian\fotorama\Fotorama;
use common\models\ProductCategory;

$this->title = Yii::t('app', 'Category');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Categories'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
if($model && $model->name) {
	$this->params['breadcrumbs'][] = $model->name;
}

	//images
	$imgArr = [];
	if($model) {
		foreach($model->productCategoryImages AS $img){
			$imgArr[]['img'] = Url::to('@web' . '/images/product-category/' . $img->local_url, true);
		}
	}
//	var_dump($imgArr);die();
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
				'attribute'  => 'id'                     ,
				'type'       => DetailView::INPUT_HIDDEN ,
	//			'visible'    => false,
	//			'rowOptions' => [
	//				'class' => 'kv-edit-hidden kv-view-hidden'
	//			],
				'labelColOptions' => [
					'class' => 'kv-view-hidden',
					'style' => 'float: right',
				],
				'valueColOptions' => [
					'class' => 'kv-view-hidden',
					'style' => 'float: right',
				],
			],
			[
	//			'attribute'   => 'primaryProductCategoryImage',
				'displayOnly' => true,
				'format'      => 'raw',
	//			'group'       => true,
	//			'groupOptions' => [
	//				'style' => 'float: left; position: relative; left: 50%;',
	//			],
	//			'label'       => Fotorama::widget([
				'group'       => false,
				'label'       => $model->getAttributeLabel('productCategoryImages'),
				'value'       => Fotorama::widget([
					'items'   => $imgArr,
					'options' => [
						'hash' => 'true',
						'nav' => 'thumbs',
					//	'navposition' => 'top',
						'allowfullscreen' => 'true',
						'maxwidth' => '500',
						'maxheight' => '375',
					],
					
				]),
			],
			[
				'attribute'  => 'name',
				'rowOptions' => [
					'class' => 'kv-view-hidden',
				],
			],
			[
				'attribute'  => 'label',
				'label'      => '<span class="kv-edit-hidden" style="float: right">' . $model->getAttributeLabel('category') . '</span><span class="kv-view-hidden" style="float: right">' . $model->getAttributeLabel('label') . '</span>',
			],
			[
				'attribute'     => 'parent_id',
				'label'         => $model->getAttributeLabel('parentProductCategory'),
				'value'         => (null != $model->parentProductCategory) ? $model->parentProductCategory->label : null,
				'type'          => DetailView::INPUT_SELECT2, 
				'widgetOptions' => [
					'data'    => ProductCategory::asIdLabelMap($model->id),
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
				'attribute'  => 'description'             ,
				'format'     => 'ntext'                   ,
				'type'       => DetailView::INPUT_TEXTAREA,
			],
		],
	]) ?>
</div>
