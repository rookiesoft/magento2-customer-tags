<?php
namespace RookieSoft\CustomerTags\Model\ResourceModel;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;
use Magento\Sales\Model\OrderFactory as SalesOrderFactory;
use RookieSoft\CustomerTags\Model\EntityTag as ModelEntityTagFactory;

class EntityTag extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    protected $_tagCollectionFactory;
    protected $_salesOrderFactory;

    /**
     * Consructor
     *
     * @param \Magento\Framework\Model\ResourceModel\Db\Context $context
     *
     */
    public function __construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        TagCollectionFactory $tagCollectionFactory,
        SalesOrderFactory $salesOrderFactory,
        ModelEntityTagFactory $modelEntityTagFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory
    ) {
        $this->modelEntityTagFactory = $modelEntityTagFactory;
        $this->_salesOrderFactory = $salesOrderFactory;
        $this->_tagCollectionFactory = $tagCollectionFactory;
        $this->guestCustomerCollectionFactory = $guestCustomerCollectionFactory;
        parent::__construct($context);
    }
    /**
     * Define main table
     */
    protected function _construct(
        \Magento\Framework\Model\ResourceModel\Db\Context $context,
        TagCollectionFactory $tagCollectionFactory,
        SalesOrderFactory $salesOrderFactory,
        ModelEntityTagFactory $modelEntityTagFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory
    )
    {
        $this->_init('rookiesoft_customertags_entity_tag', 'id');   //here id is the primary key of table
    }

    // protected function getEmail($object)
    // {
    //     return $this->_salesOrderFactory
    //         ->create()
    //         ->load($object->getEntityId())
    //         ->getCustomerEmail();
    // }
    /**
     * function to save tag_code and email
     *
     * @return void
     */
    protected function saveTags($object)
    {

        if(
            is_array($object->getTag()) &&
            $object->getTag() != null
        ) {
            foreach($object->getTag() as $tagId) {
                $select = $this->_tagCollectionFactory
                    ->create()
                    ->addFieldToFilter(
                        'id', $tagId
                    );
                foreach($select->getItems() as $data){
                    $tagCode = $data->getTagCode();
                    if(isset($object->getEntityId())) {
                    $this->modelEntityTagFactory
                        ->create()
                        ->setData([
                            'entity_id' => $object->getEntityId(),
                            'tag_code' => $tagCode
                        ])
                        ->save();
                    }
                    // else{
                    //     $this->modelEntityTagFactory
                    //     ->create()
                    //     ->setData([
                    //         'entity_type_id' => $object->getEntityId(),
                    //         'tag_code' => $tagCode
                    //     ])
                    //     ->save();
                    }
                }
            }
        }
    }

    /**
     * _afterSave
     * @param  \Magento\Framework\Model\AbstractModel $object
     * @return array
     */
    protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    {
        if (!$object->getIsMassStatus()) {
            $this->saveTags($object);
        }
        return parent::_afterSave($object);
    }

    /**
     * _beforeSave
     * @param  \Magento\Framework\Model\AbstractModel $object
     * @return array
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {

        $deleteEntityId = $this->guestCustomerCollectionFactory
            ->create()
            ->addFieldToFilter(
                'entity_id', $object->getEntityId()
            )->getItems();
        foreach ($deleteEntityId as $deleteExistingEntityId) {
            $deleteExistingEntityId->delete();
        }


        return parent::_beforeSave($object);
    }
}