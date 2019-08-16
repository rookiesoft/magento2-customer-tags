<?php
/**
 * @todo get id from sales order load email compare email with guest customer get 
 * entity id compare with entity id and customer is guest from entity tag and load 
 * tag code compare with tags and setData for preload
 */
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
        $this->customerCollectionFactory = $salesOrderCollectionFactory->create();
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
            // echo "<pre>";
            // echo print_r($tagCodes->toArray(), true);
            // exit;
            foreach($tagCodes->getItems() as $data){
                $tagIds = $this->tagCollectionFactory
                ->create()
                ->addFieldToFilter(
                    'code' , $data->getTagCode()
                );
                
	            // error_log(print_r($tagIds, true));
                foreach($tagIds->getItems() as $items){
                    $tagId[] = $items->getId();

                    
                }
                // echo "<pre>";
                
                // exit;
            }
            
            $email->setTag($tagId);
            // echo "<pre>";
            // echo print_r($email->getData(), true);
            // exit;
            $this->_loadedData[$email->getId()] = $email->getData();
        }
        // echo "<pre>";
        // echo print_r($this->_loadedData);
        // exit;
        return $this->_loadedData;
    }
}
