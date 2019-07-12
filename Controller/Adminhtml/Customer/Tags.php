<?php

namespace RookieSoft\CustomerTags\Controller\Adminhtml\Customer;

class Tags extends \Magento\Customer\Controller\Adminhtml\Index
{
    /**
     * Customer compare grid
     *
     * @return \Magento\Framework\View\Result\Layout
     */
    public function execute()
    {

        $this->initCurrentCustomer();
        $resultLayout = $this->resultLayoutFactory->create();
        return $resultLayout;
    }


}