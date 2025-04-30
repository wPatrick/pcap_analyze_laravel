<?php

namespace App\Services\DBIP;

class Address {
    static public function lookup($addr = "self") : \stdClass {
        return Client::getInstance()->getAddressInfo($addr);
    }
}
