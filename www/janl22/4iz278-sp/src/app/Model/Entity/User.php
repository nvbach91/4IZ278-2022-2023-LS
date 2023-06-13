<?php

declare(strict_types=1);

namespace App\Model\Entity;

use Nette\Database\Table\ActiveRow;

/**
 * User class.
 *
 * This class represents one row from database as User instance.
 */
class User {

	/**
	 * Initializes a new instance of the User class.
	 *
	 * @param string      $id_user        id_user of the user (primary key).
	 * @param string      $display_name   Display name of the user.
	 * @param bool        $blocked        Parameter containing information if user is blocked.
	 * @param bool        $reset_password Parameter containing information if user has reseted password.
	 * @param bool        $deletable      parameter containing information if user is deletable.
	 * @param string|null $password       Optional parameter. User password from new version (Nette version).
	 */
	public function __construct(

		public string  $id_user,
		public string  $display_name,
		public ?string $password,
		public bool    $blocked,
		public bool    $reset_password,
		public bool    $deletable,
		public ?string $username,
		public bool    $employee,
		public ?string $mail,
		public ?string $id_facebook,

	) {}

	/**
	 * Function to create instance of User class from Nette database active row.
	 *
	 * @param ActiveRow|null $activeRow
	 *
	 * @return static|null                  Instance of User class containing all user parameters.
	 */
	public static function create(?ActiveRow $activeRow): ?self {

		if ($activeRow === null) return null;

		return new User(...$activeRow->toArray());

	}

}