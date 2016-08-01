<?php

use ishtech\core\db\Migration;

/**
 * Handles the creation for table `table_product_tree`.
 */
class m160801_124610_create_table_product_tree extends Migration {

	const TABLE_NAME = '{{%product_tree}}';

	/**
	 * @inheritdoc
	 */
	public function up() {
		$tableOptions = null;
	/*
		if ($this->db->driverName === 'mysql') {
			$tableOptions = 'CHARACTER SET utf8 COLLATE utf8_general_ci ENGINE=InnoDB';
		}
	*/
		$this->createTable(self::TABLE_NAME, [
			'id'            => $this -> primaryKey(10) -> unsigned()                                     ,
			'root'          => $this -> integer(10)    -> unsigned()                                     ,
			'lft'           => $this -> integer(10)    -> unsigned() -> notNull()                        ,
			'rgt'           => $this -> integer(10)    -> unsigned() -> notNull()                        ,
			'lvl'           => $this -> smallInteger(5)              -> notNull()                        ,
			'name'          => $this -> string(100)                  -> notNull()                        ,
			'icon'          => $this -> string(255)                                                      ,
			'icon_type'     => $this -> smallInteger(1)              -> notNull() -> defaultValue(1)     ,
			'active'        => $this -> boolean()                    -> notNull() -> defaultValue(true)  ,
			'selected'      => $this -> boolean()                    -> notNull() -> defaultValue(false) ,
			'disabled'      => $this -> boolean()                    -> notNull() -> defaultValue(false) ,
			'readonly'      => $this -> boolean()                    -> notNull() -> defaultValue(false) ,
			'visible'       => $this -> boolean()                    -> notNull() -> defaultValue(true)  ,
			'collapsed'     => $this -> boolean()                    -> notNull() -> defaultValue(false) ,
			'movable_u'     => $this -> boolean()                    -> notNull() -> defaultValue(true)  ,
			'movable_d'     => $this -> boolean()                    -> notNull() -> defaultValue(true)  ,
			'movable_l'     => $this -> boolean()                    -> notNull() -> defaultValue(true)  ,
			'movable_r'     => $this -> boolean()                    -> notNull() -> defaultValue(true)  ,
			'removable'     => $this -> boolean()                    -> notNull() -> defaultValue(true)  ,
			'removable_all' => $this -> boolean()                    -> notNull() -> defaultValue(false)
		], $tableOptions);
		$this->createIndex('ix_product_tree_NK1', self::TABLE_NAME, 'root'  );
		$this->createIndex('ix_product_tree_NK2', self::TABLE_NAME, 'lft'   );
		$this->createIndex('ix_product_tree_NK3', self::TABLE_NAME, 'rgt'   );
		$this->createIndex('ix_product_tree_NK4', self::TABLE_NAME, 'lvl'   );
		$this->createIndex('ix_product_tree_NK5', self::TABLE_NAME, 'active');
	}

	/**
	 * @inheritdoc
	 */
	public function down() {
		$this->dropTable(self::TABLE_NAME);
	}
}
