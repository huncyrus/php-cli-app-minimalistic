#!/usr/bin/env php
<?php

require_once './vendor/autoload.php';

use GB\CLI_APP\Commands;
use GB\CLI_APP\Commands\HelpCommand;
use GB\CLI_APP\Commands\UnknownCommand;
use GB\CLI_APP\Commands\VersionCommand;


// Check for mandatory ENV
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->safeLoad();

try {
    $dotenv->required(['API_URL', 'API_KEY', 'API_SECRET']);
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

print "Test Assignment CLI \n";

// Exit if the argument amount is not sufficient
// @note I opted to not handling more due the assignment requirements
/*
if ($argc != 2) {
    print 'Please check the --help argument for syntax.' . "\n";

    exit(0);
}
*/

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
    case '-ca':
        // call api command
        break;
    case 'get-results':
    case '--get-results':
    case '-gr':
        // check $argv[2] for limit of results
        break;
    default: 
        $unknownCommand = new UnknownCommand();
        $unknownCommand->run();

        break;
}

print "\n";
