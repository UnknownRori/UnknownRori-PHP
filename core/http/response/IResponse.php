<?php

namespace Core\Http;

interface IResponse
{
    public function json(array $response, int $code = 200): self;
    public function header(string $header, string $value): self;
    public function withHeaders(array $headers): self;
}