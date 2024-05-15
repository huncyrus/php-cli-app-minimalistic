<?php

namespace GB\CLI_APP\Commands;

use GB\CLI_APP\Interfaces;
use GB\CLI_APP\Interfaces\CommandBase;

/**
 * Unknown Command handler
 * Very simple message for not valid, missing or malformatted commands.
 */
class UnknownCommand {
    public function run(): void {
        echo 'Error: missing or not valid command. Please use --help for more details.' . "\n";
    }
}
