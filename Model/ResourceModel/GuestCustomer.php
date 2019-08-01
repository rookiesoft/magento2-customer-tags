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
use RookieSoft\CustomerTags\Model\GuestCustomerFactory as ModelGuestCustomerFactory;
use RookieSoft\CustomerTags\Model\EntityTagFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\EntityTag\CollectionFactory as EntityTagCollectionFactory;

class GuestCustomer extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    // protected $_tagCollectionFactory;
    // protected $_salesOrderFactory;
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
        ModelGuestCustomerFactory $modelGuestCustomerFactory,
        EntityTagFactory $entityTagFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory,
        EntityTagCollectionFactory $entityTagCollectionFactory
    ) {
        $this->modelGuestCustomerFactroy = $modelGuestCustomerFactory;
        $this->_salesOrderFactory = $salesOrderFactory;
        $this->_tagCollectionFactory = $tagCollectionFactory;
        $this->_entityTagFactory = $entityTagFactory;
        $this->guestCustomerCollectionFactory = $guestCustomerCollectionFactory;
        $this->entityTagCollectionFactory = $entityTagCollectionFactory;
        parent::__construct($context);
    }

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('rookiesoft_customertags_guest_customer', 'id');   //here id is the primary key of table
    }

    protected function getEmail($object)
    {
        return $this->_salesOrderFactory
            ->create()
            ->load($object->getEntityId())
            ->getCustomerEmail();
    }

    protected function getEntityId($object)
    {
        $select = $this->guestCustomerCollectionFactory
            ->create()
            ->addFieldToFilter('email', $this->getEmail($object));
        $entityId = [];
        foreach($select as $id){
            $entityId[] = $id->getId();
        }
        return implode($entityId);
    }
    protected function saveEmail($object)
    {
        if($object->getTag() != null) {
            $this->modelGuestCustomerFactroy
                ->create()
                ->setData([
                    'email' => $this->getEmail($object)
                ])
                ->save();
        }
    }
    protected function removeEntityId($object)
    {
        $select = $this->guestCustomerCollectionFactory
            ->create();
        $entityId = [];
        foreach($select as $id){
            $entityId[] = $id->getId();
        }

        $guestCustomerId = $this->entityTagCollectionFactory
            ->create()
            ->addFieldToFilter(
                'entity_id',['nin'=> $entityId]
            );
        // echo "<pre>";
        // echo print_r($this->removeEntityId($object), true);
        // exit;
        foreach ($guestCustomerId as $deleteExistingEntityId) {
            $deleteExistingEntityId->delete();
        }
    }
    /**
     * function to save tag_code and email
     *
     * @return void
     */
    protected function saveTags($object)
    {

        if($object->getTag() != null) {

            foreach($object->getTag() as $tagId) {
                $select = $this->_tagCollectionFactory
                    ->create()
                    ->addFieldToFilter(
                        'id', $tagId
                    );

                foreach($select->getItems() as $item){
                    $this->_entityTagFactory
                        ->create()
                        ->setData([
                            'entity_id' => $this->getEntityId($object),
                            'entity_type_id' => 1,
                            'tag_code' => $item->getTagCode()
                        ])
                        ->save();
                }
            }
        }
    }

    /**
     * _afterSave
     * @param  \Magento\Framework\Model\AbstractModel $object
     * @return array
     */
    // protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    // {
    //     //$object->getCustomerEmail;

    //     return parent::_afterSave($object);
    // }

    /**
     * _beforeSave
     * @param  \Magento\Framework\Model\AbstractModel $object
     * @return array
     */
    protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    {
        $this->modelGuestCustomerFactroy
            ->create()
            ->load(
                $this->getEntityId($object)
            )->delete();
        $this->removeEntityId($object);
        $this->saveEmail($object);
        $this->saveTags($object);
        // echo "<pre>";
        // echo print_r($this->removeEntityId($object), true);
        // exit;

        return parent::_beforeSave($object);
    }

    // protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    // {
    //     $object->addTag();
    //     echo "<pre>";
    //     echo print_r($object->addTag, true));
    //     exit;
    //     return parent::_afterLoad($object);
    // }
}
