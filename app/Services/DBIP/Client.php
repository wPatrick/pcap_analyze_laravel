<?php

namespace App\Services\DBIP;

class Client {

    private string $baseUrl;
    private string $apiKey;
    private $lang;

    static private string $defaultBaseUrl = "http://api.db-ip.com/v2/";
    static private Client $instance;

    static public function getInstance() : self {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    static public function setBaseUrl(string $url) : void {
        self::$defaultBaseUrl = $url;
    }

    protected function __construct(string $apiKey = null, string $baseUrl = null) {
        if (isset($apiKey)) {
            $this->apiKey = $apiKey;
        } else {
            $this->apiKey = APIKey::$defaultApiKey;
        }
        if (isset($baseUrl)) {
            $this->baseUrl = $baseUrl;
        } else {
            $this->baseUrl = self::$defaultBaseUrl;
        }
        if (isset($_SERVER["HTTP_ACCEPT_LANGUAGE"])) {
            $this->setPreferredLanguage($_SERVER["HTTP_ACCEPT_LANGUAGE"]);
        }
    }

    protected function apiCall(string $path = "") : \stdClass {
        $url = $this->baseUrl . $this->apiKey . $path;
        $httpOptions = [
            "header" => [
                "User-Agent: dbip-api-client",
            ],
        ];
        if (isset($this->lang)) {
            $httpOptions["header"][] = "Accept-Language: {$this->lang}";
        }
        if (!$jsonData = file_get_contents($url, false, stream_context_create([ "http" => $httpOptions ]))) {
            throw new ClientError("unable to fetch URL: {$url}");
        } else if (!$data = json_decode($jsonData)) {
            throw new ClientError("cannot decode server response");
        } else if (isset($data->error)) {
            throw new ServerError("server reported an error: {$data->error}", $data->errorCode);
        }
        return $data;
    }

    public function setPreferredLanguage(string $lang) : void {
        $this->lang = $lang;
    }

    public function getAddressInfo($addr) : \stdClass {
        $path = "/";
        if (is_array($addr)) {
            $path .= implode(",", $addr);
        } else {
            $path .= $addr;
        }
        return $this->apiCall($path);
    }

    public function getASInfo($asNumber) : \stdClass {
        $path = "/as/";
        if (is_array($asNumber)) {
            $path .= implode(",", $asNumber);
        } else {
            $path .= $asNumber;
        }
        return $this->apiCall($path);
    }

    public function getKeyInfo() : \stdClass {
        return $this->apiCall();
    }

}
