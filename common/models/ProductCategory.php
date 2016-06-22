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
 * @property MapProductMasterProductCategory[] $mapProductMasterProductCategories
 * @property ProductCategory[] $childProductCategories
 * @property ProductCategory $parentProductCategory
 *
 */
class ProductCategory extends BaseProductCategory {

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

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getMapProductMasterProductCategories() {
		return $this->hasMany(MapProductMasterProductCategory::className(), ['product_category_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getChildProductCategories() {
		return $this->hasMany(ProductCategory::className(), ['parent_id' => 'id']);
	}

	/**
	 * @return \yii\db\ActiveQuery
	 */
	public function getParentProductCategory() {
		return $this->hasOne(ProductCategory::className(), ['id' => 'parent_id']);
	}

	public function makeTree() {
		$out = $this->makeChildTree();
		$out = $this->makeParentTree($out);

		return $out;
	}

	private function makeChildTree() {
		$out = ['id' => $this->id, 'label' => $this->label];

		$children = [];

		if(! empty($this->childProductCategories)) {
			foreach($this->childProductCategories AS $childProductCategory) {
				$child = $childProductCategory->makeChildTree();
				$children[] = $child;
			}
		}

		$out['children'] = $children;

		return $out;
	}

	private function makeParentTree($out) {
		if(null != $this->parentProductCategory) {
			$parent = ['id' => $this->parentProductCategory->id, 'label' => $this->parentProductCategory->label];
			$children[] = $out;
			$parent['children'] = $children;
			$out = $parent;
			$out = $this->parentProductCategory->makeParentTree($out);
		}

		return $out;
	}

	public function makeTreeUL() {
		$tree = $this->makeTree();
		$out = "<ul>" . "\n";
		$out = $out . $this->makeTreeLI($tree, $this->id);

		$out = $out . "\n" . "</ul>";
	//	var_dump($out);
		return $out;
	}

	private function makeTreeLI($tree, $selectedId) {
		$out = "<li>" . ($selectedId == $tree['id'] ? "<b>" : '') . $tree['label'] . ($selectedId == $tree['id'] ? "</b>" : '') . "</li>" . "\n";
	//	$out = "<li>" . $tree['label'] . "</li>" . "\n";

		if(! empty($tree['children'])) {
			$out = $out . "<ul>" . "\n";
			foreach($tree['children'] AS $child) {
				$out = $out . $this->makeTreeLI($child, $selectedId);
			}
			$out = $out . "\n" . "</ul>";
		}

		return $out;
	}

}
?>
