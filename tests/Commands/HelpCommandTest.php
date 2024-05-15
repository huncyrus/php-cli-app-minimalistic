<?php

use PHPUnit\Framework\TestCase;
use GB\CLI_APP\Commands\HelpCommand;

class HelpCommandTest extends TestCase {
    public function testRun(): void {
        $helpCommand = new HelpCommand();
        $expectedOutput = "Usage:  \n";
        $expectedOutput .= " php index.php [command] [optional-value] \n\n";
        $expectedOutput .= "Available commands: \n";
        $expectedOutput .= "  --version             Displaying app version \n";
        $expectedOutput .= "  -v                    Alias \n";
        $expectedOutput .= "  version               Alias \n";
        $expectedOutput .= "\n";
        $expectedOutput .= "  --help                This view \n";
        $expectedOutput .= "\n";
        $expectedOutput .= "  --call-api            Reach a predefined HTTP API endpoint and stores its content \n";
        $expectedOutput .= "\n";
        $expectedOutput .= "  --get-results n       Get stored results. The \"n\" is an integer number. 10 by default \n";
        $expectedOutput .= "  get-results n         Alias \n";
        $expectedOutput .= "  --gr n                Alias \n";
        $expectedOutput .= "\n";

        $this->expectOutputString($expectedOutput);
        $helpCommand->run();
    }
}
