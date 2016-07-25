<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\base\BaseProductCategoryImage;

/**
 * This is the model class for table "{{%product_category_image}}".
 *
 * @property integer $id
 * @property string $local_url
 * @property string $local_file_location
 * @property string $local_file_name
 * @property string $description
 * @property boolean $is_active
 * @property integer $display_order
 * @property integer $created_by
 * @property integer $updated_by
 * @property date $created_at
 * @property date $updated_at
 *
 */
class ProductCategoryImage extends BaseProductCategoryImage {

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
	public function getProductCategory() {
		return $this->hasOne(ProductCategory::className(), ['id' => 'product_category_id']);
	}

}
?>
