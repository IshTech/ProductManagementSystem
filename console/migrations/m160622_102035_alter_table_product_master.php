<?php

use ishtech\core\db\Migration;

class m160622_102035_alter_table_product_master extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->dropForeignKey('fk_product_master_sub_category', '{{%product_master}}');
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->addForeignKey('fk_product_master_sub_category', '{{%product_master}}', 'product_sub_category_id', '{{%product_sub_category}}', 'id');
	}

}
