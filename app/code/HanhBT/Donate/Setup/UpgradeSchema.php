<?php

namespace HanhBT\Donate\Setup;

use Magento\Framework\Setup\UpgradeSchemaInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;

class UpgradeSchema implements UpgradeSchemaInterface
{
    /**
     * Upgrades DB schema for a module
     *
     * @param SchemaSetupInterface $setup
     * @param ModuleContextInterface $context
     * @return void
     */
    public function upgrade(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $tables = [
            'quote_address',
            'quote',
            'sales_order',
            'sales_invoice',
            'sales_creditmemo',
        ];
        $setup->startSetup();

        foreach ($tables as $table) {
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($table),
                    'donate',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '12,4',
                        'default' => 0.00,
                        'comment' => 'Donate'
                    ]
                );
            $setup->getConnection()
                ->addColumn(
                    $setup->getTable($table),
                    'base_donate',
                    [
                        'type' => \Magento\Framework\DB\Ddl\Table::TYPE_DECIMAL,
                        '12,4',
                        'default' => 0.00,
                        'comment' => 'Base Donate'
                    ]
                );
        }

        $setup->endSetup();
    }
}
