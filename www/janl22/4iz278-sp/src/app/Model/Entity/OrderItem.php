<?php

declare(strict_types=1);

namespace App\Model\Entity;

/**
 * Item class.
 *
 * This class represents one row from database as Item instance.
 */
class OrderItem {

	/**
	 * Initializes a new instance of the Item class.
	 *
	 * @param int  $id_order_item ID of the item (primary key).
	 * @param int  $id_order
	 * @param Item $item
	 * @param int  $count
	 * @param int  $state         State of the item (Active/Archived - represented as number 1 or 2).
	 */
	public function __construct(

		public int  $id_order_item,
		public int  $id_order,
		public Item $item,
		public int  $count,
		public int  $state

	) {}

	/**
	 * Function to create instance of Item class.
	 *
	 * @param int  $idOrderItem
	 * @param int  $idOrder
	 * @param Item $item
	 * @param int  $count
	 * @param int  $state
	 *
	 * @return OrderItem Instance of Item class containing all item parameters.
	 */
	public static function create(int $idOrderItem, int $idOrder, Item $item, int $count, int $state): OrderItem {

		return new OrderItem($idOrderItem, $idOrder, $item, $count, $state);

	}

}