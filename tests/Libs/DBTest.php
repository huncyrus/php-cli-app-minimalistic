<?php

use PHPUnit\Framework\TestCase;
use GB\CLI_APP\Libs\DB;


class DBTest extends TestCase {
    private $envBackup;

    protected function setUp(): void {
        $dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '../../../src');
        $dotenv->load();
        $this->envBackup = $_ENV;
        $_ENV['DB_HOST'] = $_ENV['DB_TEST_HOST'];
        $_ENV['DB_DATABASE'] = $_ENV['DB_TEST_DATABASE'];
        $_ENV['DB_USERNAME'] = $_ENV['DB_TEST_USERNAME'];
        $_ENV['DB_PASSWORD'] = $_ENV['DB_TEST_PASSWORD'];
    }

    protected function tearDown(): void {
        $_ENV = $this->envBackup;
    }
    
    public function testConstructSuccess(): void {
        $pdoMock = $this->createMock(PDO::class);
        $db = $this->getMockBuilder(DB::class)
                ->setConstructorArgs([$pdoMock])
                ->disableOriginalConstructor()
                ->getMock();
        $this->assertInstanceOf(PDO::class, $db->getPdo());
    }


    public function testConstructFailure(): void {
        $_ENV['DB_HOST'] = 'invalid_host';

        $this->expectException(PDOException::class);
        $this->expectExceptionMessage('Could not connect to the database:');

        new DB();
    }
}
