<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\base\BaseProductSubCategory;

/**
 * This is the model class for table "{{%product_sub_category}}".
 *
 * @property integer $id
 * @property integer $product_category_id
 * @property string $name
 * @property string $label
 * @property string $language
 * @property string $description
 * @property boolean $is_active
 * @property integer $created_by
 * @property integer $updated_by
 * @property date $created_at
 * @property date $updated_at
 * @property ProductCategory $productCategory
 * @property Product[] $products
 *
 */
class ProductSubCategory extends BaseProductSubCategory {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return ArrayHelper::merge(parent::rules(), [
			[['product_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductCategory::className(), 'targetAttribute' => ['product_category_id' => 'id']],
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			'productCategory.name' => Yii::t('app', 'Category Name'),
		]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProductCategory() {
		return $this->hasOne(ProductCategory::className(), ['id' => 'product_category_id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProducts() {
		return $this->hasMany(Product::className(), ['product_sub_category_id' => 'id']);
	}

}
?>
