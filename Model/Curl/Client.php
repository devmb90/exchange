<?php
declare(strict_types=1);

namespace Bonecki\CurrencyExchange\Model\Curl;

use Bonecki\CurrencyExchange\Helper\ExchangeHelper;
use Magento\Framework\Serialize\SerializerInterface;

class Client
{
    /**
     * @param ExchangeHelper $exchangeHelper
     * @param SerializerInterface $serializer
     */
    public function __construct(private ExchangeHelper $exchangeHelper, private SerializerInterface $serializer)
    {}

    /**
     * @return array
     */
    private function getExchanges(): array
    {
        $options = [
            CURLOPT_URL => $this->exchangeHelper->getExchangeUrl(),
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => 'UTF-8',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_CUSTOMREQUEST => 'GET'
        ];

        $curl = curl_init();
        curl_setopt_array($curl, $options);

        try {
            $response = curl_exec($curl);
            if (curl_errno($curl)) {
                throw new Exception(curl_error($curl));
            }
            curl_close($curl);

            if (!empty($response)) {
                return json_decode($response, true);
            }

            return $this->serializer->unserialize($response);

        } catch (\Exception $e) {
            curl_close($curl);
            return ['error' => $e->getMessage()];
        }
    }

    /**
     * @param $amount
     * @return float
     */
    public function getConvertedCurrency($amount): float
    {
        $response = $this->getExchanges();
        $result = round($response['eur'][$this->exchangeHelper->getTargetCurrency()] * $amount, 2, PHP_ROUND_HALF_DOWN);
        return $result;
    }

}
