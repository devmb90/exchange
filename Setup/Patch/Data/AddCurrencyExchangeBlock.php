<?php
declare(strict_types=1);

namespace Bonecki\CurrencyExchange\Setup\Patch\Data;

use Magento\Framework\Setup\Patch\DataPatchInterface;
use Magento\Cms\Model\BlockFactory;
use Magento\Framework\Setup\ModuleDataSetupInterface;

class AddCurrencyExchangeBlock implements DataPatchInterface
{
    /**
     * @param BlockFactory $blockFactory
     * @param ModuleDataSetupInterface $moduleDataSetup
     */
    public function __construct(
        private BlockFactory             $blockFactory,
        private ModuleDataSetupInterface $moduleDataSetup
    )
    {
    }

    public function apply(): void
    {
        $this->moduleDataSetup->startSetup();

        $data = [
            'title' => 'Currency Exchange',
            'identifier' => 'currency_exchange',
            'content' => '{{block class="Bonecki\CurrencyExchange\Block\Exchange" template="Bonecki_CurrencyExchange::exchange.phtml"}}',
            'is_active' => 1,
            'stores' => [0]
        ];

        $block = $this->blockFactory->create();
        $block->setData($data)->save();

        $this->moduleDataSetup->endSetup();
    }

    public static function getDependencies(): array
    {
        return [];
    }

    public function getAliases(): array
    {
        return [];
    }
}
