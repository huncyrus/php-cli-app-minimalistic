<?php

namespace GB\CLI_APP\Commands;

use GB\CLI_APP\Interfaces;
use GB\CLI_APP\Interfaces\CommandBase;

/**
 * Unknown Command handler
 * Very simple message for not valid, missing or malformatted commands.
 */
class VersionCommand {
    public function run() {
        echo 'Version 1.0.0' . "\n";
        echo '  (c) Copyright Györk Bakonyi <gyork@bakonyi.info>' . "\n";
    }
}
