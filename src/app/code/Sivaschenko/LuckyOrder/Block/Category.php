<?php

namespace Sivaschenko\LuckyOrder\Block;

use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;
use Magento\Framework\Registry;
use Sivaschenko\LuckyOrder\Api\CatalogLuckInfoInterface;
use Magento\Framework\DataObject\IdentityInterface;
use Magento\Catalog\Model\Category as CategoryModel;

class Category extends AbstractBlock implements IdentityInterface
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
     * @return \Magento\Framework\Phrase
     */
    protected function _toHtml()
    {
        $category = $this->getCurrentCategory();
        if ($category && $this->catalogLuckInfo->isCategoryLucky($category->getId())) {
            return __('This category is lucky!');
        }
        return __('This category is not lucky!');
    }

    /**
     * @return CategoryModel
     */
    private function getCurrentCategory()
    {
        return $this->registry->registry('current_category');
    }

    /**
     * @return int
     */
    public function getCacheLifetime()
    {
        return 3600;
    }

    /**
     * @return string
     */
    public function getCacheKey()
    {
        return $this->getNameInLayout() . $this->getCurrentCategory()->getId();
    }

    /**
     * @return \string[]
     */
    public function getCacheKeyInfo()
    {
        return parent::getCacheKeyInfo();
    }

    /**
     * @return array
     */
    public function getCacheTags()
    {
        return parent::getCacheTags();
    }

    /**
     * @return array
     */
    public function getIdentities()
    {
        return $this->getCurrentCategory()->getIdentities();
    }
}
