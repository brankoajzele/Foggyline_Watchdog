<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Block_Adminhtml_Action_Info extends Mage_Adminhtml_Block_Widget
{
    protected function _toHtml()
    {
        $log = Mage::registry('current_foggyline_watchdog');

        if ($log->getRequestParams()) {
            $log->setRequestParams(unserialize(Mage::helper('core')->decrypt($log->getRequestParams())));
        }

        //Cheap trick, but it works :)
        //Gives key-value output in popup
        Zend_Debug::dump($log->toArray(), 'Action Info');
    }
}
