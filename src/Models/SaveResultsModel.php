<?php 

namespace GB\CLI_APP\Models;

use GB\CLI_APP\Libs\DB;
use PDO;

/**
 * Simple model file to store the results from the handler (from a HTTP call)
 */
class SaveResultsModel {
    private PDO $pdo;

    public function __construct(DB $connection) {
        $this->pdo = $connection->getPdo();
    }

    /**
     * Saves one result into db
     * @param array $result
     * @return void
     * @throw PDOException
     */
    public function saveResult(array $result) : void {
        $query = "
            INSERT INTO 
                api_calls 
            (
                status, 
                data
            ) 
            VALUES 
            (
                ?,
                ?
            )
        ";
        $stmt = $this->pdo->prepare($query);

        try {
            $stmt->execute([$result['status'], $result['data']]);
        } catch (\PDOException $e) {
            throw new \PDOException('Failed to save new data into database: ' . $e->getMessage(), (int)$e->getCode());
        }
    }
}
