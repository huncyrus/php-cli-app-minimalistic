<?php

namespace GB\CLI_APP\Tests\Commands;
use PHPUnit\Framework\TestCase;
use GB\CLI_APP\Commands\GetResultsCommand;
use GB\CLI_APP\Models\GetResultsModel;

class GetResultsCommandTest extends TestCase {
    private $getResultsModel;
    private $getResultsCommand;

    protected function setUp(): void {
        $this->getResultsModel = $this->createMock(GetResultsModel::class);
        $this->getResultsCommand = new GetResultsCommand($this->getResultsModel);
    }

    public function testFormatResults(): void {
        $method = new \ReflectionMethod(GetResultsCommand::class, 'formatResults');
        $method->setAccessible(true);

        $result = $method->invokeArgs($this->getResultsCommand, [[
            [
                'id' => 1,
                'status' => 'success',
                'data' => 'test data',
                'created_at' => '2022-01-01 00:00:00'
            ]
        ]]);

        $expectedOutput = "ID    Status          Data                                     Created At               \n";
        $expectedOutput .= "--------------------------------------------------------------------------------------------------------------\n";
        $expectedOutput .= "1     success         test data                                2022-01-01 00:00:00      \n";

        $this->expectOutputString($expectedOutput);
    }

    public function testFormatResultsEmpty(): void {
        $method = new \ReflectionMethod(GetResultsCommand::class, 'formatResults');
        $method->setAccessible(true);

        $result = $method->invokeArgs($this->getResultsCommand, [[]]);

        $this->expectOutputString("  No stored results. \n");
    }
}
