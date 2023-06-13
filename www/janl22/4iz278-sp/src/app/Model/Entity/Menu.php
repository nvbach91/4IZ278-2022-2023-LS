<?php

declare(strict_types=1);

namespace App\Model\Entity;

use DateTime;
use Nette\Database\Table\ActiveRow;

/**
 * Menu class.
 *
 * This class represents one row from database as Menu instance.
 */
class Menu {

	/**
	 * Initializes a new instance of the Menu class.
	 *
	 * @param int           $id_menu   ID of the menu (primary key).
	 * @param DateTime|null $date_from Optional parameter. Date from which menu is valid.
	 * @param DateTime|null $date_to   Optional parameter. Date to which menu is valid.
	 */
	public function __construct(

		public int       $id_menu,
		public ?DateTime $date_from,
		public ?DateTime $date_to

	) {}

	/**
	 * Function to create instance of Menu class from Nette database active row.
	 *
	 * @param ActiveRow|null $activeRow
	 *
	 * @return static|null                  Instance of Menu class containing all menu parameters.
	 */
	public static function create(?ActiveRow $activeRow): ?self {

		if ($activeRow === null) return null;

		return new Menu(...$activeRow->toArray());

	}
}