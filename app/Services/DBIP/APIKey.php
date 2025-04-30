<?php

namespace App\Services\DBIP;

class APIKey {
    static public string $defaultApiKey = "free";

    static public function set(string $apiKey) : void {
        self::$defaultApiKey = $apiKey;
    }
    static public function info() : \stdClass {
        return Client::getInstance()->getKeyInfo();
    }
}
