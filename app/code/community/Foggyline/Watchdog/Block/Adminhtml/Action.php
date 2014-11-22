<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Block_Adminhtml_Action extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        $this->_blockGroup = 'foggyline_watchdog';
        $this->_controller = 'adminhtml_action';

        $this->_headerText = Mage::helper('foggyline_watchdog')->__('Watchdog action logs');


        parent::__construct();

        $this->removeButton('add');
    }
}
