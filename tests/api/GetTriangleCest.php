<?php

namespace Api;

use Codeception\Example;
use Codeception\Util\HttpCode;
use Step\Triangle;
use Generator;

class GetTriangleCest
{
    /**
     * @param Triangle $I
     * @dataProvider myProvider
     */

    public function Triangle(Triangle $I, Example $dataProvider)
    {
        $I->getTriangle($dataProvider['params']);
        $I->seeResponseCodeIs($dataProvider['expectedCode']);
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson($dataProvider['expectedMessage']);
    }

    private function myProvider(): Generator
    {
        // шаг 1: Если треугольник существует, возвращается ответ "isPossible":"true"}
        yield 'existingTriangle' => [
            'params' => ['a' => 2, 'b' => 3, 'c' => 4],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => true],
        ];
        // шаг 2: Если треугольник не существует, возвращается ответ "isPossible":"false"}
        yield 'notExistingTriangle' => [
            'params' => ['a' => 2, 'b' => 2, 'c' => 2],
            'expectedCode' => HttpCode::OK,
            'expectedMessage' => ['isPossible' => false],
        ];
        // шаг 3: Если переданы не валидные данные, возвращается ответ "message": {"error":"Not valid data"}}
        yield 'errorTriangle' => [
            'params' => ['a' => 2, 'b' => 'b', 'c' => 4],
            'expectedCode' => HttpCode::BAD_REQUEST,
            'expectedMessage' => ['message' => ['error' => 'Not valid date']],
        ];
    }
}