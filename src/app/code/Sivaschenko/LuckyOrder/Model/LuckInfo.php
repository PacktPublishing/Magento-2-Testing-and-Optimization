<?php

namespace Sivaschenko\LuckyOrder\Model;

class LuckInfo
{
    /**
     * @param float $amount
     * @return bool
     */
    public function isAmountLucky($amount)
    {
        $integerPart = (int) $amount;
        $decimalPart = (int)(($amount - $integerPart) * 100);
        return $this->sumDigits($integerPart) == $this->sumDigits($decimalPart);
    }

    /**
     * @param int $number
     * @return int
     */
    private function sumDigits($number)
    {
        $sum = $number;
        while (null === $sum || strlen($sum) > 1) {
            $sum = array_sum(str_split($sum));
        }
        return $sum;
    }
}