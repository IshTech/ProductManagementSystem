<?php

use ishtech\core\db\Migration;

class m160622_102435_alter_table_product_master extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->dropColumn('{{%product_master}}', 'product_sub_category_id');
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->addColumn('{{%product_master}}', 'product_sub_category_id', 'INT(10) UNSIGNED NULL AFTER id');
	}

}
