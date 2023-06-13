<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Service\ItemService;
use App\Model\Service\orderService;
use Exception;
use JetBrains\PhpStorm\NoReturn;
use Nette\Application\AbortException;
use Nette\Application\BadRequestException;
use Nette\Utils\ArrayHash;

/**
 * Order Presenter
 *
 * This presenter represents orders page.
 */
final class MyOrdersPresenter extends BaseCustomersPresenter {

	private ItemService $itemService;
	private OrderService $orderService;


	public function __construct(ItemService $itemService, OrderService $orderService) {

		parent::__construct();

		$this->itemService = $itemService;
		$this->orderService = $orderService;

	}

	/**
	 * Function to render default template with all orders.
	 *
	 * @return void     Function has no return value.
	 */
	public function renderDefault(): void {

		$this->template->orders = $this->orderService->getCustomerOrders($this->getUser()->getId());

	}

	/**
	 * @throws AbortException
	 */
	public function renderNew(): void {

		if (!$this->getSession()->hasSection('customerOrder')) $this->redirect('Menu:');
		$this->template->orderItems = $this->getSession()->getSection('customerOrder');

	}

	/**
	 * @throws Exception
	 */
	public function renderDetail(string $idOrder): void {

		$this->template->order = $this->orderService->getCustomerOrder($idOrder, $this->getUser()->getId());
		$this->template->orderItems = $this->orderService->getOrderItems($idOrder);

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function actionAddItemToOrder(string $idItem): void {

		$itemName = $this->addItemToCartSession($idItem);
		$this->flashMessage('Položka ' . $itemName . ' byla úspěšně přidána do objednávky', 'success');

		$this->redirect('Menu:');

	}

	/**
	 * @param $idItem
	 *
	 * @return string
	 * @throws BadRequestException
	 */
	private function addItemToCartSession($idItem): string {

		if (!$this->itemService->existsById($idItem)) throw new BadRequestException('Požadovaná položka neexistuje', 400);

		$section = $this->getSession()->getSection('customerOrder');
		$item = $this->itemService->getItemById($idItem);

		$section->set((string)$item->id_item, ArrayHash::from([

			'name' => $item->name,
			'count' => $section->get((string)$item->id_item) === null ? 1 : $section->get((string)$item->id_item)->count += 1,
			'unitPrice' => $item->price

		]));

		return $item->name;

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function handleIncreaseItemOrderCount($idItem): void {

		$itemName = $this->addItemToCartSession($idItem);
		$this->flashMessage('Položka ' . $itemName . ' byla úspěšně přidána do objednávky', 'success');
		$this->redirect('this');

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function handleDecreaseItemOrderCount($idItem, $all = false): void {

		$section = $this->getSession()->getSection('customerOrder');
		$itemName = $section->get($idItem)->name;

		if (!$all) {

			$section->set($idItem, ArrayHash::from([

				'name' => $itemName,
				'count' => $section->get($idItem)->count -= 1,
				'unitPrice' => $section->get($idItem)->unitPrice

			]));

			if ($section->get($idItem)->count === 0) {

				$section->remove($idItem);

			}

		} else {

			$section->remove($idItem);

		}

		if ($this->getSession()->hasSection('customerOrder')) {

			$this->flashMessage('Položka ' . $itemName . ' byla úspěšně odebrána z objednávky', 'success');
			$this->redirect('this');

		} else {


			$this->flashMessage('Objednávka byla úspěšně zrušena', 'success');
			$this->redirect('Homepage:');

		}

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function handleCancelOrder(): void {

		$this->getSession()->getSection('customerOrder')->remove();
		$this->flashMessage('Objednávka byla úspěšně zrušena', 'success');
		$this->redirect('Homepage:');

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function handleSubmitOrder(): void {

		$this->orderService->newOrder($this->getSession()->getSection('customerOrder'), true, $this->getUser()->getId());
		$this->getSession()->getSection('customerOrder')->remove();
		$this->redirect('Homepage:');

	}

}
