<?php
/**
 * @link
 * @copyright Copyright (c) 2016
 * @license
 */

namespace ishtech\core\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * BaseActiveRecord extends BaseActiveRecord adding some useful features
 * TODO: see if trait can be used
 */
abstract class MasterBaseActiveRecord extends StandardBaseActiveRecord {

	/**
	 * @inheritdoc
	 */
	public function rules() {
		return ArrayHelper::merge(parent::rules(),
			[
				[['name', 'label'], 'string'],
				[['name'], 'required'],
				[['lang'], 'string', 'max' => '2'],
	//			[['lang'], 'required'],
				['lang', 'default', 'value' => 'en', 'on' => [self::SCENARIO_INSERT, ], 'skipOnError' => true, ],
				[['name'], 'unique', 'on' => [self::SCENARIO_DEFAULT, self::SCENARIO_UPDATE, self::SCENARIO_INSERT, ], 'skipOnError' => true, ],
			]
		);
	}

	/**
	 * @inheritdoc
	 */
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			'name'  => Yii::t('app', 'Name'    ),
			'label' => Yii::t('app', 'Label'   ),
			'lang'  => Yii::t('app', 'Language'),
		]);
	}

}
?>
