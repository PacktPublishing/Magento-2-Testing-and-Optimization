<?php

namespace Sivaschenko\LuckyOrder\Block;

use Magento\Checkout\Model\Session;
use Magento\Framework\View\Element\AbstractBlock;
use Magento\Framework\View\Element\Context;
use Sivaschenko\LuckyOrder\Model\LuckInfo;

class Cart extends AbstractBlock
{
    /**
     * @var LuckInfo
     */
    private $luckInfo;

    /**
     * @var Session
     */
    private $session;

    /**
     * OrderSuccess constructor.
     * @param Context $context
     * @param LuckInfo $luckInfo
     * @param Session $session
     * @param array $data
     */
    public function __construct(
        Context $context,
        LuckInfo $luckInfo,
        Session $session,
        array $data = []
    ) {
        $this->luckInfo = $luckInfo;
        $this->session = $session;
        parent::__construct($context, $data);
        $this->_isScopePrivate = true;
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    protected function _toHtml()
    {
        $quote = $this->session->getQuote();
        if ($quote && $this->luckInfo->isAmountLucky($quote->getGrandTotal())) {
            return __('Your cart is lucky!');
        }
        return __('Your cart is not lucky!');
    }
}
