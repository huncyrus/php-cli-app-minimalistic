<?php

namespace App\Database;

use PDO;

/**
 * Minimalist PDO db wrapper
 * @note Normally the wrapper and the actual queries would be separated into a db layer and model \
 *       but the size of this project does not require such structure.
 */
class DB {
    private PDO $pdo;

    public function __construct() {
        $this->connectToDatabase();
    }

    private function connectToDatabase() {
        $host = getenv('DB_HOST');
        $db   = getenv('DB_DATABASE');
        $user = getenv('DB_USERNAME');
        $pass = getenv('DB_PASSWORD');
        $charset = 'utf8mb4';

        $dsn = "mysql:host=$host;dbname=$db;charset=$charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $user, $pass, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function saveResult(array $result) : void {
        $stmt = $this->pdo->prepare("INSERT INTO api_calls (status, data) VALUES (?, ?)");

        $stmt->execute([$result['status'], $result['data']]);
    }

    public function getResults() : array {
        $stmt = $this->pdo->query("SELECT * FROM api_calls ORDER BY created_at DESC");

        return $stmt->fetchAll();
    }
}
