<?php
/**
 * @link
 * @copyright Copyright (c) 2016 
 * @license
 */

namespace ishtech\core\models;

use Yii;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * BaseActiveRecord extends ActiveRecord adding some useful features
 *
 */
abstract class BaseActiveRecord extends ActiveRecord {

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			]
		);
	}

}
?>
