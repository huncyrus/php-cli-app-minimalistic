#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

use GB\CLI_APP\Commands\HelpCommand;
use GB\CLI_APP\Commands\UnknownCommand;
use GB\CLI_APP\Commands\VersionCommand;
use GB\CLI_APP\Commands\GetResultsCommand;
use GB\CLI_APP\Commands\CallApiCommand;
use GB\CLI_APP\Libs\HttpHelper;
use GB\CLI_APP\Libs\DB;
use GB\CLI_APP\Models\SaveResultsModel;
use GB\CLI_APP\Models\GetResultsModel;

// Check for mandatory ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

try {
    $dotenv->required(
        [
            'API_BASE_URL', 
            'API_BASE_PATH',
            'API_KEY', 
            'API_SECRET', 
            'DB_HOST', 
            'DB_USERNAME', 
            'DB_PASSWORD', 
            'DB_ROOT_PASS'
        ]
    );
} catch(Exception $err) {
    echo 'Missing mandatory env entry: ' . $err->getMessage() . "\n";

    exit(0);
}

$appType = php_sapi_name();

// Exit if it's not running on command line
if ($appType !== 'cli') {
    print 'Please run the application in CLI mode.' . "\n";

    exit(0);
}

// Init db and share with commands
$db = new DB();
$grModel = new GetResultsModel($db);
$srModel = new SaveResultsModel($db);
$httpClient = new HttpHelper();

print "Test Assignment PHP CLI Application \n";

if (!isset($argv[1])) {
    $argv[1] = '--help';
}

switch($argv[1]) {
    case '--help':
    case 'help':
    case '-h':
        $helpCommand = new HelpCommand();
        $helpCommand->run();

        break;
    case '--version':
    case 'version':
    case '-v':
        $versionCommand = new VersionCommand();
        $versionCommand->run();

        break;
    case 'call-api':
    case '--call-api':
    case '--ca':
    case '-ca':
        $caCommand = new CallApiCommand($srModel, $httpClient);
        $caCommand->run();
        break;
    case 'get-results':
    case '--get-results':
    case '--gr':
    case '-gr':
        $limit = 10;

        if (isset($argv[2])) {
            $limit = (int)$argv[2];
        }

        $grCommand = new GetResultsCommand($grModel);
        $grCommand->setLimit($limit);
        $grCommand->run();

        break;
    default: 
        $unknownCommand = new UnknownCommand();
        $unknownCommand->run();

        break;
}

print "\n";
