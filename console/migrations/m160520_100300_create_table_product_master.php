<?php

use ishtech\core\db\Migration;

/**
 * Handles the creation for table `t_product_master`.
 */
class m160520_100300_create_table_product_master extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('{{%product_master}}', [
			'id'                      => $this -> primaryKey(10) -> unsigned()                                                        ,
			'product_sub_category_id' => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'name'                    => $this -> string(100)                  -> notNull()                                           ,
			'label'                   => $this -> string(100)                                                                         ,
			'lang'                    => $this -> string(2)                    -> notNull() -> defaultValue('en')                     ,
			'description'             => $this -> text()                                                                              ,
			'is_active'               => $this -> boolean()                    -> notNull() -> defaultValue(true)                     ,
			'created_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'created_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP') ,
			'updated_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'updated_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') ,
		]);

		$this->addForeignKey('fk_product_master_sub_category', '{{%product_master}}', 'product_sub_category_id', '{{%product_sub_category}}', 'id');

		$this->addUniqueConstraint('{{%product_master}}', 'uk_product_master_name_sub_category', ['product_sub_category_id', 'name']);
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropForeignKey('fk_product_master_sub_category', '{{%product_master}}');
		$this->dropUniqueConstraint('{{%product_master}}', 'uk_product_master_name_sub_category');
		$this->dropTable('{{%product_master}}');
	}

}
