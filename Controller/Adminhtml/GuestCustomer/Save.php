<?php

namespace RookieSoft\CustomerTags\Controller\Adminhtml\GuestCustomer;

use Magento\Framework\EntityManager\EntityManager;
use Magento\Framework\EntityManager\MetadataPool;
use Magento\Framework\Model\AbstractModel;
use Magento\Framework\Model\ResourceModel\Db\Context;
use Magento\Framework\Model\ResourceModel\Db\AbstractDb;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
use Magento\Sales\Model\OrderFactory as SalesOrderFactory;
use RookieSoft\CustomerTags\Model\GuestCustomerFactory as ModelGuestCustomerFactory;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \RookieSoft\CustomerTags\Model\GuestCustomer
     */
    var $guestCustomerFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \RookieSoft\CustomerTags\Model\GuestCustomerFactory $guestCustomerFactory
     */
    public function __construct(
        ModelGuestCustomerFactory $modelGuestCustomerFactory,
        \Magento\Backend\App\Action\Context $context
    ) {
    	$this->modelGuestCustomerFactory = $modelGuestCustomerFactory;
        parent::__construct($context);
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();
        // var_dump($data);

        if (!$data) {
            $this->_redirect('customertags/guestcustomer/addrow');
            return;
        }
        try {
            // $rowData = $this->modelGuestCustomerFactroy->create();
			$rowData = $this->modelGuestCustomerFactory->create();
           	$rowData->setData($data);
           	// echo "<pre>";
           	// echo print_r($data, true);
           	// exit;
           	if(isset($data['entity_id'])) {
           		$rowData->setId($data['entity_id']);
           	}
           	$rowData->save();

    		$this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('customertags/guestcustomer/index');
    }

    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('RookieSoft_CustomerTags::save');
    }
}
