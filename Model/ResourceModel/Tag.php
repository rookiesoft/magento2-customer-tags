<?php

namespace RookieSoft\CustomerTags\Model\ResourceModel;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
use RookieSoft\CustomerTags\Model\TagFactory as TagFactory;

class Tag extends AbstractDb
{
    protected $_tagFactory;
    /**
     * Consructor
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        TagFactory $tagFactory

    ) {
        $this->_tagFactory = $tagFactory;
        parent::__construct($context);
    }

    /**
     * Define main table
     */
    protected function _construct()
    {

        $this->_init('rookiesoft_customertags_tag', 'id');
    }

    /**
     * getTagCode
     * @param  type $object
     * @return string
     */
    protected function getTagCode($object)
    {
        return $this->_tagFactory
            ->create()
            ->load($object->getId())
            ->getTagCode();
    }

    // /**
    //  * _afterSave
    //  * @param  \Magento\Framework\Model\AbstractModel $object
    //  * @return array
    //  */
    // protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    // {

    //     if (!$object->getIsMassStatus()) {
    //         $this->saveCategory($object);
    //     }

    //     return parent::_afterSave($object);
    // }
    // *
    //  * _beforeSave
    //  * @param  \Magento\Framework\Model\AbstractModel $object
    //  * @return array
     
    // protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    // {
    //     $deleteTagCode = $this->tagCategoryTagCollectionFactory
    //         ->create()
    //         ->addFieldToFilter(
    //             'tag_code', $this->getTagCode($object)
    //         )->getItems();
    //     foreach ($deleteTagCode as $deleteExistingTagCode) {
    //         $deleteExistingTagCode->delete();
    //     }
    //     return parent::_beforeSave($object);
    // }
}
