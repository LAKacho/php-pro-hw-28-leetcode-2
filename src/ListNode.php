<?php

declare(strict_types=1);

namespace LeetCode;




final class ListNode
{
    public function __construct(
        public readonly int $value,
        public ?ListNode $next = null,
    ) {
    }
}
