<?php
use PHPUnit\Framework\TestCase;
use GB\CLI_APP\Commands\CallApiCommand;
use GB\CLI_APP\Models\SaveResultsModel;
use GB\CLI_APP\Libs\HttpHelper;
use GB\CLI_APP\DataTransferObjects\HttpClientCallApiDto;

class CallApiCommandTest extends TestCase {
    private $saveResultsModel;
    private $httpHelper;
    private $callApiCommand;

    protected function setUp(): void {
        $this->saveResultsModel = $this->createMock(SaveResultsModel::class);
        $this->httpHelper = $this->createMock(HttpHelper::class);
        $this->callApiCommand = new CallApiCommand($this->saveResultsModel, $this->httpHelper);
    }

    public function testRunSuccess(): void {
        $dto = new HttpClientCallApiDto('success', 'test');
        $this->httpHelper->method('callApi')->willReturn($dto);
        $this->saveResultsModel->expects($this->once())->method('saveResult')->with(['status' => 'success', 'data' => 'test']);

        $this->expectOutputString("  API Call result saved. \n");
        $this->callApiCommand->run();
    }

    public function testRunFailure(): void {
        $this->httpHelper->method('callApi')->will($this->throwException(new \Exception('API Call failed')));
        $this->expectOutputString("  API Call failed: API Call failed");
        $this->callApiCommand->run();
    }
}
