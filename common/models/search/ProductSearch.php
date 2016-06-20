<?php

namespace common\models\search;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\Product;

/**
 * This is the model class for table "{{%product_master}}".
 *
 * @property integer $id
 * @property integer $product_sub_category_id
 * @property string $name
 * @property string $label
 * @property string $language
 * @property string $description
 * @property boolean $is_active
 * @property integer $created_by
 * @property integer $updated_by
 * @property date $created_at
 * @property date $updated_at
 * @property ProductSubCategory $productSubCategory
 *
 */
class ProductSearch extends Product {

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
			[['productSubCategory.id'], 'integer'],
			[['productCategory.name'], 'string'],
			[['productSubCategory.name'], 'string'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
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

		$query = self::find()->alias('p')
			->joinWith('productSubCategory AS productSubCategory')
			->joinWith('productSubCategory.productCategory AS productCategory')
		;

		$dataProvider = new ActiveDataProvider([
			'query' => $query,
			'sort' => [
				'attributes' => [
					'id'                       ,
					'name'                     ,
					'label'                    ,
					'productSubCategory.id'    ,
					'productSubCategory.name'  ,
					'productSubCategory.label' ,
					'productCategory.id'       ,
					'productCategory.name'     ,
					'productCategory.label'    ,
				],
				'defaultOrder' => [
					'productCategory.label'    => SORT_ASC  ,
					'productSubCategory.label' => SORT_ASC  ,
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

		$query->andFilterWhere(['LIKE', 'id'                             , $this->id                                            ]);
		$query->andFilterWhere(['LIKE', 'name'                           , $this->name                                          ]);
		$query->andFilterWhere(['LIKE', 'label'                          , $this->label                                         ]);
		$query->andFilterWhere(['LIKE', 'description'                    , $this->description                                   ]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.id'          , $this->getAttribute('productSubCategory.id'         )]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.name'        , $this->getAttribute('productSubCategory.name'       )]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.label'       , $this->getAttribute('productSubCategory.label'      )]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.description' , $this->getAttribute('productSubCategory.description')]);
		$query->andFilterWhere(['LIKE', 'productCategory.id'             , $this->getAttribute('productCategory.id'            )]);
		$query->andFilterWhere(['LIKE', 'productCategory.name'           , $this->getAttribute('productCategory.name'          )]);
		$query->andFilterWhere(['LIKE', 'productCategory.label'          , $this->getAttribute('productCategory.label'         )]);
		$query->andFilterWhere(['LIKE', 'productCategory.description'    , $this->getAttribute('productCategory.description'   )]);

		return $dataProvider;
	}

}
?>
