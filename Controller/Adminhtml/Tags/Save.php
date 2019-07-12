<?php

namespace RookieSoft\CustomerTags\Controller\Adminhtml\Tags;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \RookieSoft\CustomerTags\Model\TagFactory
     */
    var $tagFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \RookieSoft\CustomerTags\Model\TagFactory $tagFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \RookieSoft\CustomerTags\Model\TagFactory $tagFactory
    ) {
        parent::__construct($context);
        $this->tagFactory = $tagFactory;
    }

    /**
     * @SuppressWarnings(PHPMD.CyclomaticComplexity)
     * @SuppressWarnings(PHPMD.NPathComplexity)
     */
    public function execute()
    {
        $data = $this->getRequest()->getPostValue();

        if (!$data) {
            $this->_redirect('customertags/tags/addrow');
            return;
        }
        // echo "<pre>";
        // echo print_r($data, true);
        // exit;
        try {
            $rowData = $this->tagFactory->create();

            if (isset($data['id'])) {
                $rowData->load($data['id']);
            }
            $rowData->setData($data);

            // echo '<pre>';
            // print_r($rowData->toArray());
            // exit;

            $rowData->save();

            $this->messageManager->addSuccess(__('Row data has been successfully saved.'));
        } catch (\Exception $e) {
            $this->messageManager->addError(__($e->getMessage()));
        }
        $this->_redirect('customertags/tags/index');
    }
    /*
    $Tag = Mage::getModel('tags/tag');

    if( $id ) {
        $Tag->load( $id );
    }

    $Tag->setData($dataFromServerRequest)
        ->save();
      */
    /**
     * @return bool
     */
    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('RookieSoft_CustomerTags::save');
    }
}
