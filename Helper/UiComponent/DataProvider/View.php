<?php

namespace RookieSoft\CustomerTags\Helper\UiComponent\DataProvider;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\ResourceConnection;
use RookieSoft\CustomerTags\Model\GuestCustomerFactory;
use Magento\Framework\UrlInterface;

use Magento\Framework\Api\FilterBuilder;
use Magento\Framework\Api\Search\ReportingInterface;
use Magento\Framework\Api\Search\SearchCriteria;
use Magento\Framework\Api\Search\SearchCriteriaBuilder;
use Magento\Framework\Api\Search\SearchResultInterface;
use Magento\Framework\App\RequestInterface;
use Magento\Sales\Model\OrderFactory as SalesOrderFactory;

class View extends /*\Magento\Framework\View\Element\UiComponent\DataProvider\DataProvider*/ AbstractDataProvider
{
    protected $_resource;
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ResourceConnection $resource,
        CollectionFactory $salesOrderCollectionFactory,
        SalesOrderFactory $salesOrderFactory,
        \Magento\Framework\App\Request\Http $request,
        GuestCustomerFactory $guestCustomerFactory,
        RequestInterface $requestInterface,
        array $meta = [],
        array $data = []
    ) {
        $this->requestInterface = $requestInterface;
        $this->_resource        = $resource;
        $this->name = $name;
        $this->primaryFieldName = $primaryFieldName;
        $this->requestFieldName = $requestFieldName;
        $this->request = $request;
        $this->_salesOrderFactory = $salesOrderFactory;
        $this->guestCustomerFactory = $guestCustomerFactory;
        $id = $this->request->getParam('id');

    	parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);

        $this->collection = $salesOrderCollectionFactory->create()->addFieldToFilter(
            'customer_email',
            ['eq' => $this->getEmail($id)]
        )->load();

        $this->prepareUpdateUrl();

    }

    protected function prepareUpdateUrl()
    {
        if (!isset($this->data['config']['filter_url_params'])) {
            return;
        }

        foreach ($this->data['config']['filter_url_params']
                 as $paramName => $paramValue) {
            if ('*' == $paramValue && $paramName == 'entity_id') {
                $paramValue = $this->request->getParam('id');
            }
            if (substr($paramValue, 0, 1) == '0') { // already an increment_id
                parent::prepareUpdateUrl();
                return;
            }
            if ($paramValue) {
                $this->data['config']['update_url'] = sprintf(
                    '%s%s/%s/',
                    $this->data['config']['update_url'],
                    ($paramName == 'entity_id' ? 'id' : $paramName),
                    $paramValue
                );
            }
        }
    }
    protected function getEmail($id)
    {
        return $this->_salesOrderFactory
            ->create()
            ->load($id)
            ->getCustomerEmail();
    }


    // public function getOrder($entityId)
    // {
    	// error_log(print_r('expression'));
       // $this->collection->addFieldToFilter(
       //              'entity_id',
       //              ['eq' =>$entityId]
       //          )->load();
//        error_log(print_r($this->collection->addFieldToFilter(
//                     'entity_id',
//                     ['eq' =>$entityId]
//                 )->load(), true));
// echo "<pre>";
// echo print_r($this->collection->addFieldToFilter(
//                     'entity_id',
//                     ['eq' =>$entityId]
//                 )->load(), true);
// exit;
    //         $this->collection->getSelect()->group('customer_email');
    //         $this->collection->addAddressFields();
    // }
}
