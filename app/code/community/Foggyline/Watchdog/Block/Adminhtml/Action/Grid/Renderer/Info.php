<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Block_Adminhtml_Action_Grid_Renderer_Info extends Mage_Adminhtml_Block_Widget_Grid_Column_Renderer_Action
{
    public function render(Varien_Object $row)
    {
        $actions = array();

        $actions[] = array(
            'url' => $this->getUrl('*/*/info', array('id' => $row->getId())),
            'popup' => true,
            'caption' => $this->__('Info')
        );

        $this->getColumn()->setActions($actions);

        return parent::render($row);
    }
}
