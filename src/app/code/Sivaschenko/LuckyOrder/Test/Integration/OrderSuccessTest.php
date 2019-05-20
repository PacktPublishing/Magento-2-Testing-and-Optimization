<?php

namespace Sivaschenko\LuckyOrder\Test\Integration;

/**
 * @magentoDataFixture loadFixture
 */
class OrderSuccessTest extends \Magento\TestFramework\TestCase\AbstractController
{

    public function testLuckyOrder()
    {
        $this->dispatch('checkout/onepage/success');

        $this->assertContains('Your order is lucky!', $this->getResponse()->getBody());
    }

    public static function loadFixture()
    {
        include __DIR__ . '/_files/lucky_order.php';
    }
}