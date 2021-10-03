<?php

namespace Api;

use Codeception\Util\HttpCode;
use Step\Triangle;

class GetTriangleCest
{
    // шаг 1: Если треугольник существует, возвращается ответ "isPossible":"true"}
    public function existingTriangle(Triangle $I): void
    {
        $params = [
            'a' => 2,
            'b' => 3,
            'c' => 4
        ];
        $I->getTriangle($params);
        $I->seeResponseCodeIs(HttpCode::OK); //200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => true]);
    }

    // шаг 2: Если треугольник не существует, возвращается ответ "isPossible":"false"}
    public function notExistingTriangle(Triangle $I): void
    {
        $data = [
            'a' => 2,
            'b' => 2,
            'c' => 2
        ];
        $I->getTriangle($data);
        $I->seeResponseCodeIs(HttpCode::OK); //200
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['isPossible' => false]);
    }

    // шаг 3: Если переданы не валидные данные, возвращается ответ "message": {"error":"Not valid data"}}
    public function errorTriangle(Triangle $I): void
    {
        $params = [
            'a' => 2,
            'b' => 'b',
            'c' => -2
        ];
        $I->getTriangle($params);
        $I->seeResponseCodeIs(HttpCode::BAD_REQUEST); //400
        $I->seeResponseIsJson();
        $I->seeResponseContainsJson(['message' => ['error' => 'Not valid date']]);
    }
}