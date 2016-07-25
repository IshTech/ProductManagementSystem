<?php

namespace common\models\base;

use Yii;
use yii\helpers\ArrayHelper;
use ishtech\core\models\StandardBaseActiveRecord;

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
abstract class BaseProductCategoryImage extends StandardBaseActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return '{{%product_category_image}}';
	}

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

}
?>
