<?php
namespace RookieSoft\CustomerTags\Block\Adminhtml\Order\View;

use RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer\CollectionFactory as GuestCustomerCollectionFactory;
use RookieSoft\CustomerTags\Model\ResourceModel\Tag\CollectionFactory as TagCollectionFactory;
use Magento\Framework\View\Element\Template;
use Magento\Sales\Model\OrderFactory as SalesOrderFactory;

class CustomerTags extends Template
{
    /**
     * construct
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Framework\App\Request\Http              $request
     * @param TagCollectionFactory                             $tagCollectionFactory
     * @param SalesOrderFactory                                $salesFactory
     * @param GuestCustomerCollectionFactory                   $guestCustomerCollectionFactory
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context    $context,
        \Magento\Framework\App\Request\Http                 $request,
        TagCollectionFactory                                $tagCollectionFactory,
        SalesOrderFactory                                   $salesFactory,
        GuestCustomerCollectionFactory                      $guestCustomerCollectionFactory
    )
    {
        $this->guestCustomerCollectionFactory   = $guestCustomerCollectionFactory;
        $this->tagCollectionFactory             = $tagCollectionFactory;
        $this->salesFactory                     = $salesFactory;
        $this->request                          = $request;
        parent::__construct($context);
    }

    /**
     * getEmailAdress
     * @return [string] get the email of the viewed customer
     */
    public function getEmailAdress()
    {
        return $this->salesFactory
            ->create()
            ->load($this->request->getParam('order_id'))
            ->getCustomerEmail();
    }

    /**
     * getTags
     * @param  [string] $email
     * @return [string] get tags and convert the array into string
     */
    public function getTags($email)
    {
        $guestCustomerCollection  = $this->guestCustomerCollectionFactory->create()
            ->addFieldToFilter('email', $email)
            ->load();

        $tagCode = [];

        foreach($guestCustomerCollection as $tag) {

            $tagCollection = $this->tagCollectionFactory
                ->create()
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
     * getView
     * @param  [string] $email
     * @return [string] returns a link to guestcustomer view
     */
    public function getView($email)
    {
        $id = $this->request->getParam('order_id');
        return $this->getUrl('customertags/guestcustomer/view', ['id' => $id]);
    }

}
