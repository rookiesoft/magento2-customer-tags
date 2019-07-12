<?php

namespace RookieSoft\CustomerTags\Ui\Component\Listing\Tag\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TCollectionFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;

class Tags extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        TCollectionFactory $tCollectionFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory,
        array $components = [],
        array $data = []

    ) {
        $this->tCollectionFactory           = $tCollectionFactory;
        $this->_guestCustomerCollectionFactory = $guestCustomerCollectionFactory;
        parent::__construct($context, $uiComponentFactory, $components, $data);
    }


    public function prepareDataSource(array $dataSource)
    {
        if(isset($dataSource['data']['items'])) {

            foreach($dataSource['data']['items'] as &$item) {

                $guestCustomerCollection  = $this->_guestCustomerCollectionFactory->create()
                    ->addFieldToFilter('email', $item['customer_email'])
                    ->load();

                $tagCode = [];
                foreach($guestCustomerCollection as $tag) {

                    $tagCollection = $this->tCollectionFactory->create()
                        ->addFieldToFilter('code', $tag->getTagCode())
                        ->load();
                    foreach($tagCollection as $tag) {

                        $tagCode[] = $tag->getLabel();
                    }
                }

                $item['tags'] = implode(', ', $tagCode);
                // echo "<pre>";
                // echo print_r($tagCode, true);
                // exit;
            }
        }
        return $dataSource;
    }

}
