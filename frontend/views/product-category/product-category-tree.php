<?php

use yii\helpers\Html;
use kartik\grid\GridView;
//use yii\web\JqueryAsset;

//JqueryAsset::register($this);
$this->registerJsFile(Yii::$app->request->baseUrl.'/js/jstree/jstree.min.js',
	[
		'depends' => [\yii\web\JqueryAsset::className()],
//		'position' => \yii\web\View::POS_HEAD,
	]);

$this->registerCssFile(Yii::$app->request->baseUrl.'/css/jstree/style.min.css');

$this->registerJs('
    $(\'#category-tree\').jstree({
    \'plugins\': ["wholerow", "checkbox"],
        \'core\' : {
            \'data\' : ' . $data . '
        }
    }) 
'
, \yii\web\View::POS_READY
);

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

/**
 * TODO: addtional features commented out, can be sold to customer
 * TODO: to reset / clear search filters
 *
 */
?>
<div id="category-tree">
</div>
