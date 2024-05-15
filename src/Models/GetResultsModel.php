<?php 

namespace GB\CLI_APP\Models;

use GB\CLI_APP\Libs\DB;
use PDO;

/**
 * Simple model file to retrieve the results from the handler (from a HTTP call)
 */
class GetResultsModel {
    private PDO $pdo;

    public function __construct(DB $connection) {
        $this->pdo = $connection->getPdo();
    }

    /**
     * Returns the last few db entry
     *
     * @param int $limit if less than 1 then it defaults to 10. Max 500.
     * @return array
     * @throw PDOException
     * @deprecated
     */
    public function getResults(int $limit = 10) : array {
        $query = "
            SELECT 
                id,
                status,
                data,
                created_at
            FROM 
                api_calls
            ORDER BY 
                created_at 
            DESC LIMIT 
                :limit
        ";
        $stmt = $this->pdo->prepare($query);

        if ($limit < 1) {
            $limit = 10;
        }
        if ($limit > 500) {
            $limit = 500;
        }

        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);

        try {
            $stmt->execute();
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }

        return $stmt->fetchAll();
    }
}
