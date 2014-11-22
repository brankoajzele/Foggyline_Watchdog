<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Adminhtml_Foggyline_Watchdog_ActionController extends Mage_Adminhtml_Controller_Action
{
    protected function _getHelper()
    {
        return Mage::helper('foggyline_watchdog');
    }

    public function indexAction()
    {
        $this->loadLayout();
        $this->_addContent(
            $this->getLayout()->createBlock('foggyline_watchdog/adminhtml_action')
        );
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('foggyline_watchdog/adminhtml_action_grid', 'foggyline_watchdog.adminhtml_action_grid')
                ->toHtml()
        );
    }

    public function infoAction()
    {
        $log = Mage::getModel('foggyline_watchdog/action')
            ->load($this->getRequest()->getParam('id'));

        Mage::register('current_foggyline_watchdog', $log);

        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('foggyline_watchdog/adminhtml_action_info', 'foggyline_watchdog.adminhtml_action_info')
                ->toHtml()
        );
    }
}