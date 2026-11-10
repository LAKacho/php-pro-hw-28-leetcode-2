<?php

declare(strict_types=1);




spl_autoload_register(static function (string $class): void {
    if (str_starts_with($class, 'LeetCode\\')) {
        require __DIR__ . '/../src/' . substr($class, strlen('LeetCode\\')) . '.php';
    }
});

use LeetCode\FractionToRecurringDecimal;
use LeetCode\IntersectionOfTwoLinkedLists;
use LeetCode\ListNode;

function assertSameValue(mixed $expected, mixed $actual, string $message): void
{
    if ($expected !== $actual) {
        throw new \RuntimeException(sprintf(
            "%s\nОжидалось: %s\nПолучено: %s",
            $message,
            var_export($expected, true),
            var_export($actual, true),
        ));
    }
}

function buildList(array $values): ?ListNode
{
    $head = null;
    $tail = null;
    foreach ($values as $value) {
        $node = new ListNode($value);
        if ($head === null) {
            $head = $node;
        } else {
            $tail->next = $node;
        }
        $tail = $node;
    }

    return $head;
}

function listToValues(?ListNode $head): array
{
    $values = [];
    while ($head !== null) {
        $values[] = $head->value;
        $head = $head->next;
    }

    return $values;
}



$intersection = new IntersectionOfTwoLinkedLists();


$shared = buildList([8, 4, 5]);
$a1 = buildList([4, 1]);
$b1 = buildList([5, 6, 1]);

$tail = $a1;
while ($tail->next !== null) {
    $tail = $tail->next;
}
$tail->next = $shared;
$tail = $b1;
while ($tail->next !== null) {
    $tail = $tail->next;
}
$tail->next = $shared;

assertSameValue([8, 4, 5], listToValues($intersection->getIntersectionNode($a1, $b1)), 'Ошибка: пересечение в середине списка.');
echo "[OK] 160: пересечение в середине\n";


$a2 = buildList([2, 6, 4]);
$b2 = buildList([1, 5]);
assertSameValue(null, $intersection->getIntersectionNode($a2, $b2), 'Ошибка: списки без пересечения должны дать null.');
echo "[OK] 160: нет пересечения\n";


assertSameValue(null, $intersection->getIntersectionNode(null, null), 'Ошибка: два пустых списка.');
assertSameValue(null, $intersection->getIntersectionNode(null, buildList([1])), 'Ошибка: один пустой список.');
echo "[OK] 160: пустые списки\n";


$a4 = buildList([1, 2, 3]);
$b4 = $a4;
assertSameValue([1, 2, 3], listToValues($intersection->getIntersectionNode($a4, $b4)), 'Ошибка: совпадающие списки.');
echo "[OK] 160: пересечение в голове\n";



$fraction = new FractionToRecurringDecimal();

assertSameValue('0', $fraction->fractionToDecimal(0, 3), 'Ошибка: нулевой числитель.');
assertSameValue('0.5', $fraction->fractionToDecimal(1, 2), 'Ошибка: конечная дробь 1/2.');
assertSameValue('2', $fraction->fractionToDecimal(2, 1), 'Ошибка: целое число.');
assertSameValue('-6.25', $fraction->fractionToDecimal(-50, 8), 'Ошибка: отрицательный результат.');
assertSameValue('0.(6)', $fraction->fractionToDecimal(2, 3), 'Ошибка: период 2/3.');
assertSameValue('0.(3)', $fraction->fractionToDecimal(1, 3), 'Ошибка: период 1/3.');
assertSameValue('0.1(6)', $fraction->fractionToDecimal(1, 6), 'Ошибка: непериодическая часть + период 1/6.');
assertSameValue('0.(142857)', $fraction->fractionToDecimal(1, 7), 'Ошибка: длинный период 1/7.');
assertSameValue('3.(3)', $fraction->fractionToDecimal(10, 3), 'Ошибка: целая часть + период 10/3.');
assertSameValue('0.2', $fraction->fractionToDecimal(4, 20), 'Ошибка: сократимая дробь 4/20.');
assertSameValue('-6.25', $fraction->fractionToDecimal(50, -8), 'Ошибка: отрицательный знаменатель.');
assertSameValue('2', $fraction->fractionToDecimal(-2, -1), 'Ошибка: минус на минус — без знака.');


assertSameValue('0.0000000004656612873077392578125', $fraction->fractionToDecimal(1, 2147483648), 'Ошибка: крайний знаменатель 2^31.');
assertSameValue('-2147483648', $fraction->fractionToDecimal(-2147483648, 1), 'Ошибка: крайний числитель.');
assertSameValue('1', $fraction->fractionToDecimal(-2147483648, -2147483648), 'Ошибка: PHP_INT_MIN / PHP_INT_MIN.');
assertSameValue('2147483648', $fraction->fractionToDecimal(-2147483648, -1), 'Ошибка: PHP_INT_MIN / -1 (нет переполнения в 64-битном PHP).');

echo "[OK] 166: все случаи дробей\n";

echo "\nВсе тесты пройдены успешно.\n";
