<?php

namespace Step;

use ApiTester;

class Triangle extends ApiTester
{
    /** @var string  */
    public const URL = '/triangle';

    /**
     * @param array $params
     *
     * @return void
     */
    public function getTriangle(array $params = []): void
    {
        $this->sendGet(self::URL . '/possible', $params);
    }
}
