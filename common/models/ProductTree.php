<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;
use ishtech\core\models\BaseActiveRecord;


/**
 * This is the model class for table "{{%product_tree}}".
 *
 * @property string $id
 * @property string $root
 * @property string $lft
 * @property string $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 */
class ProductTree extends \ishtech\core\models\BaseActiveRecord {

	use \kartik\tree\models\TreeTrait {
		isDisabled as parentIsDisabled; // note the alias
	}

	/**
	 * @var string the classname for the TreeQuery that implements the NestedSetQueryBehavior.
	 * If not set this will default to `kartik\tree\models\TreeQuery`.
	 */
	public static $treeQueryClass; // change if you need to set your own TreeQuery

	/**
	 * @var bool whether to HTML encode the tree node names. Defaults to `true`.
	 */
	public $encodeNodeNames = true;

	/**
	 * @var bool whether to HTML purify the tree node icon content before saving.
	 * Defaults to `true`.
	 */
	public $purifyNodeIcons = true;

	/**
	 * @var array activation errors for the node
	 */
	public $nodeActivationErrors = [];

	/**
	 * @var array node removal errors
	 */
	public $nodeRemovalErrors = [];

	/**
	 * @var bool attribute to cache the `active` state before a model update. Defaults to `true`.
	 */
	public $activeOrig = true;

	/**
	 * @inheritdoc
	 */
	public static function tableName() {
		return '{{%product_tree}}';
	}

	/**
	 * @inheritdoc
	 *//*
	public function rules() {
		return ArrayHelper::merge(parent::rules(), [
			[['root', 'lft', 'rgt', 'lvl', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all'], 'integer'],
			[['lft', 'rgt', 'lvl', 'name'], 'required'],
			[['name'], 'string', 'max' => 100],
			[['icon'], 'string', 'max' => 255],
		]);
	}
*/
	/**
	 * @inheritdoc
	 *//*
	public function attributeLabels() {
		return ArrayHelper::merge(parent::attributeLabels(), [
			'id' => 'ID',
			'root' => 'Root',
			'lft' => 'Lft',
			'rgt' => 'Rgt',
			'lvl' => 'Lvl',
			'name' => 'Name',
			'icon' => 'Icon',
			'icon_type' => 'Icon Type',
			'active' => 'Active',
			'selected' => 'Selected',
			'disabled' => 'Disabled',
			'readonly' => 'Readonly',
			'visible' => 'Visible',
			'collapsed' => 'Collapsed',
			'movable_u' => 'Movable U',
			'movable_d' => 'Movable D',
			'movable_l' => 'Movable L',
			'movable_r' => 'Movable R',
			'removable' => 'Removable',
			'removable_all' => 'Removable All',
		]);
	}
*/
	/**
	 * Override isDisabled method if you need as shown in the  
	 * example below. You can override similarly other methods
	 * like isActive, isMovable etc.
	 */
	public function isDisabled() {
	/*
		if (Yii::$app->user->username !== 'admin') {
			return true;
		}
	*/
		return $this->parentIsDisabled();
	}
}
