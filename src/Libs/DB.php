<?php

namespace GB\CLI_APP\Libs;

use PDO;
use GB\CLI_APP\Interfaces\DatabaseBase;

/**
 * Minimalist PDO db wrapper
 * @note Thiw file has one responsibility to connect to the database
 * @note the $_ENV should be populated at the point when this class instantiated therefore no validation present
 */
class DB implements DatabaseBase {
    private PDO $pdo;

    public function __construct() {
        $this->connect();
    }

    /**
     * @return void
     * @throw PDOException
     * @note on error this might leak some env or config details
     */
    private function connect() {
        $host = $_ENV['DB_HOST'];
        $db   = $_ENV['DB_DATABASE'];
        $user = $_ENV['DB_USERNAME'];
        $pass = $_ENV['DB_PASSWORD'];
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
            throw new \PDOException('Could not connect to the database: ' . $e->getMessage(), (int)$e->getCode());
        }
    }

    public function getPdo(): PDO {
        return $this->pdo;
    }    
}
