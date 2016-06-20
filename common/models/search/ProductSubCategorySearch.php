<?php

namespace common\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\ProductSubCategory;

/**
 * This is the search class for table "{{%product_sub_category}}".
 *
 * @inheritdoc
 *
 */
class ProductSubCategorySearch extends ProductSubCategory {

	/**
	 * @inheritdoc
	 * add related fields to searchable attributes
	 */
	public function attributes() {
		return ArrayHelper::merge(parent::attributes(), [
			'id',
			'name',
			'label',
			'description',
			'productCategory.id',
			'productCategory.name',
			'productCategory.label',
			'productCategory.description',
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
			[['productCategory.id'], 'integer'],
			[['productCategory.name', 'productCategory.label'], 'string'],
			[['productCategory.description'], 'string'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			'label' => Yii::t('app', 'Sub-Category'),
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

		$query = self::find()->alias('ps')
			->joinWith('productCategory AS productCategory')
		;

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'attributes' => [
					'id'                       ,
					'name'                     ,
					'label'                    ,
					'productCategory.id'       ,
					'productCategory.name'     ,
					'productCategory.label'    ,
				],
				'defaultOrder' => [
					'productCategory.label'    => SORT_ASC  ,
					'label'                    => SORT_ASC  ,
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

		$query->andFilterWhere(['LIKE', 'id'                             , $this->id                                          ]);
		$query->andFilterWhere(['LIKE', 'name'                           , $this->name                                        ]);
		$query->andFilterWhere(['LIKE', 'label'                          , $this->label                                       ]);
		$query->andFilterWhere(['LIKE', 'description'                    , $this->description                                 ]);
		$query->andFilterWhere(['LIKE', 'productCategory.id'             , $this->getAttribute('productCategory.id'          )]);
		$query->andFilterWhere(['LIKE', 'productCategory.name'           , $this->getAttribute('productCategory.name'        )]);
		$query->andFilterWhere(['LIKE', 'productCategory.label'          , $this->getAttribute('productCategory.label'       )]);
		$query->andFilterWhere(['LIKE', 'productCategory.description'    , $this->getAttribute('productCategory.description' )]);

		return $dataProvider;
	}

}
?>
