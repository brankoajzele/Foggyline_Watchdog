<?php

/**
 * Foggyline
 *
 * @category    Foggyline
 * @package     Foggyline_Watchdog
 * @copyright   Copyright (c) Foggyline <ajzele@gmail.com>
 * @license     http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */
class Foggyline_Watchdog_Block_Adminhtml_Action_Grid extends Mage_Adminhtml_Block_Widget_Grid
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('foggyline_watchdog_action_grid');
        $this->setDefaultSort('action_id');
        $this->setDefaultDir('DESC');
        $this->setSaveParametersInSession(true);
        $this->setUseAjax(true);
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('foggyline_watchdog/action')
            ->getResourceCollection();

        $this->setCollection($collection);

        parent::_prepareCollection();
        return $this;
    }

    protected function _prepareColumns()
    {
        $this->addColumn('action_id', array(
            'header' => Mage::helper('foggyline_watchdog')->__('ID'),
            'align' => 'right',
            'index' => 'action_id',
        ));

        $websites = Mage::getModel('core/website')->getCollection()->toOptionHash();
        $websites['0'] = Mage::helper('foggyline_watchdog')->__('Admin Area');

        $this->addColumn('website_id', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Website'),
            'align' => 'right',
            'index' => 'website_id',
            'type' => 'options',
            'options' => $websites,
        ));

        $stores = Mage::getModel('core/store')->getCollection()->toOptionHash();
        $stores['0'] = Mage::helper('foggyline_watchdog')->__('Admin Area');

        $this->addColumn('store_id', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Store'),
            'align' => 'right',
            'index' => 'store_id',
            'type' => 'options',
            'options' => $stores,
        ));

        $this->addColumn('triggered_by_type', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Triggered by Type'),
            'align' => 'right',
            'index' => 'triggered_by_type',
            'type' => 'options',
            'options' => Mage::getModel('foggyline_watchdog/action')->getTriggeredByTypeOptionArray(),
        ));

        $this->addColumn('controller_module', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Controller Module'),
            'align' => 'right',
            'index' => 'controller_module',
        ));

        $this->addColumn('controller_name', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Controller Name'),
            'align' => 'right',
            'index' => 'controller_name',
        ));

        $this->addColumn('action_name', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Controller Action'),
            'align' => 'right',
            'index' => 'action_name',
        ));

        $this->addColumn('request_method', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Request Method'),
            'align' => 'right',
            'index' => 'request_method',
        ));

        $this->addColumn('client_ip', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Client IP'),
            'align' => 'right',
            'index' => 'client_ip',
        ));


        $this->addColumn('triggered_at', array(
            'header' => Mage::helper('foggyline_watchdog')->__('Triggered At'),
            'index' => 'triggered_at',
            'type' => 'datetime',
        ));

        $this->addColumn('action',
            array(
                'header' => Mage::helper('foggyline_watchdog')->__('Action'),
                'index' => 'action_id',
                'sortable' => false,
                'filter' => false,
                'renderer' => 'foggyline_watchdog/adminhtml_action_grid_renderer_info'
            ));

        parent::_prepareColumns();
        return $this;
    }

    public function getGridUrl()
    {
        return $this->getUrl('*/*/grid', array('_current' => true));
    }
}