<?php
namespace RookieSoft\CustomerTags\Model\ResourceModel\Tag;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'id';
    /**
     * Define model & resource model
     */
    protected function _construct()
    {
        $this->_init(
            'RookieSoft\CustomerTags\Model\Tag',
            'RookieSoft\CustomerTags\Model\ResourceModel\Tag'
        );

    }
    /**
     * Retrieve option array
     *
     * @return array
     */
    public function toOptionArray()
    {
        return parent::_toOptionArray('id','label');
    }
}
