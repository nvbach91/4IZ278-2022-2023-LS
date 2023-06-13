<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Entity\OrderItem;
use App\Model\Service\ItemService;
use App\Model\Service\orderService;
use JetBrains\PhpStorm\NoReturn;
use Nette;
use Nette\Application\AbortException;
use Nette\Application\BadRequestException;
use Nette\Utils\ArrayHash;

/**
 * Order Presenter
 *
 * This presenter represents orders page.
 */
final class OrdersPresenter extends BaseEmployeesPresenter {

	private ItemService $itemService;
	private OrderService $orderService;

	public function __construct(ItemService $itemService, OrderService $orderService) {

		parent::__construct();

		$this->itemService = $itemService;
		$this->orderService = $orderService;

	}

	/**
	 * Function to check if logged user has necessary permission (waiter or cook) to access this resource. If no, redirect to dashboard.
	 *
	 * @return void     Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function startup(): void {

		parent::startup();

		if (!($this->getUser()->isInRole('waiter') || $this->getUser()->isInRole('cook'))) {

			$this->flashMessage('Pro přístup k objednávkám nemáte potřebná oprávnění!', 'danger');
			$this->redirect('Intra:Dashboard');

		}

	}

	/**
	 * Function to render default template with all orders.
	 *
	 * @return void     Function has no return value.
	 */
	public function renderDefault(): void {

		if ($this->getHttpRequest()->getReferer()->getPath() === '/orders/detail') $this->orderService->unsetUserEditingOrder($this->getHttpRequest()->getReferer()->getQueryParameter('idOrder'));
		$this->template->orders = $this->orderService->getOrders();

	}

	/**
	 * Function to render detail of the specified order.
	 *
	 * @return void     Function has no return value.
	 * @throws BadRequestException
	 */
	public function renderDetail($idOrder, bool $fdb = false): void {

		$orderEditable = $this->orderService->isOrderEditable($idOrder, $this->getUser()->id);

		if ($fdb) {

			$this->getSession()->getSection('orderDetailMeals')->remove();
			$this->getSession()->getSection('orderDetailDrinks')->remove();

			foreach ($this->orderService->getOrderItemsOfType($idOrder, 'meal') as $meal) $this->addItemToOrderSession($meal, 'orderDetailMeals');
			foreach ($this->orderService->getOrderItemsOfType($idOrder, 'drink') as $drink) $this->addItemToOrderSession($drink, 'orderDetailDrinks');

			$this->getSession()->getSection('orderDetailMeals')->setExpiration('15 minutes');
			$this->getSession()->getSection('orderDetailDrinks')->setExpiration('15 minutes');

		}

		if ($orderEditable->editable) {

			$this->template->drinks = $this->itemService->getDrinks();
			$this->template->meals = $this->itemService->getMeals();

		}

		$this->template->orderEditable = $orderEditable;
		$this->template->order = $this->orderService->getOrder($idOrder);
		$this->template->hasOrderMeals = $this->getSession()->hasSection('orderDetailMeals');
		$this->template->hasOrderDrinks = $this->getSession()->hasSection('orderDetailDrinks');
		$this->template->orderMeals = $this->getSession()->getSection('orderDetailMeals');
		$this->template->orderDrinks = $this->getSession()->getSection('orderDetailDrinks');


	}

	/**
	 * @param OrderItem|string $data
	 * @param string           $sessionSectionName
	 *
	 * @return void
	 * @throws BadRequestException
	 */
	private function addItemToOrderSession(OrderItem|string $data, string $sessionSectionName): void {

		$section = $this->getSession()->getSection($sessionSectionName);

		if ($data instanceof OrderItem) {

			$section->set((string)$data->item->id_item, ArrayHash::from([

				'name' => $data->item->name,
				'count' => $data->count,
				'unitPrice' => $data->item->price

			]));

		} else {

			if (!$this->itemService->existsById($data)) throw new BadRequestException('Požadovaná položka neexistuje', 400);
			$item = $this->itemService->getItemById($data);

			$section->set((string)$item->id_item, ArrayHash::from([

				'name' => $item->name,
				'count' => $section->get((string)$item->id_item) === null ? 1 : $section->get((string)$item->id_item)->count += 1,
				'unitPrice' => $item->price

			]));

		}

	}

	/**
	 * Function to handle submit event form request to create new order.
	 *
	 * @param Nette\Application\UI\Form $form Instance of form which contains submitted data about new order.
	 *
	 * @return void                                 Function has no return value.
	 * @throws Nette\Application\AbortException
	 */
	public function newOrderFormSuccess(Nette\Application\UI\Form $form): void {

		$values = $form->getValues();

		try {

			$idOrder = $this->orderService->newOrder($values);

		} catch (Nette\Database\ForeignKeyConstraintViolationException $e) {

			$this->flashMessage($e->getMessage(), 'danger');
			$this->redirect('Orders:New');

		}

		$this->redirect('Orders:Detail', $idOrder, true);

	}

	/**
	 * @throws AbortException|BadRequestException
	 */
	#[NoReturn] public function handleIncreaseItemOrderCount(string $idItem, string $sessionSectionName): void {

		$this->addItemToOrderSession($idItem, $sessionSectionName);
		$this->redirect('this', $this->getHttpRequest()->getQuery('idOrder'), false);

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function handleDecreaseOrderItemCount(string $idItem, string $sessionSectionName, $all = false): void {

		$section = $this->getSession()->getSection($sessionSectionName);
		$itemName = $section->get($idItem)->name;

		if (!$all) {

			$section->set($idItem, ArrayHash::from([

				'name' => $itemName,
				'count' => $section->get($idItem)->count -= 1,
				'unitPrice' => $section->get($idItem)->unitPrice

			]));

			if ($section->get($idItem)->count === 0) {

				$this->flashMessage('Položka ' . $itemName . ' byla úspěšně odebrána z objednávky', 'success');
				$section->remove($idItem);

			}

		} else {

			$this->flashMessage('Položka ' . $itemName . ' byla úspěšně odebrána z objednávky', 'success');
			$section->remove($idItem);

		}

		$this->redirect('this', $this->getHttpRequest()->getQuery('idOrder'), false);

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function handleCancelOrder($idOrder): void {

		$this->isSessionActive();

		$this->orderService->deleteOrder($idOrder);
		$this->flashMessage('Objednávka byla úspěšně zrušena.', 'success');
		$this->redirect('Orders:');

	}

	/**
	 * @throws AbortException
	 */
	private function isSessionActive(): void {

		if (/*!($this->getSession()->hasSection('orderDetailMeals') && $this->getSession()->hasSection('orderDetailDrinks'))*/ false) {

			$this->flashMessage('Platnost relace vypršela. Stránka byla obnovena.', 'warning');
			$this->redirect('this', $this->getHttpRequest()->getQuery('idOrder'), false);

		}

	}

	/**
	 * @throws AbortException
	 */
	#[NoReturn] public function handleSaveOrder($idOrder): void {

		$this->isSessionActive();

		$this->orderService->modifyOrder($idOrder, $this->getSession()->getSection('orderDetailMeals'), $this->getSession()->getSection('orderDetailDrinks'));
		$this->flashMessage('Objednávka byla úspěšně uložena', 'success');
		$this->redirect('Orders:');


	}

	/**
	 * Function which creates component form which is used to create new order.
	 *
	 * @return Nette\Application\UI\Form    Form component from Nette Forms.
	 */
	protected function createComponentNewOrderForm(): Nette\Application\UI\Form {

		$form = new Nette\Application\UI\Form();
		$form->addText('id_table', 'Číslo stolu')->setRequired();
		$form->addSubmit('newOrder', 'Založit novou objednávku');
		$form->onSuccess[] = [$this, 'newOrderFormSuccess'];

		return $form;

	}

}
