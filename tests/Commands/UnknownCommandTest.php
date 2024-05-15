<?php

use PHPUnit\Framework\TestCase;
use GB\CLI_APP\Commands\UnknownCommand;

class UnknownCommandTest extends TestCase {
    public function testRun(): void {
        $unknownCommand = new UnknownCommand();
        $this->expectOutputString("Error: missing or not valid command. Please use --help for more details.\n");
        $unknownCommand->run();
    }
}
