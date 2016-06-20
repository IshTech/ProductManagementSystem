<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\base\BaseProduct;

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
class Product extends BaseProduct {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return ArrayHelper::merge(parent::rules(), [
			[['product_sub_category_id'], 'exist', 'skipOnError' => true, 'targetClass' => ProductSubCategory::className(), 'targetAttribute' => ['product_sub_category_id' => 'id']],
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			'product.label' => Yii::t('app', 'Product'),
			'productSubCategory.name' => Yii::t('app', 'Sub-Category Name'),
			'productSubCategory.label' => Yii::t('app', 'Sub-Category'),
			'productSubCategory.productCategory.name' => Yii::t('app', 'Category Name'),
			'productSubCategory.productCategory.label' => Yii::t('app', 'Category'),
		]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProductSubCategory() {
		return $this->hasOne(ProductSubCategory::className(), ['id' => 'product_sub_category_id']);
	}

}
?>
