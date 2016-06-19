<?php
/**
 * @link
 * @copyright Copyright (c) 2016
 * @license
 */

namespace ishtech\core\models;

use Yii;
use ishtech\core\behaviors\BlameableBehavior;
use ishtech\core\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * BaseActiveRecord extends BaseActiveRecord adding some useful features
 * TODO: see if trait can be used
 */
class StandardBaseActiveRecord extends BaseActiveRecord {

	const SCENARIO_DEFAULT = 'default'        ;
	const SCENARIO_UPDATE  = 'scenario_update';
	const SCENARIO_INSERT  = 'scenario_insert';

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return ArrayHelper::merge(parent::rules(),
			[
				[['description'], 'string'],
				[['is_active'], 'integer', 'min'=> '0', 'max' => '1'],
			//	[['created_by', 'updated_by'], 'integer'],
			//	[['created_at', 'updated_at'], 'date'],
			//	[['created_by', 'updated_by', 'created_at', 'updated_at'], 'safe'],
			]
		);
	}

	/**
	 * @inheritdoc
	 */
	public function behaviors() {
		return ArrayHelper::merge(parent::behaviors(),
			[
				'blameable' => [
					'class' => BlameableBehavior::className(),
				],
				'timestamp' => [
					'class' => TimestampBehavior::className(),
				],
			]
		);
	}

	/**
	 * if record is active or not
	 * @return boolean
	 */
	public function isActive() {
		if($this->is_active) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * returns records where is_active=1
	 * @return model
	 */
	public function active($status = true, $condition = null) {
		return findActive($status, $condition);
	}

	/**
	 * returns records where is_active=1
	 * @return model
	 */
	public static function findActive($status = true, $condition = null) {
		$where = null;

		if ($status || $status == 1) {
			$where = ['is_active' => true];
		} else if (! $status || $status == 0) {
			$where = ['is_active' => false];
		} else {
			// TODO: throw exception
		}

		if($condition) {
			return static::find($condition)->andWhere($where);
		} else {
			return static::find()->andWhere($where);
		}

	}

	/**
	 * returns all active DB records mathcing condition in given sort order
	 * @return BaseRecord
	 */
	public static function findAllActive($status = true, $condition = null, $order = null) {
		return static::findActive($status, $condition)->addOrderBy($order)->all();
	}

	/**
	 * returns active DB record mathcing condition
	 * @return BaseRecord
	 */
	public static function findOneActive($status = true, $condition = null) {
		return static::findActive($status, $condition)->andWhere($where)->one();
	}

	/**
	 * returns active models as map/array of name-value pairs
	 * TODO: check hasAttribute for name and value attributes
	 * @return array of name=>value
	 */
	public static function asNameValueMap() {
		$hashmap = [];
		$models = static::findAllActive();
		foreach($models as $model) {
			$hashmap = array_merge($hashmap, [$model->name => $model->value]);
		}

		return $hashmap;
	}

}
?>
