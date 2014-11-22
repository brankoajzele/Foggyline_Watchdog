<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Model_Cron
{
    /**
     * Do a quick (raw query) cleanup on database
     */
    public function clean()
    {
        //You have to have $ttl at least 1 day
        if (($ttl = Mage::helper('foggyline_watchdog')->getTtl()) < 0) {
            return;
        }

        $resource = Mage::getSingleton('core/resource');
        $writeConnection = $resource->getConnection('core_write');
        $tableName = $resource->getTableName('foggyline_watchdog/action');

        $query = sprintf('DELETE FROM %s WHERE triggered_at < DATE_SUB(NOW(), INTERVAL %s DAY);', $tableName, $ttl);

        //Log the cleanup query for possible debugging if the Magento logging is on
        Mage::log($query, null, 'foggyline_watchdog_clean.log');

        try {
            $writeConnection->query($query);
        } catch (Exception $e) {
            Mage::logException($e);
        }

        return;
    }
}
