<?php

namespace Sivaschenko\LuckyOrder\Model;

use Magento\Sales\Api\OrderRepositoryInterface;
use Sivaschenko\LuckyOrder\Api\OrderLuckInfoInterface;

class OrderLuckInfo implements OrderLuckInfoInterface
{
    /**
     * @var OrderRepositoryInterface
     */
    private $orderRepository;

    /**
     * @var LuckInfo
     */
    private $luckMeter;

    /**
     * OrderLuckInfo constructor.
     * @param OrderRepositoryInterface $orderRepository
     * @param LuckInfo $luckInfo
     */
    public function __construct(OrderRepositoryInterface $orderRepository, LuckInfo $luckInfo)
    {
        $this->orderRepository = $orderRepository;
        $this->luckMeter = $luckInfo;
    }

    /**
     * @param int $orderId
     * @return bool
     */
    public function isOrderLucky($orderId)
    {
        $total = $this->orderRepository->get($orderId)->getGrandTotal();
        $lucky = $this->luckMeter->isAmountLucky($total);
        return $lucky;
    }
}
