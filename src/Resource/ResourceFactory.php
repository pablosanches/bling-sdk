<?php

declare(strict_types=1);

namespace PabloSanches\Bling\Resource;

use PabloSanches\Bling\Client as BlingClient;

abstract class ResourceFactory
{
    public static function factory(
        BlingClient $blingClient,
        string $resourceName,
        array $params = []
    ): ResourceInterface {
        $resourceNamespace = self::resourceNamespace($resourceName);
        return new $resourceNamespace($blingClient, $params);
    }

    public static function resourceNamespace(string $resourceName): string
    {
        $className = ucfirst($resourceName);
        $className = explode('_', $className);
        $className = array_map('ucfirst', $className);
        $className = implode('', $className);

        $resourceNamespace = sprintf(
            "%s\\%s\\%s",
            __NAMESPACE__,
            $className,
            $className
        );

        if (!class_exists($resourceNamespace)) {
            throw new \DomainException(sprintf('Resource "%s" não existe.', $resourceNamespace));
        }

        return $resourceNamespace;
    }
}
