<?php

namespace Bonecki\CurrencyExchange\Helper;

use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

class ExchangeHelper extends AbstractHelper
{
    const XML_PATH_API_URL = 'exchange_configuration/api/api_url';
    const XML_PATH_TARGET_CURRENCY = 'exchange_configuration/api/target_currency';

    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    public function getExchangeUrl($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_API_URL, $storeId);
    }

    /**
     * @param $storeId
     * @return mixed
     */
    public function getTargetCurrency($storeId = null)
    {
        return $this->getConfigValue(self::XML_PATH_TARGET_CURRENCY, $storeId);
    }
}
