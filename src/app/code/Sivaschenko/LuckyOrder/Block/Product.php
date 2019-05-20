<?php

namespace Sivaschenko\LuckyOrder\Block;

use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;
use Magento\Framework\Registry;
use Sivaschenko\LuckyOrder\Api\CatalogLuckInfoInterface;

class Product extends AbstractBlock
{
    /**
     * @var CatalogLuckInfoInterface
     */
    private $catalogLuckInfo;

    /**
     * @var Registry
     */
    private $registry;

    /**
     * OrderSuccess constructor.
     * @param Context $context
     * @param CatalogLuckInfoInterface $catalogLuckInfo
     * @param Registry $registry
     * @param array $data
     */
    public function __construct(
        Context $context,
        CatalogLuckInfoInterface $catalogLuckInfo,
        Registry $registry,
        array $data = []
    ) {
        $this->catalogLuckInfo = $catalogLuckInfo;
        $this->registry = $registry;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\Phrase|string
     */
    protected function _toHtml()
    {
        /** @var \Magento\Catalog\Model\Product $product */
        $product = $this->registry->registry('product');
        if ($product && $this->catalogLuckInfo->isProductLucky($product->getId())) {
            return __('This product is lucky!');
        }
        return __('This product is not lucky!');
    }
}
