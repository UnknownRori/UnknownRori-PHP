<?php

namespace Core\Http;

use Core\Utils\Json;

class Response implements IResponse
{

    protected $response;
    protected $code = 200;
    protected $headers = [];

    public function __construct()
    {

    }

    public function __destruct()
    {
        $headerType = array_keys($this->headers);

        for($i = 0;$i < count($this->headers); $i++) {
            header($headerType[$i] . ': ' . $this->headers[$headerType[$i]]);
        }
        
        http_response_code($this->code);


        echo Json::Encode($this->response);
    }

    /**
     * Send out json response along with http response code
     */
    public function json(array $response, int $code = 200): self
    {
        $this->headers['Content-Type'] = 'application/json';

        $this->response = $response;
        $this->code = $code;

        return $this;
    }

    public function header(string $header, string $value): self
    {
        $this->headers[$header] = $value;
        return $this;
    }

    public function withHeaders(array $headers): self
    {
        $headerKey = array_keys($headers);

        array_map(function ($header, $value) {
            $this->headers[$header] = $value;
        }, $headerKey, $headers);

        return $this;
    }
}