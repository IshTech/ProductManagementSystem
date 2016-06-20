<?php

namespace common\models\base;

use Yii;
use yii\helpers\ArrayHelper;
use ishtech\core\models\MasterBaseActiveRecord;

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
 *
 */
abstract class BaseProductCategory extends MasterBaseActiveRecord {

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return '{{%product_category}}';
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
