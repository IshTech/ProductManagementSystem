<?php
/**
 * @link
 * @copyright Copyright (c) 2016
 * @license
 */

namespace ishtech\core\behaviors;

/**
 * TimestampBehavior extends \yii\behaviors\TimestampBehavior.
 * It only sets parameters to `created_at` and `updated_at` by default.
 *
 * To use TimestampBehavior, insert the following code to your ActiveRecord class:
 *
 * ```php
 *	use ishtech\core\behaviors\TimestampBehavior;
 *	
 *	public function behaviors() {
 *		return [
 *			TimestampBehavior::className(),
 *		];
 *	}
 * ```
 *
 */


class TimestampBehavior extends \yii\behaviors\TimestampBehavior {

}
?>
