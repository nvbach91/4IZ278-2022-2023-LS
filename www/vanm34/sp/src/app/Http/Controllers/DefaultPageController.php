<?php
namespace App\Http\Controllers;

use App\Services\PropertyService;
use Illuminate\Http\Request;

class DefaultPageController extends Controller
{
    private $propertyService;

    public function __construct(PropertyService $propertyService)
    {
        $this->propertyService = $propertyService;
    }

    public function getProperties()
    {
        $numberOfProperties = $this->propertyService->getNumberOfProperties(1);
        $numberOfApartments = $this->propertyService->getNumberOfProperties(1);
        $numberOfHouses = $this->propertyService->getNumberOfProperties(2);
        $numberOfLots = $this->propertyService->getNumberOfProperties(3);

        $numberOfApartmentsForRent = $this->propertyService->getNumberOfProperties(1, 1);
        $numberOfApartmentsForSale = $this->propertyService->getNumberOfProperties(1, 2);
        $numberOfHousesForRent = $this->propertyService->getNumberOfProperties(2, 1);
        $numberOfHousesForSale = $this->propertyService->getNumberOfProperties(2, 2);
        $numberOfLotsForRent = $this->propertyService->getNumberOfProperties(3, 1);
        $numberOfLotsForSale = $this->propertyService->getNumberOfProperties(3, 2); 
        
        return view('welcome', compact(
            'numberOfProperties', 
            'numberOfApartments', 
            'numberOfHouses', 
            'numberOfLots', 
            'numberOfApartmentsForRent', 
            'numberOfApartmentsForSale', 
            'numberOfHousesForRent', 
            'numberOfHousesForSale', 
            'numberOfLotsForRent', 
            'numberOfLotsForSale'
        ));
    }

    public function contact()
    {
        return view('contact');
    }
}