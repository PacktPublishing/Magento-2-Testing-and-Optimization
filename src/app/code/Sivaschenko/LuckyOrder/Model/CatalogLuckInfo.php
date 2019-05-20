<?php
namespace Sivaschenko\LuckyOrder\Model;

use Sivaschenko\LuckyOrder\Api\CatalogLuckInfoInterface;
use Magento\Framework\App\ResourceConnection;

class CatalogLuckInfo implements CatalogLuckInfoInterface
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
     * @var int
     */
    private $priceAttributeId;

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

    /**
     * @param int $productId
     * @return bool
     */
    public function isProductLucky($productId)
    {
        $select = $this->getConnection()->select()
            ->from($this->getConnection()->getTableName('catalog_product_entity_decimal'), 'value')
            ->where('entity_id = ?', $productId)
            ->where('attribute_id = ?', $this->getPriceAttributeId());
        return $this->luckInfo->isAmountLucky($this->getConnection()->fetchOne($select));
    }

    /**
     * @param int $categoryId
     * @return bool
     */
    public function isCategoryLucky($categoryId)
    {
        $subSelect = $this->getConnection()->select()
            ->from($this->getConnection()->getTableName('catalog_category_product'), 'product_id')
            ->where('category_id = ?', $categoryId);

        $select = $this->getConnection()->select()
            ->from(
                $this->getConnection()->getTableName('catalog_product_entity_decimal'),
                    new \Zend_Db_Expr('sum(value)')
            )
            ->where('entity_id in ?', $subSelect)
            ->where('attribute_id = ?', $this->getPriceAttributeId());

        return $this->luckInfo->isAmountLucky($this->getConnection()->fetchOne($select));
    }

    /**
     * @return bool
     */
    public function isCatalogLucky()
    {
        $select = $this->getConnection()->select()
            ->from(
                $this->getConnection()->getTableName('catalog_product_entity_decimal'),
                new \Zend_Db_Expr('sum(value)')
            )->where('attribute_id = ?', $this->getPriceAttributeId());
        return $this->luckInfo->isAmountLucky($this->getConnection()->fetchOne($select));
    }

    /**
     * @return int
     */
    private function getPriceAttributeId()
    {
        if (!$this->priceAttributeId) {
            $select = $this->getConnection()->select()
                ->from($this->getConnection()->getTableName('eav_attribute'), 'attribute_id')
                ->where('entity_type_id = ?', 4)
                ->where('attribute_code = ?', 'price');
            $this->priceAttributeId = $this->getConnection()->fetchOne($select);
        }
        return $this->priceAttributeId;
    }

    /**
     * @return \Magento\Framework\DB\Adapter\AdapterInterface
     */
    private function getConnection()
    {
        return $this->resource->getConnection();
    }
}
