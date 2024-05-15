<?php

namespace GB\CLI_APP\Commands;

use GB\CLI_APP\Interfaces;
use GB\CLI_APP\Interfaces\CommandBase;

/**
 * Printing out the application arguments/parameters
 */
class HelpCommand implements CommandBase {
    public function run() {
        $content = "Usage:  \n";
        $content .= " php index.php [command] [optional-value] \n\n";
        $content .= "Available commands: \n";
        $content .= "  --version             Displaying app version \n";
        $content .= "  -v                    Alias \n";
        $content .= "  version               Alias \n";
        $content .= "\n";
        $content .= "  --help                This view \n";
        $content .= "\n";
        $content .= "  --call-api            Reach a predefined HTTP API endpoint and stores its content \n";
        $content .= "\n";
        $content .= "  --get-results n       Get stored results. The \"n\" is an integer number. 10 by default \n";
        $content .= "  get-results n         Alias \n";
        $content .= "  --gr n                Alias \n";
        $content .= "\n";

        echo $content;
    }
}
