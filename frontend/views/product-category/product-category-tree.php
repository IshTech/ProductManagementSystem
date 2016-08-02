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
    \'plugins\': ["wholerow", "types", "search"],
        \'core\' : {
            \'data\' : ' . $data . '
        }
    })
', \yii\web\View::POS_READY
);

$this->registerJs('
$(\'#searchTreeText\').keyup(function() {
	var text = $(this).val();
	searchTree(text);
});

function searchTree(text) {
	$(\'#category-tree\').jstree(true).search(text);
}
', \yii\web\View::POS_END
);

$this->title = Yii::t('app', 'Categories');
$this->params['breadcrumbs'][] = $this->title;

<div class="col-sm-3">
	<input type="text" class="form-control input-sm" placeholder="Type to search..." id="searchTreeText" name="searchTreeText"/>
</div>
<div id="category-tree">
</div>
