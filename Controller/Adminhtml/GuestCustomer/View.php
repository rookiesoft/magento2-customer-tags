<?php

namespace RookieSoft\CustomerTags\Controller\Adminhtml\GuestCustomer;

use Magento\Framework\Controller\ResultFactory;
// use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;

class View extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * Constructor
     *

     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        // \Magento\Framework\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    public function execute()
    {
        // echo '<pre>';
        // echo print_r($this->getRequest()->getParam('id'),true);
        // exit();
        return $this->resultPageFactory->create();
    }
}
