<?php

namespace PabloSanches\Bling\Resource\Dto;

abstract class AbstractDto implements DtoInterface
{
    protected function __construct(array $params = [])
    {
        $this->hydrate($params);
    }

    public static function factory(array $params = []): DtoInterface
    {
        return new static($params);
    }

    public function hydrate(array $params = []): void
    {
        foreach ($params as $param => $value) {
            if (property_exists($this, $param)) {
                $this->{$param} = $value;
            }
        }
    }

    public function export(): array
    {
        $properties = $this->getProperties();
        $data = [];
        foreach ($properties as $property) {
            $value = $this->{$property->name};
            if (!empty($value)) {
                $data[$property->name] = $this->{$property->name};
            }
        }
        return $data;
    }

    private function getProperties(): array
    {
        $reflected = new \ReflectionClass($this);
        return $reflected->getProperties(\ReflectionProperty::IS_PUBLIC);
    }
}