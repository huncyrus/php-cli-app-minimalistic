<?php

use PHPUnit\Framework\TestCase;
use GB\CLI_APP\Commands\VersionCommand;

class VersionCommandTest extends TestCase {
    public function testRun(): void {
        $versionCommand = new VersionCommand();
        $this->expectOutputString("Version 1.0.0\n  (c) Copyright Györk Bakonyi <gyork@bakonyi.info>\n");
        $versionCommand->run();
    }
}
