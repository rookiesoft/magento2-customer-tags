<?php
namespace RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'RookieSoft\CustomerTags\Model\GuestCustomer',
            'RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer'
        );

    }
    protected function _renderFiltersBefore()
    {
        // error_log('something');
        parent::_renderFiltersBefore();
    }
}