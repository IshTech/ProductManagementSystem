<?php
namespace ishtech\core\db;

use Yii;

/**
 * base class for db Migration
 */
class Migration extends \yii\db\Migration {

	public function createView($view, $sql) {
		// TODO: check if $sql starts with select keyword
		$stmt = 'CREATE VIEW ' . $view . ' AS ' . $sql;

		return $this->execute($stmt);
	}

	public function dropView($view) {
		$stmt = 'DROP VIEW ' . $view;

		return $this->execute($stmt);
	}

	public function addUniqueConstraint($table, $constraintName, $columns) {
		$stmt =
			  'ALTER TABLE ' . $table
			. ' ADD CONSTRAINT ' . $constraintName 
			. ' UNIQUE (' . implode(', ', $columns) . ')';

		return $this->execute($stmt);
	}

	/**
	 * TODO: works only for MySQL, make it generic
	 */
	public function dropUniqueConstraint($table, $constraintName, $columns = null) {
		return $this->dropIndex($constraintName, $table);
	}

}
?>
