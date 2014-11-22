<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Model_Observer
{
    /**
     * Mage::dispatchEvent('controller_action_predispatch', array('controller_action' => $this));
     */
    public function logger(Varien_Event_Observer $observer)
    {
        $controller = $observer->getEvent()->getControllerAction();
        $request = $controller->getRequest();

        //Watchdog if off => RETURN;
        //We don't log this extension actions => RETURN;
        if ((Mage::helper('foggyline_watchdog')->isModuleEnabled() == false)
            || ($request->getControllerModule() == 'Foggyline_Watchdog_Adminhtml')
        ) {
            return;
        }

        //We are in admin area, but admin logging is off => RETURN;
        if ((Mage::getDesign()->getArea() == 'adminhtml')
            && (Mage::helper('foggyline_watchdog')->isLogBackendActions() == false)
        ) {
            return;
        }

        //We are in frontend area, but frontend logging is off => RETURN;
        if ((Mage::getDesign()->getArea() == 'frontend')
            && (Mage::helper('foggyline_watchdog')->isLogFrontendActions() == false)
        ) {
            return;
        }

        //If user login detected
        $user = Mage::getSingleton('admin/session')->getUser();

        //If customer login detected
        $customer = Mage::getSingleton('customer/session')->getCustomer();

        $log = Mage::getModel('foggyline_watchdog/action');

        $log->setWebsiteId(Mage::app()->getWebsite()->getId());
        $log->setStoreId(Mage::app()->getStore()->getId());

        $log->setTriggeredAt(Mage::getModel('core/date')->timestamp(time()));

        if ($user && $user->getId()) {
            $log->setTriggeredByType(Foggyline_Watchdog_Model_Action::TRIGGERED_BY_TYPE_USER);
            $log->setTriggeredById($user->getId());
        } elseif ($customer && $customer->getId()) {
            $log->setTriggeredByType(Foggyline_Watchdog_Model_Action::TRIGGERED_BY_TYPE_CUSTOMER);
            $log->setTriggeredById($customer->getId());
        } else {
            $log->setTriggeredByType(Foggyline_Watchdog_Model_Action::TRIGGERED_BY_TYPE_GUEST);
            $log->setTriggeredById(null);
        }

        $log->setControllerModule($request->getControllerModule());
        $log->setFullActionName($request->getControllerModule());
        $log->setClientIp($request->getClientIp());
        $log->setControllerName($request->getControllerName());
        $log->setActionName($request->getActionName());
        $log->setControllerModule($request->getControllerModule());
        $log->setRequestMethod($request->getMethod());

        //We are in 'adminhtml' area and "lbparams" is ON
        if (Mage::getDesign()->getArea() == 'adminhtml'
            && Mage::helper('foggyline_watchdog')->isLogBackendActions()
            && Mage::helper('foggyline_watchdog')->isLogBackendParams()
        ) {
            $log->setRequestParams(Mage::helper('core')->encrypt(serialize($request->getParams())));
        }

        //We are in 'frontend' area and "lfparams" is ON
        if (Mage::getDesign()->getArea() == 'frontend'
            && Mage::helper('foggyline_watchdog')->isLogFrontendActions()
            && Mage::helper('foggyline_watchdog')->isLogFrontendParams()
        ) {
            $log->setRequestParams(Mage::helper('core')->encrypt(serialize($request->getParams())));
        }

        //In case of other areas, we don't log request params

        try {
            $log->save();
        } catch (Exception $e) {
            //If you cant save, die silently, not a big deal
            Mage::logException($e);
        }
    }
}
