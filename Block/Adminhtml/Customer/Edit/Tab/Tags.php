<?php
namespace RookieSoft\CustomerTags\Block\Adminhtml\Customer\Edit\Tab;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Ui\Component\Layout\Tabs\TabInterface;
use Magento\Sales\Model\ResourceModel\Order\CollectionFactory as SalesOrderCollectionFactory;
// use Magento\Sales\Model\OrderFactory as SalesOrderFactory
use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
use Magento\Sales\Model\OrderFactory as SalesOrderFactory;
use RookieSoft\CustomerTags\Model\TagFactory as TagFactory;
use RookieSoft\CustomerTags\Model\GuestCustomerFactory as GuestCustomerFactory;
use Magento\Framework\Pricing\PriceCurrencyInterface;
use Magento\Customer\Model\ResourceModel\Customer\CollectionFactory as CustomerCollectionFactory;

class Tags extends \Magento\Framework\View\Element\Template implements TabInterface
{

    protected $_template = 'tab/view.phtml';
    /**
     * Core registry
     *
     * @var \Magento\Framework\Registry
     */
    protected $_coreRegistry;
    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param array $data
     */

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        //\Magento\Framework\App\Request\Http $request,
        //\Magento\Framework\View\Element\Template\Context $context,
        \Magento\Framework\App\Request\Http $request,
        SalesOrderFactory $salesFactory,
        TagFactory $tagFactory,
        GuestCustomerFactory $guestCustomerFactory,
        PriceCurrencyInterface $priceFormatter,
        SalesOrderCollectionFactory $salesOrderCollectionFactory,
        TagCollectionFactory $tagCollectionFactory,
        GuestCustomerCollectionFactory $guestCustomerCollectionFactory,
        CustomerCollectionFactory $customerCollectionFactory,
        array $data = []
    ) {
        $this->guestCustomerCollectionFactory = $guestCustomerCollectionFactory;
        $this->salesFactory = $salesFactory;
        $this->tagCollectionFactory =$tagCollectionFactory;
        $this->salesOrderCollectionFactory = $salesOrderCollectionFactory;
        $this->request = $request;
        $this->guestCustomerFactory = $guestCustomerFactory;
        $this->tagFactory = $tagFactory;
        $this->priceFormatter = $priceFormatter;
        $this->_coreRegistry = $registry;
        $this->customerCollectionFactory = $customerCollectionFactory;
        parent::__construct($context, $data);
    }

    /**
     * @return string|null
     */
    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
    }
    public function getEmailAdress()
    {
        $select = $this->customerCollectionFactory->create()->addFieldToFilter('entity_id' , $this->getCustomerId());
        $email = [];
        foreach($select as $customer){
            $email[] = $customer['email'];
        }

        return implode($email);
    }

    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabLabel()
    {
        return __('Customer Tags');
    }
    /**
     * @return \Magento\Framework\Phrase
     */
    public function getTabTitle()
    {
        return __('Customer Tags');
    }
    /**
     * @return bool
     */
    public function canShowTab()
    {
        if ($this->getCustomerId()) {
            return true;
        }
        return false;
    }

    /**
     * @return bool
     */
    public function isHidden()
    {
        if ($this->getCustomerId()) {
            return false;
        }
        return true;
    }
    /**
     * Tab class getter
     *
     * @return string
     */
    public function getTabClass()
    {
        return '';
    }
    /**
     * Return URL link to Tab content
     *
     * @return string
     */
    public function getTabUrl()
    {
        //$id = $this->getCustomerId();
        // return $this->getUrl('tags/*/tags', ['_current' => true]);
        //return $this->getUrl('tags/guestcustomer/view', ['id' => $this->getCustomerId()]);
        return '';
        // return $this->getUrl('tags/tags/addrow', ['_current' => true]);
    }
    /**
     * Tab should be loaded trough Ajax call
     *
     * @return bool
     */
    public function isAjaxLoaded()
    {
        return false;
    }



    // /**
    //  * getOrderEntityId
    //  * @return [string] get row id
    //  */
    // private function getOrderEntityId()
    // {

    //     if(!$this->orderEntityId) {
    //         $this->orderEntityId = $this->request->getParam('id');
    //     }
    //     return $this->orderEntityId;
    // }

    // /**
    //  * getEmailAdress
    //  * @return [string] get email adress of row
    //  */
    // public function getEmailAdress()
    // {
    //     return $this->salesFactory
    //         ->create()
    //         ->load($this->getCustomerId())
    //         ->getCustomerEmail();
    // }

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