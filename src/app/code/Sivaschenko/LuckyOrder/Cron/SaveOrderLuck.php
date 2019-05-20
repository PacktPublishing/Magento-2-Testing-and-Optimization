<?php
namespace Sivaschenko\LuckyOrder\Cron;

use Sivaschenko\LuckyOrder\Model\LuckInfo;
use Magento\Framework\App\ResourceConnection;

class SaveOrderLuck
{
    /**
     * @var LuckInfo
     */
    private $luckInfo;

    /**
     * @var ResourceConnection
     */
    private $resource;

    /**
     * SaveOrderLuck constructor.
     * @param LuckInfo $luckInfo
     * @param ResourceConnection $resource
     */
    public function __construct(LuckInfo $luckInfo, ResourceConnection $resource)
    {
        $this->luckInfo = $luckInfo;
        $this->resource = $resource;
    }

    public function execute()
    {
        $connection = $this->resource->getConnection();

        $select = $connection->select()
            ->from(['o' => $connection->getTableName('sales_order')])
            ->joinLeft(
                ['l' => $connection->getTableName('order_luck')],
                'o.entity_id = l.order_id'
            )
            ->where('l.is_lucky is null');

        $orders = $connection->fetchAssoc($select);

        foreach ($orders as $order) {
            $connection->insert(
                $connection->getTableName('order_luck'),
                [
                    'order_id' => $order['entity_id'],
                    'is_lucky' => $this->luckInfo->isAmountLucky($order['grand_total'])
                ]
            );
        }
    }
}