<?php

declare(strict_types=1);

namespace App\Model\Entity;

use DateTime;
use Nette\Database\Table\ActiveRow;

/**
 * Order class.
 *
 * This class represents one row from database as Order instance.
 */
class Order {

	/**
	 * Initializes a new instance of the Order class.
	 *
	 * @param int           $id_order ID of the order (primary key).
	 * @param DateTime|null $created  Optional parameter. Date and time when the order was created.
	 * @param int|null      $id_table Optional parameter. ID of the table to which order belongs.
	 * @param bool|null     $opened   Optional parameter. State of the order (Open/Closed - represented as number 1 or 2).
	 * @param string|null   $customer Optional parameter. ID of the customer to who order belongs.
	 */
	public function __construct(

		public int       $id_order,
		public ?DateTime $created = null,
		public ?int      $id_table = null,
		public ?bool     $opened = null,
		public ?string   $customer = null,
		public ?string   $editing_user = null,
		public ?int      $edit_start_time = null,
		public ?float    $order_tip = null

	) {}

	/**
	 * Function to create instance of Order class from Nette database active row.
	 *
	 * @param ActiveRow|null $activeRow
	 *
	 * @return Order|null                  Instance of Order class containing all order parameters.
	 */
	public static function create(?ActiveRow $activeRow): ?Order {

		if ($activeRow === null) return null;

		return new Order(...$activeRow->toArray());

	}

}