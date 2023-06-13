<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Database\Row;
use Nette\Database\Table\ActiveRow;

/**
 * Item class.
 *
 * This class represents one row from database as Item instance.
 */
class Item {

	/**
	 * Initializes a new instance of the Item class.
	 *
	 * @param int      $id_item     ID of the item (primary key).
	 * @param float    $price       Price of the item.
	 * @param string   $name        Display name of the item.
	 * @param string   $description Description of the item.
	 * @param string   $type        Type of the item (Drink/Meal).
	 * @param int|null $state       State of the item (Active/Archived - represented as number 1 or 2).
	 */
	public function __construct(

		public int    $id_item,
		public float  $price,
		public string $name,
		public string $description,
		public string $type,
		public ?int   $state = null

	) {}

	/**
	 * Function to create instance of Item class from Nette database row.
	 *
	 * @param Row|ActiveRow|null $row
	 *
	 * @return static|null              Instance of Item class containing all item parameters.
	 */
	public static function create(Row|ActiveRow|null $row): ?Item {

		if ($row === null) return null;

		if ($row instanceof Row) {

			return new Item(...(array)$row);

		} else {

			return new Item(...$row->toArray());

		}


	}

}