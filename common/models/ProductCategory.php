<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\base\BaseProductCategory;

/**
 * This is the model class for table "{{%product_category}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $label
 * @property string $language
 * @property string $description
 * @property boolean $is_active
 * @property integer $created_by
 * @property integer $updated_by
 * @property date $created_at
 * @property date $updated_at
 * @property ProductSubCategory[] $productSubCategories
 *
 */
class ProductCategory extends BaseProductCategory {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return ArrayHelper::merge(parent::rules(), [
		]);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
		]);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getProductSubCategories() {
		return $this->hasMany(ProductSubCategory::className(), ['product_category_id' => 'id']);
	}

}
?>
