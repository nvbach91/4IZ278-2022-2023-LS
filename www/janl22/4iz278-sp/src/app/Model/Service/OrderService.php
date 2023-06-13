<?php

declare(strict_types=1);

namespace App\Model\Service;

use App\Model\Entity\Order;
use App\Model\Entity\Table;
use Exception;
use Nette;
use Nette\Application\ForbiddenRequestException;
use Nette\Http\SessionSection;
use Nette\Utils\ArrayHash;

/**
 * Order service
 *
 * Service containing methods for work with Order table.
 */
final class OrderService extends OrderItemService {

	/**
	 * Function to get all orders.
	 *
	 * @return array        If orders exists, returns array of these orders as instances of the Order Class. Otherwise, returns an empty array.
	 */
	public function getOrders(): array {

		$ordersResponse = [];
		$orders = $this->databaseE->table('restaurant_order')->order('opened DESC, created DESC, id_order')->fetchAll();

		foreach ($orders as $order) {
			$ordersResponse[] = Order::create($order);
		}

		return $ordersResponse;

	}

	/**
	 * Function to get all orders.
	 *
	 * @return array        If orders exists, returns array of these orders as instances of the Order Class. Otherwise, returns an empty array.
	 */
	public function getCustomerOrders(string $customerId, bool $onlyOpened = false): array {

		$ordersResponse = [];
		$ordersPartialQuery = $this->databaseE->table('restaurant_order')->order('opened DESC, created DESC, id_order')->where('customer', $customerId);
		$orders = $onlyOpened ? $ordersPartialQuery->where('opened', true) : $ordersPartialQuery->fetchAll();

		foreach ($orders as $order) {
			$ordersResponse[] = Order::create($order);
		}

		return $ordersResponse;

	}

	/**
	 * Function to get specified customer order.
	 *
	 * @param string $idOrder ID of the order which will be returned.
	 *
	 * @return Order|null           If order exists, function returns instance of Order Class. Otherwise, returns null.
	 * @throws Exception
	 */
	public function getCustomerOrder(string $idOrder, string $idCustomer): ?Order {

		$order = $this->databaseE->table('restaurant_order')->where('id_order', $idOrder)->fetch();

		if ($order->customer !== $idCustomer) {

			throw new ForbiddenRequestException('Přístup odepřen', 403);

		}

		return Order::create($order);

	}

	/**
	 * Function which modifies the specified order. Add items to order.
	 *
	 * @param string         $idOrder
	 * @param SessionSection $meals
	 * @param SessionSection $drinks
	 *
	 * @return void             Function has no return value.
	 * @throws Exception
	 */
	public function modifyOrder(string $idOrder, SessionSection $meals, SessionSection $drinks): void {

		try {

			$this->databaseC->beginTransaction();

			foreach ($meals as $idMeal => $meal) {
				$this->databaseC->query("INSERT INTO order_item (id_order, id_item, count) VALUES (?, ?, ?) ON CONFLICT (id_order, id_item) DO UPDATE SET count = ?;", $idOrder, $idMeal, $meal->count, $meal->count);
			}

			foreach ($drinks as $idDrink => $drink) {
				$this->databaseC->query("INSERT INTO order_item (id_order, id_item, count) VALUES (?, ?, ?) ON CONFLICT (id_order, id_item) DO UPDATE SET count = ?;", $idOrder, $idDrink, $drink->count, $drink->count);
			}

			foreach ($this->getOrderItemsOfType($idOrder, 'meal') as $savedMeal) {
				if ($meals->get((string)$savedMeal->item->id_item) === null) $this->databaseE->table('order_item')->where('id_order = ? AND id_item = ?', $idOrder, $savedMeal->item->id_item)->delete();
			}

			foreach ($this->getOrderItemsOfType($idOrder, 'drink') as $savedDrink) {
				if ($drinks->get((string)$savedDrink->item->id_item) === null) $this->databaseE->table('order_item')->where('id_order = ? AND id_item = ?', $idOrder, $savedDrink->item->id_item)->delete();
			}

		} catch (Exception $e) {

			//TODO exception handle
			$this->databaseC->rollBack();
			throw new Exception('TBD');

		}

		$this->unsetUserEditingOrder($idOrder);
		$this->databaseC->commit();

	}

	public function unsetUserEditingOrder(string $idOrder): void {

		$this->databaseC->query("UPDATE restaurant_order SET editing_user = null, edit_start_time = null WHERE id_order = ?;", $idOrder);

	}

	/**
	 * Function which creates a new order in the system.
	 *
	 * @param ArrayHash|SessionSection $data Data from the form 'NewOrderForm'.
	 *
	 * @return int|null                ID of the new created order if order was created by employee.
	 * @throws Exception
	 */
	public function newOrder(ArrayHash|SessionSection $data, bool $customerOrder = false, string $customer = null): ?int {

		if (!$customerOrder) {

			$table = Table::create($this->databaseE->table('restaurant_table')->where('id_table', $data->id_table)->fetch());

			if ($table === null) {

				throw new Nette\Database\ForeignKeyConstraintViolationException('Tento stůl neexistuje!');

			}

			return $this->databaseE->table('restaurant_order')->insert($data)->id_order;

		} else {

			$this->databaseC->beginTransaction();

			try {

				$orderId = $this->databaseC->query("INSERT INTO restaurant_order(customer) VALUES (?) RETURNING id_order;", $customer)->fetch()->id_order;

				foreach ($data as $idOrderItem => $orderItem) {

					$this->databaseC->query("INSERT INTO order_item(id_order, id_item, count) VALUES (?, ?, ?);", $orderId, $idOrderItem, $orderItem->count);

				}

			} catch (Exception $e) {

				//TODO exception handle
				$this->databaseC->rollBack();
				throw new Exception('TBD');

			}

			$this->databaseC->commit();
			return null;

		}

	}

	public function isOrderEditable(string $idOrder, string $idUser): ArrayHash {

		$order = $this->getOrder($idOrder);

		if (!$order->opened) return ArrayHash::from(['editable' => false, 'canUse' => 'none']);
		if ($order->customer !== null) return ArrayHash::from(['editable' => true, 'canUse' => 'close']);

		if ($order->editing_user !== null && $order->editing_user !== $idUser && (time() - $order->edit_start_time) < 900) {

			return ArrayHash::from(['editable' => false, 'canUse' => 'noneBecauseOtherEditing']);

		} else {

			$this->setUserEditingOrder($idOrder, $idUser);

		}

		return ArrayHash::from(['editable' => true, 'canUse' => 'all']);

	}

	/**
	 * Function to get specified order.
	 *
	 * @param string $idOrder ID of the order which will be returned.
	 *
	 * @return Order|null           If order exists, function returns instance of Order Class. Otherwise, returns null.
	 */
	public function getOrder(string $idOrder): ?Order {

		return Order::create($this->databaseE->table('restaurant_order')->where('id_order', $idOrder)->fetch());

	}

	public function setUserEditingOrder(string $idOrder, string $idUser): void {

		$this->databaseC->query("UPDATE restaurant_order SET editing_user = ?, edit_start_time = ? WHERE id_order = ?;", $idUser, time(), $idOrder);

	}

	public function deleteOrder(string $idOrder): void {

		$this->databaseE->table('restaurant_order')->where('id_order', $idOrder)->delete();

	}

}