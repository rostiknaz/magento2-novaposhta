<?php
/**
 * Created by PhpStorm.
 * User: naro
 * Date: 1/23/17
 * Time: 3:20 PM
 */

namespace Rostiknaz\NovaPoshta\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\DB\Ddl\Table;

class InstallSchema implements InstallSchemaInterface
{
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;
        $installer->startSetup();

        // Get novaposhta_city table
        $tableName = $installer->getTable('novaposhta_city');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($tableName) != true) {
            // Create novaposhta_city table
            $table = $installer->getConnection()
                ->newTable($tableName)
                ->addColumn(
                    'city_id',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'name_ru',
                    Table::TYPE_TEXT,
                    100,
                    [
                        'nullable' => false
                    ],
                    'Name RU'
                )
                ->addColumn(
                    'name_ua',
                    Table::TYPE_TEXT,
                    100,
                    [
                        'nullable' => false
                    ],
                    'Name UA'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT_UPDATE
                    ],
                    'Updated At'
                )
                ->setComment('NovaPoshta cities')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table);
        }

        // Get novaposhta_warehouse table
        $tableName1 = $installer->getTable('novaposhta_warehouse');
        // Check if the table already exists
        if ($installer->getConnection()->isTableExists($tableName1) != true) {
            // Create novaposhta_warehouse table
            $table1 = $installer->getConnection()
                ->newTable($tableName1)
                ->addColumn(
                    'id',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'identity' => true,
                        'unsigned' => true,
                        'nullable' => false,
                        'primary' => true
                    ],
                    'ID'
                )
                ->addColumn(
                    'city_id',
                    Table::TYPE_INTEGER,
                    10,
                    [
                        'unsigned' => true,
                        'nullable' => false,
                    ],
                    'City Id'
                )
                ->addColumn(
                    'address_ru',
                    Table::TYPE_TEXT,
                    200,
                    [],
                    'Address RU'
                )
                ->addColumn(
                    'address_ua',
                    Table::TYPE_TEXT,
                    200,
                    [],
                    'Address UA'
                )
                ->addColumn(
                    'phone',
                    Table::TYPE_TEXT,
                    100,
                    [],
                    'Phone'
                )
                ->addColumn(
                    'weekday_work_hours',
                    Table::TYPE_TEXT,
                    20,
                    [],
                    'Weekday work hours'
                )
                ->addColumn(
                    'weekday_receiving_hours',
                    Table::TYPE_TEXT,
                    20,
                    [],
                    'Weekday receiving hours'
                )
                ->addColumn(
                    'weekday_delivery_hours',
                    Table::TYPE_TEXT,
                    20,
                    [],
                    'Weekday delivery hours'
                )
                ->addColumn(
                    'saturday_work_hours',
                    Table::TYPE_TEXT,
                    20,
                    [],
                    'Saturday work hours'
                )
                ->addColumn(
                    'saturday_receiving_hours',
                    Table::TYPE_TEXT,
                    20,
                    [],
                    'Saturday receiving hours'
                )
                ->addColumn(
                    'saturday_delivery_hours',
                    Table::TYPE_TEXT,
                    20,
                    [],
                    'Saturday delivery hours'
                )
                ->addColumn(
                    'max_weight_allowed',
                    Table::TYPE_INTEGER,
                    4,
                    [],
                    'Max Weight Allowed'
                )
                ->addColumn(
                    'longitude',
                    Table::TYPE_FLOAT,
                    10,
                    [],
                    'Longitude'
                )
                ->addColumn(
                    'latitude',
                    Table::TYPE_FLOAT,
                    10,
                    [],
                    'Latitude'
                )
                ->addColumn(
                    'number_in_city',
                    Table::TYPE_INTEGER,
                    3,
                    [],
                    'Number In City'
                )
                ->addColumn(
                    'updated_at',
                    Table::TYPE_TIMESTAMP,
                    null,
                    [
                        'nullable' => false,
                        'default' => Table::TIMESTAMP_INIT_UPDATE
                    ],
                    'Updated At'
                )
                ->addForeignKey(
                    $installer->getFkName(
                        'novaposhta_warehouse',
                        'city_id',
                        'novaposhta_city',
                        'city_id'
                    ),
                    'city_id',
                    $installer->getTable('novaposhta_city'),
                    'city_id',
                    Table::ACTION_CASCADE
                )
                ->setComment('NovaPoshta warehouses')
                ->setOption('type', 'InnoDB')
                ->setOption('charset', 'utf8');
            $installer->getConnection()->createTable($table1);
        }

        $installer->endSetup();
    }
}