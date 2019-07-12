<?php

namespace RookieSoft\CustomerTags\Ui\Component\Listing\GuestCustomer\Column;

use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Ui\Component\Listing\Columns\Column;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TCollectionFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as SalesOrderCollectionFactory;

class Order extends Column
{
    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        TCollectionFactory $tCollectionFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory,
        SalesOrderCollectionFactory $salesOrderCollectionFactory,
        array $components = [],
        array $data = []

    ) {
        $this->salesOrderCollectionFactory = $salesOrderCollectionFactory;
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

                $orders = [];
                foreach($guestCustomerCollection as $order) {

                    $salesOrder = $this->salesOrderCollectionFactory->create()
                        ->addFieldToFilter('customer_email', $order->getCustomerEmail())
                        ->load();
                    foreach($salesOrder as $order) {
                        $orders[] = $order->getIncrementId();
                    }
                }

                $item['orders'] = implode(', ', $orders);
                // echo "<pre>";
                // echo print_r($item, true);
                // exit;
            }
        }
        return $dataSource;
    }

}
