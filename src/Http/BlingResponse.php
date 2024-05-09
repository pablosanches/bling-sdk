<?php

namespace PabloSanches\Bling\Http;

use Psr\Http\Message\ResponseInterface;

class BlingResponse
{
    protected function __construct(
        private readonly int $statusCode,
        private readonly array|string $content = '',
    ) {
    }

    public static function factory(ResponseInterface $response)
    {
        $content = $response->getBody()->getContents();
        if (!empty($content)) {
            $content = json_decode(
                $content,
                true,
                512,
                JSON_THROW_ON_ERROR
            );
        }
        return new self(
            $response->getStatusCode(),
            $content
        );
    }

    public function isError(): bool
    {
        if ($this->statusCode >= 200 && $this->statusCode < 300) {
            return false;
        }
        return true;
    }

    public function getContent(): array
    {
        return $this->content;
    }

    public function getData(): array
    {
        return array_key_exists('data', $this->content) ? $this->content['data'] : [];
    }

    public function getError(): array
    {
        return array_key_exists('error', $this->content) ? $this->content['error'] : [];
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }
}