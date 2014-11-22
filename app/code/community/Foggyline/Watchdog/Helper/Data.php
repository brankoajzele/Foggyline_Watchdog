<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Helper_Data extends Mage_Core_Helper_Abstract
{

    const CONF_ACTIVE = 'system/foggyline_watchdog/active';
    const CONF_TTL = 'system/foggyline_watchdog/ttl';
    const CONF_LFACTIONS = 'system/foggyline_watchdog/lfactions';
    const CONF_LFPARAMS = 'system/foggyline_watchdog/lfparams';
    const CONF_LBACTIONS = 'system/foggyline_watchdog/lbactions';
    const CONF_LBPARAMS = 'system/foggyline_watchdog/lbparams';

    public function isModuleEnabled($moduleName = null)
    {
        if ((bool)Mage::getStoreConfig(self::CONF_ACTIVE)) {
            return true;
        }

        return parent::isModuleEnabled($moduleName);
    }

    /**
     * Total time in days to keep the logs in database
     * @param null $store
     * @return int
     */
    public function getTtl($store = null)
    {
        return (int)Mage::getStoreConfig(self::CONF_TTL, $store);
    }

    /**
     * lfactions == Log Frontend Actions
     * @param null $store
     * @return bool
     */
    public function isLogFrontendActions($store = null)
    {
        return (bool)Mage::getStoreConfig(self::CONF_LFACTIONS, $store);
    }

    /**
     * @param null $store
     * @return bool
     */
    public function isLogFrontendParams($store = null)
    {
        return (bool)Mage::getStoreConfig(self::CONF_LFPARAMS, $store);
    }

    /**
     * @param null $store
     * @return bool
     */
    public function isLogBackendActions($store = null)
    {
        return (bool)Mage::getStoreConfig(self::CONF_LBACTIONS, $store);
    }

    /**
     * @param null $store
     * @return bool
     */
    public function isLogBackendParams($store = null)
    {
        return (bool)Mage::getStoreConfig(self::CONF_LBPARAMS, $store);
    }
}
