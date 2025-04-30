<?php

namespace App\Services\DBIP;

class ASN {
    static public function lookup($asNumber) : \stdClass {
        return Client::getInstance()->getASInfo($asNumber);
    }
}
