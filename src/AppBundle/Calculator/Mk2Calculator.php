<?php

declare(strict_types=1);

namespace AppBundle\Calculator;

use AppBundle\Model\Change;

class Mk2Calculator implements CalculatorInterface
{
    const MODEL = 'mk2';

    private const CURRENCIES = [
        [
            'value' => 10,
            'attr' => 'bill10',
        ],
        [
            'value' => 5,
            'attr' => 'bill5',
        ],
        [
            'value' => 2,
            'attr' => 'coin2',
        ],
    ];

    public function getSupportedModel(): string
    {
        return self::MODEL;
    }

    public function getChange(int $amount): ?Change
    {
        $change = new Change();

        foreach (self::CURRENCIES as $currency) {
            $change->{$currency['attr']} = floor($amount / $currency['value']);
            $amount -= $currency['value'] * $change->{$currency['attr']};
        }

        return 0 === \intval($amount) ?
            $change :
            null;
    }
}
