<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Database\Table\ActiveRow;

/**
 * Permission class.
 *
 * This class represents one row from database as Permission instance.
 */
class Permission {

	/**
	 * Initializes a new instance of the Permission class.
	 *
	 * @param string      $permission  Key of the permission (primary key).
	 * @param string|null $description Optional parameter. Description of the permission (name, etc.).
	 */
	public function __construct(

		public string  $permission,
		public ?string $description,

	) {}

	/**
	 * Function to create instance of Permission class from Nette database active row.
	 *
	 * @param ActiveRow|null $activeRow
	 *
	 * @return static|null                  Instance of Permission class containing all permission parameters.
	 */
	public static function create(?ActiveRow $activeRow): ?self {

		if ($activeRow === null) return null;

		return new Permission(...$activeRow->toArray());

	}

}