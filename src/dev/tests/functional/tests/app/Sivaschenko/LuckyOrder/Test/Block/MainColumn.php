<?php

namespace Sivaschenko\LuckyOrder\Test\Block;

use Magento\Mtf\Client\Locator;

class MainColumn extends \Magento\Mtf\Block\Block
{
    private $luckyMessageSelector = '//div[text()[contains(.,\'Your order is lucky!\')]]';

    public function isMessagePresent()
    {
        return $this->_rootElement->find($this->luckyMessageSelector, Locator::SELECTOR_XPATH)->isVisible();
    }
}