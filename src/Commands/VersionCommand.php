<?php

namespace GB\CLI_APP\Commands;

use GB\CLI_APP\Interfaces;
use GB\CLI_APP\Interfaces\CommandBase;

/**
 * Version Command handler
 * Displays the application version info
 *
 * @note it is hardcoded, would be nicer to get the version from env or app version/composer file.
 */
class VersionCommand implements CommandBase {
    public function run(): void {
        echo 'Version 1.0.0' . "\n";
        echo '  (c) Copyright Györk Bakonyi <gyork@bakonyi.info>' . "\n";
    }
}
