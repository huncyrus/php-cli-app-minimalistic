<?php

namespace GB\CLI_APP\Interfaces;

use PDO;

interface DatabaseBase {
    public function getPdo(): PDO;
}
