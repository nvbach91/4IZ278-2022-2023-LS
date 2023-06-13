<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Model\Service\MenuService;

/**
 * Menu presenter
 *
 * This presenter represents Menu page.
 */
final class MenuPresenter extends BasePresenter {

	private MenuService $menu;

	public function __construct(MenuService $menu) {

		parent::__construct();

		$this->menu = $menu;

	}

	/**
	 * Function to render page which contains current menu.
	 *
	 * @return void     Function has no return value.
	 */
	public function renderDefault(): void {

		$this->template->menu = $this->menu->getMenu();
		$this->template->items = $this->menu->getMenuItems();

	}

}
