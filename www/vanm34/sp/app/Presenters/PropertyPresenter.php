<?php

declare(strict_types=1);

namespace App\Presenters;

use Nette;


final class PropertyPresenter extends Nette\Application\UI\Presenter
{
	public function __construct(
		private Nette\Database\Explorer $database,
	) {
	}

	public function renderList(): void
	{
		$this->template->properties = $this->database
			->table('property')
			->order('id ASC')
		 	->limit(5)->fetchAll();
	}

}