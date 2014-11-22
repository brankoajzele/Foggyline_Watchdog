<?php
/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

$installer = $this;

$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('foggyline_watchdog/action'))
    ->addColumn('action_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Id')
    ->addColumn('website_id', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'Website ID')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'Store ID')
    ->addColumn('triggered_at', Varien_Db_Ddl_Table::TYPE_DATETIME, null, array(
        'nullable' => false,
    ), 'Triggered At')
    ->addColumn('triggered_by_type', Varien_Db_Ddl_Table::TYPE_SMALLINT, 10, array(
        'nullable' => false,
    ), 'Triggered By Type')
    ->addColumn('triggered_by_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, 10, array(
        'nullable' => true,
    ), 'Triggered By ID')
    ->addColumn('controller_module', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Controller Module')
    ->addColumn('client_ip', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Client Ip')
    ->addColumn('controller_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Controller Name')
    ->addColumn('action_name', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Action Name')
    ->addColumn('controller_module', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Controller Module')
    ->addColumn('request_method', Varien_Db_Ddl_Table::TYPE_VARCHAR, null, array(
        'nullable' => true,
    ), 'Request Method')
    ->addColumn('request_params', Varien_Db_Ddl_Table::TYPE_TEXT, null, array(
        'nullable' => true,
    ), 'Request Params');

$installer->getConnection()->createTable($table);

$installer->endSetup();
