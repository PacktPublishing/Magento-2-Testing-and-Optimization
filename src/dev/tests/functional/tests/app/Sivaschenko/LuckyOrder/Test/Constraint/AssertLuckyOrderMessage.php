<?php

namespace Sivaschenko\LuckyOrder\Test\Constraint;

use Magento\Checkout\Test\Page\CheckoutOnepageSuccess;
use Magento\Mtf\Constraint\AbstractConstraint;

class AssertLuckyOrderMessage extends AbstractConstraint
{
    public function processAssert(CheckoutOnepageSuccess $checkoutOnepageSuccess)
    {
        \PHPUnit_Framework_Assert::assertTrue(
            $checkoutOnepageSuccess->getMainColumn()->isMessagePresent(),
            'Lucky order message is not visible.'
        );
    }

    public function toString()
    {
        return 'Lucky order message is visible.';
    }
}
