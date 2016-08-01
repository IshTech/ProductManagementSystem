<?php

use yii\helpers\Html;
use kartik\tree\TreeView;
use common\models\ProductTree;

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
		'query'          => ProductTree::find()->addOrderBy('root, lft'), 
		'headingOptions' => [
			'label' => 'Categories',
		],
		'rootOptions'    => [
			'label' => '',
		],
		'fontAwesome'    => false, // optional
		'isAdmin'        => false, // optional (toggle to enable admin mode)
		'displayValue'   => 0,     // initial display value
		'softDelete'     => true,  // defaults to true
		'cacheSettings'  => [
			'enableCache' => true, // defaults to true
		]
	]); ?>

</div>
