<?php

use ishtech\core\db\Migration;

/**
 * Handles the creation for table `t_product_sub_category`.
 */
class m160520_100200_create_table_product_sub_category extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('{{%product_sub_category}}', [
			'id'                  => $this -> primaryKey(10) -> unsigned()                                                        ,
			'product_category_id' => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'name'                => $this -> string(100)                  -> notNull()                                           ,
			'label'               => $this -> string(100)                                                                         ,
			'lang'                => $this -> string(2)                    -> notNull() -> defaultValue('en')                     ,
			'description'         => $this -> text()                                                                              ,
			'is_active'           => $this -> boolean()                    -> notNull() -> defaultValue(true)                     ,
			'created_by'          => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'created_at'          => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP') ,
			'updated_by'          => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'updated_at'          => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') ,
		]);

		$this->addForeignKey('fk_product_sub_category_category', '{{%product_sub_category}}', 'product_category_id', '{{%product_category}}', 'id');

		$this->addUniqueConstraint('{{%product_sub_category}}', 'uk_product_sub_category_name_category', ['product_category_id', 'name']);
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropForeignKey('fk_product_sub_category_category', '{{%product_sub_category}}');
		$this->dropUniqueConstraint('{{%product_sub_category}}', 'uk_product_sub_category_name_category');
		$this->dropTable('{{%product_sub_category}}');
	}

}
