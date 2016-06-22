<?php

use yii\helpers\Html;
use kartik\tree\TreeView;
use common\models\ProductCategory;

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

/**
 * TODO: addtional features commented out, can be sold to customer
 * TODO: to reset / clear search filters
 *
 */
?>
<div class="category-index">

	<?= TreeView::widget([
		// single query fetch to render the tree
		// use the Product model you have in the previous step
		'query'          => ProductCategory::find(),
		'headingOptions' => [
			'label' => 'Categories'
		],
		'fontAwesome'    => false, // optional
		'isAdmin'        => false, // optional (toggle to enable admin mode)
	//	'displayValue'   => 1,     // initial display value
		'softDelete'     => true,  // defaults to true
		'cacheSettings'  => [
			'enableCache' => true, // defaults to true
		]
	]); ?>

</div>
