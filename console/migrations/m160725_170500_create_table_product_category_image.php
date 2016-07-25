<?php

use ishtech\core\db\Migration;

/**
 * Handles the creation for table `product_category_image`.
 */
class m160725_170500_create_table_product_category_image extends Migration {

	/**
	 * @inheritdoc
	 */
	public function up() {
		$this->createTable('{{%product_category_image}}', [
			'id'                      => $this -> primaryKey(10) -> unsigned()                                                        ,
			'product_category_id'     => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'local_url'               => $this -> string(191)                  -> notNull()                                           ,
			'local_file_location'     => $this -> string(255)                                                                         ,
			'local_file_name'         => $this -> string(255)                                                                         ,
			'description'             => $this -> text()                                                                              ,
			'is_active'               => $this -> boolean()                    -> notNull() -> defaultValue(true)                     ,
	//		'display_order'           => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'display_order'           => 'TINYINT(3) UNSIGNED NOT NULL'                                                               ,
			'created_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'created_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP') ,
			'updated_by'              => $this -> integer(10)    -> unsigned() -> notNull()                                           ,
			'updated_at'              => $this -> datetime()                   -> notNull() -> defaultExpression('CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP') ,
		]);

		$this->addForeignKey('fk_product_category_image', '{{%product_category_image}}', 'product_category_id', '{{%product_category}}', 'id');

		$this->addUniqueConstraint('{{%product_category_image}}', 'uk_product_category_image_local_url'    , ['local_url']);
		$this->addUniqueConstraint('{{%product_category_image}}', 'uk_product_category_image_display_order', ['product_category_id', 'display_order']);
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropForeignKey('fk_product_category_image', '{{%product_category_image}}');
		$this->dropUniqueConstraint('{{%product_category_image}}', 'uk_product_category_image_display_order');
		$this->dropUniqueConstraint('{{%product_category_image}}', 'uk_product_category_image_local_url');
		$this->dropTable('{{%product_category_image}}');
	}

}
