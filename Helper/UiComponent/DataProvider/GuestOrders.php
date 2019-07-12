<?php

namespace RookieSoft\CustomerTags\Helper\UiComponent\DataProvider;

use Magento\Sales\Model\ResourceModel\Order\CollectionFactory;
use Magento\Ui\DataProvider\AbstractDataProvider;
use Magento\Framework\App\ResourceConnection;

class GuestOrders extends AbstractDataProvider
{
    protected $_resource;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        ResourceConnection $resource,
        CollectionFactory $salesOrderCollectionFactory,
        array $meta = [],
        array $data = []
    ) {
        $this->_resource        = $resource;
        $this->name = $name;
        $this->primaryFieldName = $primaryFieldName;
        $this->requestFieldName = $requestFieldName;
        $this->collection = $salesOrderCollectionFactory
            ->create()
            ->addFieldToFilter(
                'customer_is_guest',
                ['eq' => 1]
            )
            ->addExpressionFieldToSelect(
                'count_orders',
                'COUNT({{increment_id}})',
                'increment_id'
            );
        $this->collection->getSelect()->group('customer_email');
        $this->collection->addAddressFields();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * @return void
     */
    protected function prepareUpdateUrl()
    {

        if (!isset($this->data['config']['filter_url_params'])) {
            return;
        }
        foreach ($this->data['config']['filter_url_params'] as $paramName => $paramValue) {
            if ('*' == $paramValue) {
                $paramValue = $this->request->getParam($paramName);
            }
            if ($paramValue) {
                $this->data['config']['update_url'] = sprintf(
                    '%s%s/%s/',
                    $this->data['config']['update_url'],
                    $paramName,
                    $paramValue
                );
                // $this->addFilter(
                //     $this->filterBuilder->setField($paramName)->setValue($paramValue)->setConditionType('eq')->create()
                // );
            }
        }
    }

}