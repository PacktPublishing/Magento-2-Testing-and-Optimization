<?php

namespace Sivaschenko\LuckyOrder\Block;

use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;
use Sivaschenko\LuckyOrder\Api\CatalogLuckInfoInterface;

class Catalog extends AbstractBlock
{
    /**
     * @var CatalogLuckInfoInterface
     */
    private $catalogLuckInfo;

    /**
     * OrderSuccess constructor.
     * @param Context $context
     * @param CatalogLuckInfoInterface $catalogLuckInfo
     * @param array $data
     */
    public function __construct(
        Context $context,
        CatalogLuckInfoInterface $catalogLuckInfo,
        array $data = []
    ) {
        $this->catalogLuckInfo = $catalogLuckInfo;
        parent::__construct($context, $data);
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    protected function _toHtml()
    {
        if ($this->catalogLuckInfo->isCatalogLucky()) {
            return __('The catalog is lucky!');
        }
        return __('The catalog is not lucky!');
    }
}
