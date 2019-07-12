<?php

namespace RookieSoft\CustomerTags\Controller\Adminhtml\Tags;

use Magento\Framework\Controller\ResultFactory;

class AddRow extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\Registry
     */
    private $coreRegistry;

    /**
     * @var \RookieSoft\CustomerTags\Model\TagFactory
     */
    private $tagFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\Registry $coreRegistry,
     * @param \RookieSoft\CustomerTags\Model\TagFactory $tagFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\Registry $coreRegistry,
        \RookieSoft\CustomerTags\Model\TagFactory $tagFactory
    ) {
        parent::__construct($context);
        $this->coreRegistry = $coreRegistry;
        $this->tagFactory = $tagFactory;
    }

    /**
     * Mapped Tags page.
     * @return \Magento\Backend\Model\View\Result\Page
     */
    public function execute()
    {
        $rowId = (int) $this->getRequest()->getParam('id');
        $rowData = $this->tagFactory->create();
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        if ($rowId) {
            $rowData = $rowData->load($rowId);
            $rowTitle = $rowData->getTitle();
            if (!$rowData->getId()) {
                $this->messageManager->addError(__('row data no longer exist.'));
                $this->_redirect('customertags/tags/rowdata');
                return;
            }
        }

        $this->coreRegistry->register('row_data', $rowData);
        $resultPage = $this->resultFactory->create(ResultFactory::TYPE_PAGE);
        $title = $rowId ? __('Edit Row Data ').$rowTitle : __('Add Row Data');
        $resultPage->getConfig()->getTitle()->prepend($title);
        return $resultPage;
    }

    protected function _isAllowed()
    {
        return $this->_authorization->isAllowed('RookieSoft_CustomerTags::add_row');
    }
}