<?php

declare(strict_types=1);

namespace Bonecki\CurrencyExchange\Block;

class Exchange extends \Magento\Framework\View\Element\Template
{

    /**
     * @param \Magento\Framework\View\Element\Template\Context  $context
     * @param array $data
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

}

