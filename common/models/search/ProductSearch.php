<?php

namespace common\models\search;

use Yii;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;
use common\models\Product;

/**
 * This is the model class for table "{{%product_master}}".
 *
 * @inheritdoc
 *
 */
class ProductSearch extends Product {

	/**
	 * @inheritdoc
	 * add related fields to searchable attributes
	 */
	public function attributes() {
		return ArrayHelper::merge(parent::attributes(), [
			'productSubCategory.id',
			'productSubCategory.name',
			'productSubCategory.label',
			'productSubCategory.description',
			'productSubCategory.productCategory.id',
			'productSubCategory.productCategory.name',
			'productSubCategory.productCategory.label',
			'productSubCategory.productCategory.description',
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
			[['productSubCategory.id'], 'integer'],
			[['productSubCategory.description'], 'string'],
			[['productSubCategory.name', 'productSubCategory.label'], 'string'],
			[['productSubCategory.productCategory.id'], 'integer'],
			[['productSubCategory.productCategory.name', 'productSubCategory.productCategory.label'], 'string'],
			[['productSubCategory.productCategory.description'], 'string'],
		];
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			'label' => Yii::t('app', 'Product'),
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
					'productSubCategory.productCategory.id' => [
						'asc'     => ['productCategory.id' => SORT_ASC ],
						'desc'    => ['productCategory.id' => SORT_DESC],
						'default' => 'asc' ,
					],
					'productSubCategory.productCategory.name' => [
						'asc'     => ['productCategory.name' => SORT_ASC ],
						'desc'    => ['productCategory.name' => SORT_DESC],
						'default' => 'asc' ,
					],
					'productSubCategory.productCategory.label' => [
						'asc'     => ['productCategory.label' => SORT_ASC ],
						'desc'    => ['productCategory.label' => SORT_DESC],
						'default' => 'asc' ,
					],
				],
				'defaultOrder' => [
					'productSubCategory.productCategory.label' => 'default'  ,
					'productSubCategory.label'                 => SORT_ASC  ,
					'label'                                    => SORT_ASC  ,
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

		$query->andFilterWhere(['LIKE', 'id'                             , $this->id                                                             ]);
		$query->andFilterWhere(['LIKE', 'name'                           , $this->name                                                           ]);
		$query->andFilterWhere(['LIKE', 'label'                          , $this->label                                                          ]);
		$query->andFilterWhere(['LIKE', 'description'                    , $this->description                                                    ]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.id'          , $this->getAttribute('productSubCategory.id'                          )]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.name'        , $this->getAttribute('productSubCategory.name'                        )]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.label'       , $this->getAttribute('productSubCategory.label'                       )]);
		$query->andFilterWhere(['LIKE', 'productSubCategory.description' , $this->getAttribute('productSubCategory.description'                 )]);
		$query->andFilterWhere(['LIKE', 'productCategory.id'             , $this->getAttribute('productSubCategory.productCategory.id'          )]);
		$query->andFilterWhere(['LIKE', 'productCategory.name'           , $this->getAttribute('productSubCategory.productCategory.name'        )]);
		$query->andFilterWhere(['LIKE', 'productCategory.label'          , $this->getAttribute('productSubCategory.productCategory.label'       )]);
		$query->andFilterWhere(['LIKE', 'productCategory.description'    , $this->getAttribute('productSubCategory.productCategory.description' )]);

		return $dataProvider;
	}

}
?>
