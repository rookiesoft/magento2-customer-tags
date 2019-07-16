<?php
namespace RookieSoft\CustomerTags\Model\ResourceModel;

// use Magento\Framework\EntityManager\EntityManager;
// use Magento\Framework\EntityManager\MetadataPool;
// use Magento\Framework\Model\AbstractModel;
// use Magento\Framework\Model\ResourceModel\Db\Context;
// use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

// use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
// use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;
// use Magento\Sales\Model\OrderFactory as SalesOrderFactory;
// use RookieSoft\CustomerTags\Model\GuestCustomerFactory as ModelGuestCustomerFactory;

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
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory
    ) {
        $this->modelGuestCustomerFactroy = $modelGuestCustomerFactory;
        $this->_salesOrderFactory = $salesOrderFactory;
        $this->_tagCollectionFactory = $tagCollectionFactory;
        $this->guestCustomerCollectionFactory = $guestCustomerCollectionFactory;
        parent::__construct($context);
    }

    /**
     * Define main table
     */
    protected function _construct()
    {
        $this->_init('rookiesoft_customertags_guest_customer', 'id');   //here id is the primary key of table
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
    // protected function saveTags($object)
    // {

    //     if(
    //         is_array($object->getTag()) &&
    //         $object->getTag() != null
    //     ) {
    //         foreach($object->getTag() as $tagId) {
    //             $select = $this->_tagCollectionFactory
    //                 ->create()
    //                 ->addFieldToFilter(
    //                     'id', $tagId
    //                 );
    //             foreach($select->getItems() as $data){
    //                 $tagCode = $data->getTagCode();

    //                 $this->modelGuestCustomerFactroy
    //                     ->create()
    //                     ->setData([
    //                         'email' => $this->getEmail($object),
    //                         'tag_code' => $tagCode
    //                     ])
    //                     ->save();
    //             }
    //         }
    //     }
    // }

    /**
     * _afterSave
     * @param  \Magento\Framework\Model\AbstractModel $object
     * @return array
     */
    // protected function _afterSave(\Magento\Framework\Model\AbstractModel $object)
    // {
    //     if (!$object->getIsMassStatus()) {
    //         $this->saveTags($object);
    //     }
    //     return parent::_afterSave($object);
    // }

    /**
     * _beforeSave
     * @param  \Magento\Framework\Model\AbstractModel $object
     * @return array
     */
    // protected function _beforeSave(\Magento\Framework\Model\AbstractModel $object)
    // {

    //     $deleteEmail = $this->guestCustomerCollectionFactory
    //         ->create()
    //         ->addFieldToFilter(
    //             'email', $this->getEmail($object)
    //         )->getItems();
    //     foreach ($deleteEmail as $deleteExistingEmail) {
    //         $deleteExistingEmail->delete();
    //     }


    //     return parent::_beforeSave($object);
    // }

    // protected function _afterLoad(\Magento\Framework\Model\AbstractModel $object)
    // {
    //     $object->addTag();
    //     echo "<pre>";
    //     echo print_r($object->addTag, true));
    //     exit;
    //     return parent::_afterLoad($object);
    // }
}
