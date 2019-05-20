<?php
namespace Sivaschenko\LuckyOrder\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $setup->startSetup();

        $table = $setup->getConnection()->newTable(
            $setup->getTable('order_luck')
        )->addColumn(
            'order_id',
            Table::TYPE_INTEGER,
            null,
            [
                'identity' => true,
                'unsigned' => true,
                'nullable' => false,
                'primary' => true
            ],
            'Order ID'
        )->addColumn(
            'is_lucky',
            Table::TYPE_BOOLEAN,
            null,
            [],
            'Is order lucky'
        )->addForeignKey(
            $setup->getFkName(
                $setup->getTable('order_luck'),
                'order_id',
                $setup->getTable('sales_order'),
                'entity_id'
            ),
            'order_id',
            $setup->getTable('sales_order'),
            'entity_id',
            Table::ACTION_CASCADE
        )->setComment('Is order lucky');

        $setup->getConnection()->createTable($table);

        $setup->endSetup();
    }
}
