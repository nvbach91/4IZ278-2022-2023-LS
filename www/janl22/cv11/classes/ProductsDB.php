<?php

namespace classes;

require_once __DIR__ . '/Database.php';
require_once __DIR__ . '/CategoriesDB.php';
require_once __DIR__ . '/StatusMessage.php';

use PDO;
use PDOException;

class ProductsDB extends Database {

	protected string $tableName = 'cv11_products';

	public function fetchById(int $product): false|array {

		$query = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id_product = :product;');
		$query->bindValue('product', $product, PDO::PARAM_INT);
		$query->execute();
		return $query->fetch(PDO::FETCH_ASSOC);

	}

	public function fetchByCategory(int $category): false|array {

		$query = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id_category = :category;');
		$query->bindValue('category', $category, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}

	public function countByCategory(int $category): false|int {

		$query = $this->pdo->prepare('SELECT COUNT(*) FROM ' . $this->tableName . ' WHERE id_category = :category;');
		$query->bindValue('category', $category, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchColumn();

	}

	public function fetchPageByCategory(int $category, int $limit, int $offset): false|array {

		$query = $this->pdo->prepare('SELECT * FROM ' . $this->tableName . ' WHERE id_category = :category LIMIT :limit OFFSET :offset;');
		$query->bindValue('category', $category, PDO::PARAM_INT);
		$query->bindValue('limit', $limit, PDO::PARAM_INT);
		$query->bindValue('offset', $offset, PDO::PARAM_INT);
		$query->execute();
		return $query->fetchAll(PDO::FETCH_ASSOC);

	}

	public function newProduct(array $product): array {

		try {

			$CategoriesDB = new CategoriesDB();

			if (!($CategoriesDB->categoryExists($product['category']))) {
				return [
					'status' => 400,
					'message' => new StatusMessage('Selected category does not exist!', 'error')
				];
			}

			$insertQuery = $this->pdo->prepare('INSERT INTO ' . $this->tableName . ' (id_category, name, price, img) VALUES (:category, :name, :price, :image);');
			$insertQuery->bindValue('category', $product['category'], PDO::PARAM_INT);
			$insertQuery->bindValue('name', $product['name']);
			$insertQuery->bindValue('price', $product['price'], PDO::PARAM_INT);
			$insertQuery->bindValue('image', $product['image']);
			$insertQuery->execute();

			return [
				'status' => 200,
				'message' => new StatusMessage('Product insert was successful.', 'success')
			];

		} catch (PDOException $e) {

			return [
				'status' => 500,
				'message' => new StatusMessage('Product insert failed!', 'error')
			];

		}

	}

	public function editProduct(int $id, array $product): array {

		try {

			$CategoriesDB = new CategoriesDB();

			if (!$CategoriesDB->categoryExists(intval($product['category']))) {
				return [
					'status' => 400,
					'message' => new StatusMessage('Selected category does not exist!', 'error')
				];
			}

			$insertQuery = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET id_category = :category, name = :name, price = :price, img = :image, last_update = :last_update WHERE id_product = :id_product;');
			$insertQuery->bindValue('category', $product['category'], PDO::PARAM_INT);
			$insertQuery->bindValue('name', $product['name']);
			$insertQuery->bindValue('price', $product['price'], PDO::PARAM_INT);
			$insertQuery->bindValue('image', $product['image']);
			$insertQuery->bindValue('last_update', time(), PDO::PARAM_INT);
			$insertQuery->bindValue('id_product', $id, PDO::PARAM_INT);
			$insertQuery->execute();

			return [
				'status' => 200,
				'message' => new StatusMessage('Product update was successful.', 'success')
			];

		} catch (PDOException $e) {

			return [
				'status' => 500,
				'message' => new StatusMessage('Product update failed!', 'error')
			];

		}

	}

	public function deleteProduct(int $product): false|array {

		try {

			$deleteQuery = $this->pdo->prepare('DELETE FROM ' . $this->tableName . ' WHERE id_product = :product;');
			$deleteQuery->bindValue('product', $product, PDO::PARAM_INT);
			$deleteQuery->execute();

			return [
				'status' => 200,
				'message' => new StatusMessage('Product deletion was successful.', 'success')
			];

		} catch (PDOException $e) {

			return [
				'status' => 500,
				'message' => new StatusMessage('Product deletion failed!', 'error')
			];

		}

	}

	public function lockProduct(int $product): false|array {

		try {

			$deleteQuery = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET edit_start_time = :edit_start_time, editing_user = :editing_user WHERE id_product = :product;');
			$deleteQuery->bindValue('edit_start_time', time(), PDO::PARAM_INT);
			$deleteQuery->bindValue('editing_user', getUser()->mail);
			$deleteQuery->bindValue('product', $product, PDO::PARAM_INT);
			$deleteQuery->execute();

			return [
				'status' => 200,
				'message' => new StatusMessage('Product locking was successful.', 'success')
			];

		} catch (PDOException $e) {

			return [
				'status' => 500,
				'message' => new StatusMessage('Product locking failed!', 'error')
			];

		}

	}

	public function unlockProduct(int $product): false|array {

		try {

			$deleteQuery = $this->pdo->prepare('UPDATE ' . $this->tableName . ' SET edit_start_time = null, editing_user = null WHERE id_product = :product;');
			$deleteQuery->bindValue('product', $product, PDO::PARAM_INT);
			$deleteQuery->execute();

			return [
				'status' => 200,
				'message' => new StatusMessage('Product unlocking was successful.', 'success')
			];

		} catch (PDOException $e) {

			return [
				'status' => 500,
				'message' => new StatusMessage('Product unlocking failed!', 'error')
			];

		}

	}

}