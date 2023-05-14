<?php

declare(strict_types=1);

namespace App\Presenters;

use App\Models\PropertyFactory;

use Nette;


final class HomePresenter extends Nette\Application\UI\Presenter
{
    public function __construct(private PropertyFactory $propertyFactory)
    {
        parent::__construct();
        $this->propertyFactory = $propertyFactory;
    }

    public function renderDefault(): void
    {
        $numberOfApartments = $this->propertyFactory->getNumberOfProperties(1);
        $numberOfHouses = $this->propertyFactory->getNumberOfProperties(2);
        $numberOfLots = $this->propertyFactory->getNumberOfProperties(3);

        $numberOfApartmentsForRent = $this->propertyFactory->getNumberOfProperties(1, 1);
        $numberOfApartmentsForSale = $this->propertyFactory->getNumberOfProperties(1, 2);
        $numberOfHousesForRent = $this->propertyFactory->getNumberOfProperties(2, 1);
        $numberOfHousesForSale = $this->propertyFactory->getNumberOfProperties(2, 2);
        $numberOfLotsForRent = $this->propertyFactory->getNumberOfProperties(3, 1);
        $numberOfLotsForSale = $this->propertyFactory->getNumberOfProperties(3, 2);

        $this->template->numberOfApartments = $numberOfApartments;
        $this->template->numberOfHouses = $numberOfHouses;
        $this->template->numberOfLots = $numberOfLots;
        $this->template->numberOfApartmentsForRent = $numberOfApartmentsForRent;
        $this->template->numberOfApartmentsForSale = $numberOfApartmentsForSale;
        $this->template->numberOfHousesForRent = $numberOfHousesForRent;
        $this->template->numberOfHousesForSale = $numberOfHousesForSale;
        $this->template->numberOfLotsForRent = $numberOfLotsForRent;
        $this->template->numberOfLotsForSale = $numberOfLotsForSale;

    }
}