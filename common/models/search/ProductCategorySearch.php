<?php

namespace common\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\ProductCategory;

/**
 * This is the search class for table "{{%product_category}}".
 *
 * @inheritdoc
 *
 */
class ProductCategorySearch extends ProductCategory {

	/**
	 * @inheritdoc
	 * add related fields to searchable attributes
	 */
	public function attributes() {
		return ArrayHelper::merge(parent::attributes(), [
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return [
			[['id'], 'integer'],
			[['name', 'label'], 'string'],
			[['lang'], 'string', 'max' => '2'],
			[['description'], 'string'],
			[['is_active'], 'integer', 'min'=> '0', 'max' => '1', ],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			'label' => Yii::t('app', 'Category'),
		]);
	}

	/**
	 * Creates data provider instance with search query applied
	 *
	 * @param array $params
	 *
	 * @return ActiveDataProvider
	 */
	public function search($params) {

		$query = self::find()
			->alias('cat1')
		;

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'pagination' => [
				'pageSize' => 10,
			],
			'sort' => [
				'attributes' => [
					'id'    ,
					'name'  ,
					'label' ,
				],
				'defaultOrder' => [
					'label' => SORT_ASC  ,
				],
			],
		]);

		if (!($this->load($params) && $this->validate())) {
			/**
			 * The following line will allow eager loading with job data
			 * to enable sorting by job on initial loading of the grid.
			 */
			return $dataProvider;
		}

		$query->andFilterWhere(['LIKE', 'id'          , $this->id          ]);
		$query->andFilterWhere(['LIKE', 'name'        , $this->name        ]);
		$query->andFilterWhere(['LIKE', 'label'       , $this->label       ]);
		$query->andFilterWhere(['LIKE', 'description' , $this->description ]);

		return $dataProvider;
	}

}
?>
