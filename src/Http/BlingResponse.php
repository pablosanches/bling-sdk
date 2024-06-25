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
            try {
                $content = json_decode(
                    $content,
                    true,
                    512,
                    JSON_THROW_ON_ERROR
                );
            } catch (\JsonException $e) {
                $content = $e->getMessage();
            }
        }
        return new self(
            $response->getStatusCode(),
            $content
        );
    }

    public function hasError(): bool
    {
        if ($this->statusCode >= 200 && $this->statusCode < 300) {
            return false;
        }
        return true;
    }

    public function getContent(): array
    {
        if (!is_array($this->content)) {
            return [$this->content];
        }
        return $this->content;
    }

    public function getData(): array
    {
        $content = $this->getContent();
        return array_key_exists('data', $content) ? $content['data'] : [];
    }

    public function getError(): array
    {
        $content = $this->getContent();
        return array_key_exists('error', $content) ? $content : [];
    }

    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    public function export(): array
    {
        if ($this->hasError()) {
            return $this->getError();
        }

        return $this->getData();
    }
}
