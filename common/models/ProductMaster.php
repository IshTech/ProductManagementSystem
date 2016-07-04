<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use common\models\base\BaseProductMaster;

/**
 * This is the model class for table "{{%product_master}}".
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
 * @property MapProductMasterProductCategory $mapProductMasterProductCategory
 *
 */
class ProductMaster extends BaseProductMaster {

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
			'productMaster.label' => Yii::t('app', 'ProductMaster'),
			'mapProductMasterProductCategory.productCategory.name' => Yii::t('app', 'Category Name'),
			'mapProductMasterProductCategory.productCategory.label' => Yii::t('app', 'Category'),
		]);
	}
44
	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMapProductMasterProductCategory() {
		return $this->hasOne(MapProductMasterProductCategory::className(), ['id' => 'product_sub_category_id']);
	}

	public function getProduct_category_id() {
		return (null != $this->mapProductMasterProductCategory) ? $this->mapProductMasterProductCategory->product_category_id : null;
	}

}
?>
