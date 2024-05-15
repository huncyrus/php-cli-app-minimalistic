<?php

use GB\CLI_APP\DataTransferObjects\HttpClientCallApiDto;
use PHPUnit\Framework\TestCase;

class HttpClientCallApiDtoTest extends TestCase {
    public function testConstructorAndGetters() {
        $status = 'success';
        $data = 'Data payload here';

        $dto = new HttpClientCallApiDto($status, $data);

        $this->assertSame($status, $dto->getStatus(), "The status should be exactly what was passed to the constructor.");
        $this->assertSame($data, $dto->getData(), "The data should be exactly what was passed to the constructor.");
    }

    public function testPropertyImmutability() {
        $status = 'success';
        $data = 'Initial data';
        $dto = new HttpClientCallApiDto($status, $data);

        $this->expectException(\Error::class);
        $dto->status = 'failed';
    }

    public function testReadOnlyProperty() {
        $status = 'success';
        $data = 'Data payload';
        $dto = new HttpClientCallApiDto($status, $data);

        // Attempting to unset or set the readonly property should result in an Error
        $this->expectException(\Error::class);
        unset($dto->status);

        $this->expectException(\Error::class);
        $dto->status = 'error';
    }
}
