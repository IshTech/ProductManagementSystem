<?php
return [
	'gridview' =>  [
		'class' => '\kartik\grid\Module',
		// enter optional module parameters below - only if you need to  
		// use your own export download action or custom translation 
		// message source
		// 'downloadAction' => 'gridview/export/download',
		// 'i18n' => []
	],
	'treemanager' =>  [
		'class' => '\kartik\tree\Module',
		// other module settings, refer detailed documentation
	//	'treeStructure' =>  [
	//		'treeAttribute' => 'parent_id',
	//		'leftAttribute' => 'parent_id',
	//		'rightAttribute' => 'id',
	//		'depthAttribute' => 'parent_id',
	//	],
	//	'dataStructure' =>  [
	//		'keyAttribute' => 'id',
	//		'nameAttribute' => 'label',
	//		'iconAttribute' => 'name',
	//		'iconTypeAttribute' => 'is_active',
	//	],
	],
];
