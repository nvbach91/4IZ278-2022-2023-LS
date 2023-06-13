<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\Item;
use App\Model\Entity\OrderItem;
use Nette\Database\Row;

/**
 * Item service
 *
 * Service containing methods for work with Item table.
 */
class OrderItemService extends BaseService {

	public function getOrderItems(string $idOrder): array {

		$result = [];
		$orderItems = $this->databaseC->query('SELECT oi.*, i.price, i.name, i.description, i.type FROM order_item oi INNER JOIN item i USING (id_item) WHERE oi.id_order = ? ORDER BY i.name;', $idOrder)->fetchAll();

		foreach ($orderItems as $oI) {

			$result[] = OrderItem::create(
				$oI->id_order_item,
				$oI->id_order,
				Item::create(Row::from([$oI->id_item, $oI->price, $oI->name, $oI->description, $oI->type])),
				$oI->count,
				$oI->state
			);

		}

		return $result;

	}

	public function getOrderItemsOfType(string $idOrder, string $type): array {

		$result = [];
		$orderItems = $this->databaseC->query('SELECT oi.*, i.price, i.name, i.description, i.type FROM order_item oi INNER JOIN item i USING (id_item) WHERE oi.id_order = ? AND i.type = ? ORDER BY i.name;', $idOrder, $type)->fetchAll();

		foreach ($orderItems as $oI) {

			$result[] = OrderItem::create(
				$oI->id_order_item,
				$oI->id_order,
				Item::create(Row::from([$oI->id_item, $oI->price, $oI->name, $oI->description, $oI->type])),
				$oI->count,
				$oI->state
			);

		}

		return $result;

	}

}