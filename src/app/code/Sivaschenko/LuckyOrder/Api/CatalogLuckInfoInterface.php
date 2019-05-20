<?php

namespace Sivaschenko\LuckyOrder\Api;

interface CatalogLuckInfoInterface
{
    /**
     * @param int $productId
     * @return bool
     */
    public function isProductLucky($productId);

    /**
     * @param int $categoryId
     * @return bool
     */
    public function isCategoryLucky($categoryId);

    /**
     * @return bool
     */
    public function isCatalogLucky();
}