<?php

namespace PabloSanches\Bling\Resource\Dto;

use PabloSanches\Bling\Mock\Resource\Dto\MockDto;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\TestDox;
use PHPUnit\Framework\TestCase;

class AbstractDtoTest extends TestCase
{
    public static function dataProvider(): array
    {
        return [
            [
                [
                    'property1' => 1,
                    'property2' => 2,
                    'property3' => 3,
                ]
            ]
        ];
    }

    #[TestDox('Construir DTO sem nenhum parâmetro')]
    public function testFactoryDtoWithoutAnyParameter(): void
    {
        $mockDto = MockDto::factory();
        self::assertInstanceOf(DtoInterface::class, $mockDto);
        self::assertEmpty($mockDto->export());
    }

    #[TestDox('Construir DTO com parâmetros inicializados')]
    #[DataProvider('dataProvider')]
    public function testFactoryDtoWithParameters(array $dataProvider): void
    {
        $mockDto = MockDto::factory($dataProvider);
        self::assertInstanceOf(DtoInterface::class, $mockDto);
        self::assertEquals($dataProvider, $mockDto->export());
    }

    #[TestDox('Construir um DTO sem parâmetros inicias e hidrata-lo depois')]
    #[DataProvider('dataProvider')]
    public function testFactoryDtoWithoutParamsAndHidryateItBefore(array $dataProvider): void
    {
        $mockDto = MockDto::factory();
        self::assertInstanceOf(DtoInterface::class, $mockDto);
        self::assertEmpty($mockDto->export());

        $mockDto->hydrate($dataProvider);
        self::assertEquals($dataProvider, $mockDto->export());
    }
}
