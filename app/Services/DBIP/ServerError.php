<?php

namespace App\Services\DBIP;

use JetBrains\PhpStorm\Pure;

class ServerError extends \Exception {

    private string $errorCode;

    #[Pure]
    public function __construct(string $message, string $errorCode) {
        parent::__construct($message);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode() : string {
        return $this->errorCode;
    }
}
