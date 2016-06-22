<?php

use ishtech\core\db\Migration;

class m160622_101135_alter_table_category extends Migration {
	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->addColumn('{{%product_category}}', 'parent_id', 'INT(10) UNSIGNED NULL AFTER id');
		$this->addForeignKey('fk_product_category_parent_id', '{{%product_category}}', 'parent_id', '{{%product_category}}', 'id');
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropForeignKey('fk_product_category_parent_id', '{{%product_category}}');
		$this->dropColumn('{{%product_category}}', 'parent_id');
	}

}
