<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;

abstract class BasePresenter extends Nette\Application\UI\Presenter {

	/**
	 * Function which adds some needed properties as template variables to all subpages.
	 *
	 * @return void     Function has no return value.
	 */
	protected function startup(): void {

		parent::startup();

		include_once __DIR__ . '/../../config/facebookAuth.php';

		$httpRequest = $this->getHttpRequest();

		$this->template->cookies = $httpRequest->getCookies();
		$this->template->customerHasOpenedOrder = $this->getSession()->hasSection('customerOrder');

		$this->template->addFunction('formatPriceCurrency', function (mixed $price) {

			return number_format(intval($price), 0, '.', ' ') . ',- Kč';

		});

		$this->template->addFunction('countCustomerOrderItems', function (): int {

			$inCart = 0;
			foreach ($this->getSession()->getSection('customerOrder') as $orderItem) {
				$inCart += $orderItem->count;
			}
			return $inCart;

		});

		$this->template->addFunction('sumCustomerOrderItemsPrice', function (): float {

			$price = 0;
			foreach ($this->getSession()->getSection('customerOrder') as $orderItem) {
				$price += ($orderItem->count * $orderItem->unitPrice);
			}
			return $price;

		});

	}

}