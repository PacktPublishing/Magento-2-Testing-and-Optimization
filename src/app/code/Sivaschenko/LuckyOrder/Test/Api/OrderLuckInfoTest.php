<?php

namespace Sivaschenko\LuckyOrder\Test\Api;

use Magento\Sales\Model\Order;
use Magento\TestFramework\TestCase\WebapiAbstract;

class OrderLuckInfoTest extends WebapiAbstract
{
    /**
     * @magentoApiDataFixture ../../../../app/code/Sivaschenko/LuckyOrder/Test/Api/_files/lucky_order.php
     */
    public function testIsOrderLucky()
    {
        $isLucky = $this->_webApiCall(
            [
                'rest' => [
                    'resourcePath' => '/V1/isOrderLucky/' . $this->getOrderId(),
                    'httpMethod' => 'GET'
                ]
            ]
        );

        $this->assertTrue($isLucky);
    }

    private function getOrderId()
    {
        $objectManager = \Magento\TestFramework\Helper\Bootstrap::getObjectManager();
        $order = $objectManager->get(Order::class)->loadByIncrementId('100000001');
        return $order->getId();
    }
}
