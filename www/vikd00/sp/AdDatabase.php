<?php require_once './Database.php'; ?>
<?php
class AdDatabase extends Database
{
    public function getUserAdsById($id)
    {
        $query = 'SELECT sp_listings.*, sp_vehicles.*, sp_listings.user_id FROM sp_listings 
            INNER JOIN sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id 
            WHERE sp_listings.user_id = :id';
        $statement = $this->pdo->prepare($query);
        $statement->execute(['id' => $id]);
        $listings = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listings as &$listing) {
            $listing['images'] = $this->getImagesForListing($listing['listing_id']);
        }

        return $listings;
    }

    public function getAllAds()
    {
        $query = 'SELECT sp_listings.*, sp_vehicles.*, sp_listings.user_id FROM sp_listings 
        INNER JOIN sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id';
        $statement = $this->pdo->prepare($query);
        $statement->execute();
        $listings = $statement->fetchAll(PDO::FETCH_ASSOC);

        foreach ($listings as &$listing) {
            $listing['images'] = $this->getImagesForListing($listing['listing_id']);
        }

        return $listings;
    }

    public function getImagesForListing($listing_id)
    {
        $query = "SELECT image_id, listing_id, image_data FROM sp_images WHERE listing_id = ?";
        $statement = $this->pdo->prepare($query);
        $statement->bindValue(1, $listing_id, PDO::PARAM_INT);
        $statement->execute();

        $result = $statement->fetchAll();
        // convert each image data to base64
        foreach ($result as &$row) {
            $row['image_data'] = 'data:image/jpeg;base64,' . base64_encode($row['image_data']);
        }

        return $result;
    }

    public function getListingById($listingId)
    {
        $query = "SELECT sp_listings.*, sp_vehicles.* 
              FROM sp_listings 
              INNER JOIN sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id 
              WHERE sp_listings.listing_id = :listing_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->execute(['listing_id' => $listingId]);
        $listing = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($listing) {
            $listing['images'] = $this->getImagesForListing($listing['listing_id']);
        }

        return $listing;
    }

    public function createListing($userId, $vehicleId, $price, $spotlight)
    {
        $sql = "INSERT INTO sp_listings (user_id, vehicle_id, price, spotlight) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $vehicleId, $price, $spotlight]);
        return $this->pdo->lastInsertId();
    }

    public function createVehicle($manufacturer, $model, $fuel, $transmission, $color, $mileage, $year, $power, $description)
    {
        $sql = "INSERT INTO sp_vehicles (manufacturer, model, fuel, transmission, color, mileage, year, power, description) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$manufacturer, $model, $fuel, $transmission, $color, $mileage, $year, $power, $description]);
        return $this->pdo->lastInsertId();
    }

    public function createImage($listingId, $imageData)
    {
        $sql = "INSERT INTO sp_images (listing_id, image_data) VALUES (?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$listingId, $imageData]);
        return $this->pdo->lastInsertId();
    }

    public function search($manufacturer, $model, $fuel, $color, $yearFrom, $yearTo, $powerFrom, $powerTo, $priceFrom, $priceTo)
    {
        $query = "SELECT sp_listings.*, sp_vehicles.*, sp_listings.user_id FROM sp_listings 
              INNER JOIN sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id WHERE 1=1";

        if (!empty($manufacturer)) {
            $query .= " AND sp_vehicles.manufacturer LIKE :manufacturer";
        }

        if (!empty($model)) {
            $query .= " AND sp_vehicles.model LIKE :model";
        }

        if (!empty($fuel)) {
            $query .= " AND sp_vehicles.fuel LIKE :fuel";
        }

        if (!empty($color)) {
            $query .= " AND sp_vehicles.color LIKE :color";
        }

        if (!empty($yearFrom)) {
            $query .= " AND sp_vehicles.year >= :yearFrom";
        }

        if (!empty($yearTo)) {
            $query .= " AND sp_vehicles.year <= :yearTo";
        }

        if (!empty($powerFrom)) {
            $query .= " AND sp_vehicles.power >= :powerFrom";
        }

        if (!empty($powerTo)) {
            $query .= " AND sp_vehicles.power <= :powerTo";
        }

        if (!empty($priceFrom)) {
            $query .= " AND sp_listings.price >= :priceFrom";
        }

        if (!empty($priceTo)) {
            $query .= " AND sp_listings.price <= :priceTo";
        }

        $statement = $this->pdo->prepare($query);

        if (!empty($manufacturer)) {
            $statement->bindValue(':manufacturer', '%' . $manufacturer . '%', PDO::PARAM_STR);
        }

        if (!empty($model)) {
            $statement->bindValue(':model', '%' . $model . '%', PDO::PARAM_STR);
        }

        if (!empty($fuel)) {
            $statement->bindValue(':fuel', '%' . $fuel . '%', PDO::PARAM_STR);
        }

        if (!empty($color)) {
            $statement->bindValue(':color', '%' . $color . '%', PDO::PARAM_STR);
        }

        if (!empty($yearFrom)) {
            $statement->bindValue(':yearFrom', $yearFrom, PDO::PARAM_INT);
        }

        if (!empty($yearTo)) {
            $statement->bindValue(':yearTo', $yearTo, PDO::PARAM_INT);
        }

        if (!empty($powerFrom)) {
            $statement->bindValue(':powerFrom', $powerFrom, PDO::PARAM_INT);
        }

        if (!empty($powerTo)) {
            $statement->bindValue(':powerTo', $powerTo, PDO::PARAM_INT);
        }

        if (!empty($priceFrom)) {
            $statement->bindValue(':priceFrom', $priceFrom, PDO::PARAM_STR);
        }

        if (!empty($priceTo)) {
            $statement->bindValue(':priceTo', $priceTo, PDO::PARAM_STR);
        }

        $statement->execute();
        $listings = $statement->fetchAll();

        foreach ($listings as &$listing) {
            $listing['images'] = $this->getImagesForListing($listing['listing_id']);
        }

        return $listings;
    }

    public function fulltextSearch($query)
    {
        $query = trim($query);

        $statement = $this->pdo->prepare("
            SELECT sp_listings.*, sp_vehicles.*
            FROM sp_listings
            INNER JOIN sp_vehicles ON sp_listings.vehicle_id = sp_vehicles.vehicle_id
            WHERE MATCH (sp_vehicles.manufacturer, sp_vehicles.model, sp_vehicles.fuel, sp_vehicles.color)
            AGAINST (:query IN BOOLEAN MODE)
            ");

        $statement->bindValue(':query', $query, PDO::PARAM_STR);
        $statement->execute();
        $listings = $statement->fetchAll();

        foreach ($listings as &$listing) {
            $listing['images'] = $this->getImagesForListing($listing['listing_id']);
        }

        return $listings;
    }

    public function unlockAd($listingId)
    {
        $sql = "UPDATE sp_listings SET edit_user_id = NULL, edit_timestamp = NULL WHERE listing_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$listingId]);
    }

    public function checkLock($listingId)
    {
        $sql = "SELECT edit_user_id, edit_timestamp FROM sp_listings WHERE listing_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$listingId]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result && $result['edit_timestamp']) {
            $editTimestamp = strtotime($result['edit_timestamp']);
            $currentTimestamp = time();

            if (($currentTimestamp - $editTimestamp) > 5 * 60) {
                return false;
            }
        } else {
            return false;
        }

        return $result;
    }

    public function lockAd($listingId, $userId)
    {
        $sql = "UPDATE sp_listings SET edit_user_id = ?, edit_timestamp = NOW() WHERE listing_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$userId, $listingId]);
    }

    public function updateVehicle($manufacturer, $model, $fuel, $transmission, $color, $mileage, $year, $power, $description, $vehicleId)
    {
        $sql = "UPDATE sp_vehicles SET manufacturer = ?, model = ?, fuel = ?, transmission = ?, color = ?, mileage = ?, year = ?, power = ?, description = ? WHERE vehicle_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$manufacturer, $model, $fuel, $transmission, $color, $mileage, $year, $power, $description, $vehicleId]);
    }

    public function updateAd($listingId, $price, $spotlight)
    {
        $sql = "UPDATE sp_listings SET price = ?, spotlight = ? WHERE listing_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$price, $spotlight, $listingId]);
    }

    public function updateImage($listingId, $imageData)
    {
        $sql = "SELECT * FROM sp_images WHERE listing_id = ?";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([$listingId]);
        $record = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($record) {
            $sql = "UPDATE sp_images SET image_data = ? WHERE listing_id = ?";
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([$imageData, $listingId]);
        } else {
            $this->createImage($listingId, $imageData);
        }
    }

    public function deleteListing($listingId)
    {
        $this->pdo->beginTransaction();

        try {
            $stmt = $this->pdo->prepare("DELETE FROM sp_images WHERE listing_id = :listing_id");
            $stmt->execute(['listing_id' => $listingId]);

            $stmt = $this->pdo->prepare("DELETE FROM sp_messages WHERE listing_id = :listing_id");
            $stmt->execute(['listing_id' => $listingId]);

            $stmt = $this->pdo->prepare("SELECT vehicle_id FROM sp_listings WHERE listing_id = :listing_id");
            $stmt->execute(['listing_id' => $listingId]);
            $vehicle_id = $stmt->fetchColumn();

            $stmt = $this->pdo->prepare("DELETE FROM sp_listings WHERE listing_id = :listing_id");
            $stmt->execute(['listing_id' => $listingId]);

            $stmt = $this->pdo->prepare("DELETE FROM sp_vehicles WHERE vehicle_id = :vehicle_id");
            $stmt->execute(['vehicle_id' => $vehicle_id]);

            $this->pdo->commit();
            return true;
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }
}
