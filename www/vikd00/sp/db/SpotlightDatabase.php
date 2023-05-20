<?php require_once 'Database.php' ?>
<?php

class SpotlightDatabase extends Database
{
    public function fetchAll()
    {
        $query = "SELECT sp_listings.*, sp_vehicles.* FROM sp_listings 
                  INNER JOIN sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id
                  WHERE sp_listings.spotlight = 1";

        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $listings = $statement->fetchAll();

        foreach ($listings as &$listing) {
            $listing['images'] = $this->getImagesForListing($listing['listing_id']);
        }

        return $listings;
    }

    public function getImagesForListing($listing_id)
    {
        $query = "SELECT image_id, listing_id, image_url FROM sp_images WHERE listing_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $listing_id, PDO::PARAM_INT);
        $statement->execute();

        return $statement->fetchAll();
    }
}
