<?php
declare(strict_types=1);

namespace Bonecki\CurrencyExchange\Model;

use Bonecki\CurrencyExchange\Model\Curl\Client;
use Bonecki\CurrencyExchange\Api\ConvertManagementInterface;

class ConvertManagement implements ConvertManagementInterface
{
    /**
     * @param Client $client
     */
    public function __construct(private Client $client)
    {
    }

    /**
     * {@inheritdoc}
     */
    public function getConvert($param)
    {
        return $this->client->getConvertedCurrency($param);
    }
}

