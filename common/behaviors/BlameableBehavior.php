<?php
/**
 * @link
 * @copyright Copyright (c) 2016
 * @license
 */

namespace ishtech\core\behaviors;

/**
 * BlameableBehavior extends \yii\behaviors\BlameableBehavior.
 * It only sets parameters to `created_by` and `updated_by` by default.
 *
 * To use BlameableBehavior, insert the following code to your ActiveRecord class:
 *
 * ```php
 *	use ishtech\core\behaviors\BlameableBehavior;
 *	
 *	public function behaviors() {
 *		return [
 *			BlameableBehavior::className(),
 *		];
 *	}
 * ```
 *
 */

class BlameableBehavior extends \yii\behaviors\BlameableBehavior {

}
?>
