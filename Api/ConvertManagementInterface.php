<?php
declare(strict_types=1);

namespace Bonecki\CurrencyExchange\Api;

interface ConvertManagementInterface
{

    /**
     * @param string $param
     * @return string
     */
    public function getConvert($param);
}

