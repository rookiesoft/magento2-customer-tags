<?php

namespace RookieSoft\CustomerTags\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \RookieSoft\CustomerTags\Api\GuestCustomerInterface;

/**
 * Class File
 * @package RookieSoft\CustomerTags\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class GuestCustomer extends AbstractModel implements GuestCustomerInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'rookiesoft_customertags_guest_customer';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RookieSoft\CustomerTags\Model\ResourceModel\GuestCustomer');
    }

    /**
     * Get Id
     *
     * @return int|null
     */
    public function getId()
    {
        return $this->getData(self::ID);
    }

    /**
     * Get Email
     * 
     * @return string|null
     */
    public function getEmail()
    {
        return $this->getData(self::EMAIL);
    }

    /**
     * Get TagCode
     * 
     * @return string|null
     */
    public function getTagCode()
    {
        return $this->getData(self::TAGCODE);
    }

    // /**
    //  * Get Lastname
    //  * 
    //  * @return string|null
    //  */
    // public function getLastname()
    // {
    //     return $this->getData(self::LASTNAME);
    // }

    /**
     * Return identities
     * @return string[]
     */
    public function getIdentities()
    {
        return [self::CACHE_TAG . '_' . $this->getId()];
    }

    /**
     * Set Id
     *
     * @param int $id
     * @return $this
     */
    public function setId($id)
    {
        return $this->setData(self::ID, $id);
    }

    /**
     * Set Email
     *
     * @param string $email
     * @return $this
     */
    public function setEmail($email)
    {
        return $this->setData(self::EMAIL, $email);
    }

    /**
     * Set TagCode
     *
     * @param string $tagcode
     * @return $this
     */
    public function setTagCode($tagcode)
    {
        return $this->setData(self::TAGCODE, $tagcode);
    }

    // /**
    //  * Set Lastname
    //  *
    //  * @param string $lastname
    //  * @return $this
    //  */
    // public function setLastname($lastname)
    // {
    //     return $this->setData(self::LASTNAME, $lastname);
    // }
}
