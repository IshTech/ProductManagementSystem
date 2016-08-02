<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\ArrayHelper;
use yii\helpers\Json;
use kartik\detail\DetailView;
use ishtech\core\controllers\BaseController;
use common\models\ProductCategory;
use common\models\search\ProductCategorySearch;

/**
 *
 */
class ProductCategoryController extends BaseController {

	const SAVE_BUTTON_ACTION_UPDATE = 'update';
	const SAVE_BUTTON_ACTION_CREATE = 'create';

	/**
	 * finds, updates
	 * @return ProductCategory
	 */
	public function actionView($id) {

		$model = $this->findModel($id);
		$saveButtonAction = null;

		if ($model) {
			$enableEditMode = true;
			$saveButtonAction = self::SAVE_BUTTON_ACTION_UPDATE;
		} else {
			Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'ProductCategory (id = '. $id . ') not found'));
			$model = new ProductCategory();
			$enableEditMode = false;
		}

		return $this->render('view', [
			'model'            => $model,
			'id'               => $id,
			'enableEditMode'   => $enableEditMode,
			'saveButtonAction' => $saveButtonAction,
		]);

	}

	private function findModel($id) {
		$model = ProductCategory::findOne($id);
		return $model;
	}

	public function actionUpdate() {
		$saveButtonAction = Yii::$app->request->post("saveButtonAction");

		$model = null;
		$id = null;

		if ($saveButtonAction == self::SAVE_BUTTON_ACTION_UPDATE ) {
			$id = Yii::$app->request->post("ProductCategory")["id"];
			$model = $this->findModel($id);

			if ($model) {
				$model->setScenario(ProductCategory::SCENARIO_UPDATE);
				$model->load(Yii::$app->request->post());
				if ($this->saveModel($model)) {
					return $this->redirect(['view', 'id' => $model->id]);
				}
			} else {
				Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'ProductCategory (id = '. $id . ') not found to update.'));
			}

		} else {
			Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'Invalid Action.'));
			$model = new ProductCategory();
			$model->load(Yii::$app->request->post());
		}

		// TODO: use renderPartial
		return $this->render('view', [
			'model'            => $model,
			'id'               => $id,
			'enableEditMode'   => true,
			'saveButtonAction' => $saveButtonAction,
			'mode'             => DetailView::MODE_EDIT,
		]);

	}

	public function actionCreate() {
		$saveButtonAction = Yii::$app->request->post("saveButtonAction");

		$model = new ProductCategory();
		$model->load(Yii::$app->request->post());

		if ($saveButtonAction == self::SAVE_BUTTON_ACTION_CREATE)  {
			$model->setScenario(ProductCategory::SCENARIO_INSERT);

			if ($this->saveModel($model)) {
				return $this->redirect(['view', 'id' => $model->id]);
			}
		} else {
			Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'Invalid Action.'));
		}

		// TODO: use renderPartial
		return $this->render('view', [
			'model'            => $model,
			'id'               => null,
			'enableEditMode'   => true,
			'saveButtonAction' => $saveButtonAction,
			'mode'             => DetailView::MODE_EDIT,
		]);

	}

	private function saveModel($model) {
		if ($model->validate() && $model->save()) {
			Yii::$app->session->setFlash('kv-detail-success', Yii::t('app', 'ProductCategory saved successfully.'));
			return true;
		} else {
			Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'ProductCategory save failed.'));
			return false;
		}

		return $model;
	}

	/**
	 * Lists all ProductCategory models.
	 * @return mixed
	 */
	public function actionIndex() {
		$queryParams = Yii::$app->request->queryParams;

		$searchModel = new ProductCategorySearch();
		$dataProvider = $searchModel->search($queryParams);

		// TODO: check only admin can do

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

	public function actionViewCreate() {
		$model = new ProductCategory();

		$enableEditMode = true;
		$saveButtonAction = self::SAVE_BUTTON_ACTION_CREATE;

		return $this->render('view', [
			'model'            => $model                ,
			'mode'             => DetailView::MODE_EDIT ,
			'enableEditMode'   => $enableEditMode       ,
			'saveButtonAction' => $saveButtonAction     ,
		]);

	}

	public function actionForCategory() {
		$out = [];
		if (isset($_POST['depdrop_parents'])) {
			$parents = $_POST['depdrop_parents'];
			if ($parents != null) {
				$product_catgegory_id = $parents[0];
				$out = ProductCategory::mapForDepDropdown($product_catgegory_id);
				// the getSubCatList function will query the database based on the
				// cat_id and return an array like below:
				// [
				//    ['id'=>'<sub-cat-id-1>', 'name'=>'<sub-cat-name1>'],
				//    ['id'=>'<sub-cat_id_2>', 'name'=>'<sub-cat-name2>']
				// ]
				echo Json::encode(['output'=>$out, 'selected'=>'']);
				return;
			}
		}
		echo Json::encode(['output'=>'', 'selected'=>'']);
	}

	/**
	 * ProductTree rendering.
	 * @return mixed
	 */
	public function actionCategoryTree() {
		return $this->render('category-tree');
	}

	/**
	 * ProductCategory as tree rendering.
	 * @return mixed
	 */
	public function actionProductCategoryTree() {
		$productCategories = ProductCategory::findAll(['parent_id' => null]);
		$properties = [
			'common\models\ProductCategory' => [
				'id',
				'text' => 'label',
				'parent_id' => function ($productCategory) {
					return (null == $productCategory->parent_id) ? 0 : $productCategory->parent_id;
				},
				'children' => 'childProductCategories',
				'icon' => function () {
					return "fa fa-tags";
				},
			],
		];
		$arr = ArrayHelper::toArray($productCategories, $properties, true);
		$data = Json::encode($arr);
		return $this->render('product-category-tree', ['data' => $data]);
	}

}
?>
