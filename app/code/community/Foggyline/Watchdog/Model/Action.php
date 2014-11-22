<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Model_Action extends Mage_Core_Model_Abstract
{
    const TRIGGERED_BY_TYPE_USER = 1;
    const TRIGGERED_BY_TYPE_CUSTOMER = 2;
    const TRIGGERED_BY_TYPE_GUEST = 3;

    //const TRIGGERED_BY_TYPE_API = 4;

    protected function _construct()
    {
        $this->_init('foggyline_watchdog/action');

    }

    protected function _getHelper()
    {
        return Mage::helper('foggyline_watchdog');
    }

    public static function getTriggeredByTypeOptionArray()
    {
        return array(
            self::TRIGGERED_BY_TYPE_USER => self::_getHelper()->__('User'),
            self::TRIGGERED_BY_TYPE_CUSTOMER => self::_getHelper()->__('Customer'),
            self::TRIGGERED_BY_TYPE_GUEST => self::_getHelper()->__('Guest'),
            //self::TRIGGERED_BY_TYPE_API => self::_getHelper()->__('API'),
        );
    }
}
