<?php

namespace frontend\controllers;

use Yii;
use yii\helpers\Json;
use kartik\detail\DetailView;
use ish\core\controllers\BaseController;
use app\models\Product;
use app\models\search\ProductSearch;

/**
 *
 */
class ProductController extends BaseController {

	const SAVE_BUTTON_ACTION_UPDATE = 'update';
	const SAVE_BUTTON_ACTION_CREATE = 'create';

	/**
	 * finds, updates
	 * @return Product
	 */
	public function actionView($id) {

		$model = $this->findModel($id);
		$saveButtonAction = null;

		if ($model) {
			$enableEditMode = true;
			$saveButtonAction = self::SAVE_BUTTON_ACTION_UPDATE;
		} else {
			Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'Product (id = '. $id . ') not found'));
			$model = new Product();
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
		$model = Product::findOne($id);
		return $model;
	}

	public function actionUpdate() {
		$saveButtonAction = Yii::$app->request->post("saveButtonAction");

		$model = null;
		$id = null;

		if ($saveButtonAction == self::SAVE_BUTTON_ACTION_UPDATE ) {
			$id = Yii::$app->request->post("Product")["id"];
			$model = $this->findModel($id);

			if ($model) {
				$model->setScenario(Product::SCENARIO_UPDATE);
				$model->load(Yii::$app->request->post());var_dump($model);die();
				if ($this->saveModel($model)) {
					return $this->redirect(['view', 'id' => $model->id]);
				}
			} else {
				Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'Product (id = '. $id . ') not found to update.'));
			}

		} else {
			Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'Invalid Action.'));
			$model = new Product();
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

		$model = new Product();
		$model->load(Yii::$app->request->post());

		if ($saveButtonAction == self::SAVE_BUTTON_ACTION_CREATE)  {
			$model->setScenario(Product::SCENARIO_INSERT);

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
			Yii::$app->session->setFlash('kv-detail-success', Yii::t('app', 'Products saved successfully.'));
			return true;
		} else {
			Yii::$app->session->setFlash('kv-detail-error', Yii::t('app', 'Products save failed.'));
			return false;
		}

		return $model;
	}

	/**
	 * Lists all Product models.
	 * @return mixed
	 */
	public function actionIndex() {
		$queryParams = Yii::$app->request->queryParams;

		$searchModel = new ProductSearch();
		$dataProvider = $searchModel->search($queryParams);

		// TODO: check only admin can do

		return $this->render('index', [
			'searchModel' => $searchModel,
			'dataProvider' => $dataProvider,
		]);
	}

}
?>
