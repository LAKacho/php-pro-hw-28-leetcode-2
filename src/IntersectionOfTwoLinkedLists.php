<?php

declare(strict_types=1);

namespace LeetCode;























final class IntersectionOfTwoLinkedLists
{
    public function getIntersectionNode(?ListNode $headA, ?ListNode $headB): ?ListNode
    {
        if ($headA === null || $headB === null) {
            return null;
        }

        $a = $headA;
        $b = $headB;

        while ($a !== $b) {
            
            
            $a = ($a === null) ? $headB : $a->next;
            $b = ($b === null) ? $headA : $b->next;
        }

        return $a;
    }
}
