<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Database\Table\ActiveRow;

/**
 * Table class.
 *
 * This class represents one row from database as Table instance.
 */
class Table {

	/**
	 * Initializes a new instance of the Table class.
	 *
	 * @param int      $id_table   ID of the table (primary key).
	 * @param int|null $seat_count Optional parameter. Count of the seats which table have.
	 */
	public function __construct(

		public int  $id_table,
		public ?int $seat_count

	) {}

	/**
	 * Function to create instance of Table class from Nette database active row.
	 *
	 * @param ActiveRow|null $activeRow
	 *
	 * @return static|null                  Instance of Order class containing all order parameters.
	 */
	public static function create(?ActiveRow $activeRow): ?self {

		if ($activeRow === null) return null;

		return new Table(...$activeRow->toArray());

	}

}