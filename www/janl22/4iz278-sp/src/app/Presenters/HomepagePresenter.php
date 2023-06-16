<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Service\OrderService;

/**
 * Homepage presenter
 *
 * This presenter represents homepage.
 */
final class HomepagePresenter extends BasePresenter {

	private OrderService $orderService;

	public function __construct(OrderService $orderService) {

		parent::__construct();

		$this->orderService = $orderService;

	}

	public function renderDefault(): void {

		if ($this->getUser()->isLoggedIn() && !$this->getUser()->getIdentity()->getData()['employee']) {

			$this->template->activeOrders = $this->orderService->getCustomerOrders($this->getUser()->getId(), true);
			$this->setView('default-loggedIn');

		} else {

			$this->setView('default');

		}

	}

}
