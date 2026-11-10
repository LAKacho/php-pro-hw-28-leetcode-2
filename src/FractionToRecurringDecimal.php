<?php

declare(strict_types=1);

namespace LeetCode;



























final class FractionToRecurringDecimal
{
    public function fractionToDecimal(int $numerator, int $denominator): string
    {
        if ($denominator === 0) {
            throw new \InvalidArgumentException('Деление на ноль невозможно.');
        }

        if ($numerator === 0) {
            return '0';
        }

        $parts = [];

        
        if (($numerator < 0) !== ($denominator < 0)) {
            $parts[] = '-';
        }

        
        $num = abs($numerator);
        $den = abs($denominator);

        
        $parts[] = (string) intdiv($num, $den);
        $remainder = $num % $den;

        if ($remainder === 0) {
            return implode('', $parts);
        }

        
        $parts[] = '.';
        $digits = [];
         
        $seen = [];

        while ($remainder !== 0 && !isset($seen[$remainder])) {
            $seen[$remainder] = count($digits);
            $remainder *= 10;
            $digits[] = (string) intdiv($remainder, $den);
            $remainder %= $den;
        }

        if ($remainder === 0) {
            
            $parts[] = implode('', $digits);

            return implode('', $parts);
        }

        
        $nonRepeating = implode('', array_slice($digits, 0, $seen[$remainder]));
        $repeating = implode('', array_slice($digits, $seen[$remainder]));
        $parts[] = $nonRepeating . '(' . $repeating . ')';

        return implode('', $parts);
    }
}
