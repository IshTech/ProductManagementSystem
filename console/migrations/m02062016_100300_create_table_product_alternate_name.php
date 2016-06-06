<?php

use ishtech\core\db\Migration;

/**
 * Handles the creation for table `t_product_master`.
 */
class m02062016_100300_create_table_product_alternate_name extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('{{%product_alternate_name}}', [
			'id'                      => $this -> primaryKey(10) -> unsigned()                                                        ,
			'product_master_id'       => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'name'                    => $this -> string(100)                  -> notNull()                                           ,
			'label'                   => $this -> string(100)                                                                         ,
			'lang'                    => $this -> string(2)                    -> notNull() -> defaultValue('en')                     ,
			'description'             => $this -> text()                                                                              ,
			'is_active'               => $this -> boolean()                    -> notNull() -> defaultValue(true)                     ,
			'display_order'           => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'created_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'created_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP') ,
			'updated_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'updated_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') ,
		]);

		$this->addForeignKey('fk_product_master_alternate_name', '{{%product_alternate_name}}', 'product_master_id', '{{%product_master}}', 'id');

		$this->addUniqueConstraint('{{%product_alternate_name}}', 'uk_product_master_alternate_name', ['product_master_id', 'name']);
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropForeignKey('fk_product_master_master', '{{%product_alternate_name}}');
		$this->dropUniqueConstraint('{{%product_alternate_name}}', 'uk_product_master_name_master');
		$this->dropTable('{{%product_alternate_name}}');
	}

}
