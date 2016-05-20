<?php

use ishtech\core\db\Migration;

/**
 * Handles the creation for table `t_product_category`.
 */
class m160520_100108_create_table_product_category extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('{{%product_category}}', [
			'id'               => $this -> primaryKey(10) -> unsigned()                                                        ,
			'name'             => $this -> string(100)                  -> notNull()                                           ,
			'label'            => $this -> string(100)                                                                         ,
			'lang'             => $this -> string(2)                    -> notNull() -> defaultValue('en')                     ,
			'description'      => $this -> text()                                                                              ,
			'is_active'        => $this -> boolean()                    -> notNull() -> defaultValue(true)                     ,
			'created_by'       => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'created_at'       => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP') ,
			'updated_by'       => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'updated_at'       => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') ,
		]);

		$this->addUniqueConstraint('{{%product_category}}', 'uk_product_category_name', ['name']);
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropUniqueConstraint('{{%product_category}}', 'uk_product_category_name');
		$this->dropTable('{{%product_category}}');
	}

}
