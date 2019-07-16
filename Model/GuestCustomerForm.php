<?php

namespace RookieSoft\CustomerTags\Model;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\ResourceConnection;
use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;

class GuestCustomerForm extends AbstractDataProvider
{
    protected $_loadedData;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ResourceConnection $resource,
        CollectionFactory $salesOrderCollectionFactory,
        CustomerCollectionFactory $customerCollectionFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory,
        TagCollectionFactory $tagCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $salesOrderCollectionFactory->create();
        $this->customerCollectionFactory = $customerCollectionFactory->create();
        $this->guestCustomerCollectionFactory = $guestCustomerCollectionFactory;
        $this->tagCollectionFactory = $tagCollectionFactory;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->_loadedData)) {
            return $this->_loadedData;
        }
        $items = $this->collection->getItems();
        $customeritems = $this->customerCollectionFactory->getItems();

        foreach ($customeritems as $email) {
            //$result['customer_email']  = $email->getData();

            //get all tags for mail address, typecast to STRING into Array
            $tagCodes = $this->guestCustomerCollectionFactory
                ->create()
                ->addFieldToFilter(
                    'email',$email->getEmail()
                    // 'email',$email->getCustomerEmail()
                );
            $tagId = [];
            foreach($tagCodes->getItems() as $data){
                $tagIds = $this->tagCollectionFactory
                ->create()
                ->addFieldToFilter(
                    'code' , $data->getTagCode()
                );
                foreach($tagIds->getItems() as $items){
                    $tagId[] = $items->getId();
                }
            }
            $email->setTag($tagId);
            $this->_loadedData[$email->getId()] = $email->getData();

        }
        // echo "<pre>";
        // echo print_r($this->_loadedData);
        // exit;
        return $this->_loadedData;
    }
}