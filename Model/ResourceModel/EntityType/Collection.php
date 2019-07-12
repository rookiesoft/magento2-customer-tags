<?php
namespace RookieSoft\CustomerTags\Model\ResourceModel\EntityType;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'RookieSoft\CustomerTags\Model\EntityType',
            'RookieSoft\CustomerTags\Model\ResourceModel\EntityType'
        );

    }
}