<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\Item;
use App\Model\Entity\Menu;

/**
 * Menu service
 *
 * Service containing methods for work with Menu table.
 */
final class MenuService extends BaseService {

	/**
	 * Function to get all items from actually available menu.
	 *
	 * @return array        If items exists, returns array of these items as instances of the Item Class. Otherwise, returns an empty array.
	 */
	public function getMenuItems(): array {

		$itemsResult = [];
		$items = $this->databaseC
			->query('SELECT i.* FROM menu_item NATURAL JOIN
                            (SELECT * FROM menu WHERE (date_from < CURRENT_TIMESTAMP AND CURRENT_TIMESTAMP < date_to) LIMIT 1) R1
                            NATURAL JOIN item i;')
			->fetchAll();

		foreach ($items as $item) {
			$itemsResult[] = Item::create($item);
		}

		return $itemsResult;

	}

	/**
	 * Function to get actually available menu.
	 *
	 * @return Menu|null    If menu exists, function returns instance of Menu Class. Otherwise, returns null.
	 */
	public function getMenu(): ?Menu {

		return Menu::create($this->databaseE->table('menu')->where('date_from < CURRENT_TIMESTAMP AND CURRENT_TIMESTAMP < date_to')->fetch());

	}

}