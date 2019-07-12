<?php

namespace RookieSoft\CustomerTags\Block\Adminhtml\GuestCustomer;

use Magento\Framework\View\Element\Template;

// use Magento\Backend\Block\Template;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as SalesOrderCollectionFactory;
// use Magento\Sales\Model\OrderFactory as SalesOrderFactory
use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
use Magento\Sales\Model\OrderFactory as SalesOrderFactory;
use RookieSoft\CustomerTags\Model\TagFactory as TagFactory;
use RookieSoft\CustomerTags\Model\GuestCustomerFactory as GuestCustomerFactory;
use Magento\Framework\Pricing\PriceCurrencyInterface;

class View extends Template
{

    private $orderEntityId = null;

    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        SalesOrderFactory $salesFactory,
        TagFactory $tagFactory,
        GuestCustomerFactory $guestCustomerFactory,
        PriceCurrencyInterface $priceFormatter,
        SalesOrderCollectionFactory $salesOrderCollectionFactory,
        TagCollectionFactory $tagCollectionFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory
    )
    {
        $this->guestCustomerCollectionFactory = $guestCustomerCollectionFactory;
        $this->salesFactory = $salesFactory;
        $this->tagCollectionFactory =$tagCollectionFactory;
        $this->salesOrderCollectionFactory = $salesOrderCollectionFactory;
        $this->request = $request;
        $this->guestCustomerFactory = $guestCustomerFactory;
        $this->tagFactory = $tagFactory;
        $this->priceFormatter = $priceFormatter;
        parent::__construct($context);

    }

    /**
     * getOrderEntityId
     * @return [string] get row id
     */
    private function getOrderEntityId()
    {

        if(!$this->orderEntityId) {
            $this->orderEntityId = $this->request->getParam('id');
        }
        return $this->orderEntityId;
    }

    /**
     * getEmailAdress
     * @return [string] get email adress of row
     */
    public function getEmailAdress()
    {
        return $this->salesFactory
            ->create()
            ->load($this->getOrderEntityId())
            ->getCustomerEmail();
    }

    /**
     * getTags
     * @return [string] get all tags and implode them into a string
     */
    public function getTags()
    {
        $guestCustomerCollection  = $this->guestCustomerCollectionFactory->create()
                    ->addFieldToFilter('email', $this->getEmailAdress())
                    ->load();

                $tagCode = [];

                foreach($guestCustomerCollection as $tag) {

                    $tagCollection = $this->tagCollectionFactory->create()
                        ->addFieldToFilter('code', $tag->getTagCode())
                        ->load();
                    foreach($tagCollection as $tag) {

                        $tagCode[] = $tag->getLabel();
                    }
                }

                $tags = implode(', ', $tagCode);

        return $tags;
    }

    /**
     * getBaseGrandTotal
     * @return [double] get sum of prices
     */
    public function getBaseGrandTotal()
    {
        $prices = $this->salesOrderCollectionFactory->create()
                        ->addFieldToFilter(
                            'customer_email',
                            ['eq' => $this->getEmailAdress()]);
            $sum = [];

        foreach($prices as $price){
            $sum[] = $price->getBaseGrandTotal();
        }
        return array_sum($sum);
    }

    /**
     * getPrice
     * @return [string] formates the price and adds euro sign
     */
    public function getPrice()
    {
        $currencyCode = isset($item['order_currency_code']) ? $item['order_currency_code'] : null;
        $e = $this->priceFormatter->format(
                $this->getBaseGrandTotal(),
                false,
                null,
                null,
                $currencyCode
            );
        return $e;
    }

    /**
     * sumOrders
     * @return [integer] counts all orders
     */
    public function sumOrders()
    {
        $orders = $this->salesOrderCollectionFactory->create()
                        ->addFieldToFilter(
                            'customer_email',
                            ['eq' => $this->getEmailAdress()]);
        $count = [];

        foreach($orders as $order){
            $count[] = $order->getIncrementId();
        }
        return count($count);
    }
}
