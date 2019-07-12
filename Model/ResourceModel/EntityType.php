<?php
namespace RookieSoft\CustomerTags\Model\ResourceModel;
class EntityType extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('rookiesoft_customertags_entity_type', 'id');   //here id is the primary key of table
    }
}