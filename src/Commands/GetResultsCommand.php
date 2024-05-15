<?php

namespace GB\CLI_APP\Commands;

use GB\CLI_APP\Interfaces\CommandBase;
use GB\CLI_APP\Libs\DB;
use GB\CLI_APP\Models\GetResultsModel;

/**
 * Get Results Command handler
 */
class GetResultsCommand implements CommandBase {
    private GetResultsModel $_db;
    private int $_limit = 10;

    public function __construct(GetResultsModel $db) {
        $this->_db = $db;
    }

    public function setLimit(int $limit = 10): void {
        $this->_limit = $limit;
    }

    /**
     * Formatting the result pint, checks for the array size
     *
     * @note if the input $res is empty then it exit early
     * @param array $res data set from database
     * @return void
     */
    private function formatResults (array $res): void {
        if (empty($res)) {
            print "  No stored results. \n";
            return;
        }

        printf("%-5s %-15s %-40s %-25s\n", "ID", "Status", "Data", "Created At");
        echo str_repeat("-", 110) . "\n";

        foreach ($res as $row) {
            printf("%-5d %-15s %-40s %-25s\n",
                $row['id'],
                $row['status'],
                substr($row['data'], 0, 30) . (strlen($row['data']) > 30 ? '...' : ''), // Truncate long data
                $row['created_at']
            );
        }
    }

    public function run(): void {
        $results = $this->_db->getResults($this->_limit);
        print "Stored API call results: \n\n";
        $this->formatResults($results);
        print "\n";
    }
}
