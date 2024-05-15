<?php

namespace GB\CLI_APP\Commands;

use GB\CLI_APP\Interfaces\CommandBase;
use GB\CLI_APP\Models\SaveResultsModel;
use GB\CLI_APP\Libs\HttpHelper;
use GB\CLI_APP\DataTransferObjects\HttpClientCallApiDto;

/**
 * Call API Command handler
 */
class CallApiCommand implements CommandBase {
    private SaveResultsModel $_db;
    private HttpHelper $_httpClient;

    public function __construct(SaveResultsModel $db, HttpHelper $client) {
        $this->_db = $db;
        $this->_httpClient = $client;
    }

    public function run(): void {
        try {
            $res = $this->_httpClient->callApi();
            $this->_db->saveResult(['status' => $res->getStatus(), 'data' => $res->getData()]);
            print "  API Call result saved. \n";
        } catch (\Exception $e) {
            print "  API Call failed: " . $e->getMessage();
        }
    }
}
