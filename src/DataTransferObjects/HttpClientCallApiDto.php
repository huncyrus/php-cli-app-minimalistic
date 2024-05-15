<?php

namespace GB\CLI_APP\DataTransferObjects;

/**
 * Data Transfer Object for HTTP API Call
 */
class HttpClientCallApiDto {
    public function __construct (
        public readonly string $status,
        public readonly string $data
    ) {}

    public function getStatus() : string {
        return $this->status;
    }

    public function getData(): string {
        return $this->data;
    }
}
