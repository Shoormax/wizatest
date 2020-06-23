<?php

declare(strict_types=1);

namespace AppBundle\Registry;

use AppBundle\Calculator\CalculatorInterface;
use AppBundle\Calculator\Mk1Calculator;
use AppBundle\Calculator\Mk2Calculator;

class CalculatorRegistry implements CalculatorRegistryInterface
{
    public function getCalculatorFor(string $model): ?CalculatorInterface
    {
        if (!in_array(
            $model,
            [
                Mk1Calculator::MODEL,
                Mk2Calculator::MODEL,
            ]
        )) {
            return null;
        }

        return Mk1Calculator::MODEL === $model ?
            new Mk1Calculator() :
            new Mk2Calculator();
    }
}
