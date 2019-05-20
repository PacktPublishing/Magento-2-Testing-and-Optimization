<?php

namespace Sivaschenko\LuckyOrder\Api;

interface OrderLuckInfoInterface
{
    /**
     * @param int $orderId
     * @return bool
     */
    public function isOrderLucky($orderId);
}