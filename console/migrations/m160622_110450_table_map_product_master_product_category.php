<?php

use ishtech\core\db\Migration;

class m160622_110450_table_map_product_master_product_category extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('{{%map_product_master_product_category}}', [
			'id'                      => $this -> primaryKey(10) -> unsigned()                                                        ,
			'product_category_id'     => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'product_master_id'       => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'description'             => $this -> text()                                                                              ,
			'is_active'               => $this -> boolean()                    -> notNull() -> defaultValue(true)                     ,
			'created_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'created_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP') ,
			'updated_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'updated_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') ,
		]);

		$this->addForeignKey('fk_product_master_product_category_category', '{{%map_product_master_product_category}}', 'product_category_id', '{{%product_category}}', 'id');
		$this->addForeignKey('fk_product_master_product_category_product' , '{{%map_product_master_product_category}}', 'product_master_id'  , '{{%product_master}}'  , 'id');

		$this->addUniqueConstraint('{{%map_product_master_product_category}}', 'uk_product_master_product_category', ['product_category_id', 'product_master_id']);
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropForeignKey('fk_product_master_product_category_category', '{{%map_product_master_product_category}}');
		$this->dropForeignKey('fk_product_master_product_category_product', '{{%map_product_master_product_category}}');
		$this->dropUniqueConstraint('{{%map_product_master_product_category}}', 'uk_product_master_product_category');
		$this->dropTable('{{%map_product_master_product_category}}');
	}

}
