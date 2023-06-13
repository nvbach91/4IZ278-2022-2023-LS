<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\Item;

/**
 * Item service
 *
 * Service containing methods for work with Item table.
 */
final class ItemService extends BaseService {

	public function getItemById(string $idItem): Item {

		return Item::create($this->databaseE->table('item')->where('id_item', $idItem)->fetch());

	}

	public function existsById(string $idItem): bool {

		return $this->databaseE->table('item')->where('id_item', $idItem)->fetch() !== null;

	}

	/**
	 * Function to get all meals.
	 *
	 * @return array        If meals exists, returns array of these meals as instances of the Item Class. Otherwise, returns an empty array.
	 */
	public function getMeals(): array {

		$mealsResult = [];
		$meals = $this->databaseC->query("SELECT * FROM item WHERE type = 'meal';")->fetchAll();

		foreach ($meals as $meal) {
			$mealsResult[] = Item::create($meal);
		}

		return $mealsResult;

	}

	/**
	 * Function to get all drinks.
	 *
	 * @return array        If drinks exists, returns array of these drinks as instances of the Item Class. Otherwise, returns an empty array.
	 */
	public function getDrinks(): array {

		$drinksResult = [];
		$drinks = $this->databaseC->query("SELECT * FROM item  WHERE type = 'drink';")->fetchAll();

		foreach ($drinks as $drink) {
			$drinksResult[] = Item::create($drink);
		}

		return $drinksResult;

	}

}