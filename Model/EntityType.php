<?php

namespace RookieSoft\CustomerTags\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \RookieSoft\CustomerTags\Api\EntityTypeInterface;

/**
 * Class File
 * @package RookieSoft\CustomerTags\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class EntityType extends AbstractModel implements EntityTypeInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'rookiesoft_customertags_type';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RookieSoft\CustomerTags\Model\ResourceModel\EntityType');
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
     * Get Code
     *
     * @return string|null
     */
    public function getCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * Get Type Name
     *
     * @return string|null
     */
    public function getTypeName()
    {
        return $this->getData(self::TYPE_NAME);
    }

    /**
     * Get Reference
     *
     * @return string|null
     */
    public function getReference()
    {
        return $this->getData(self::REFERENCE);
    }

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
     * Set Code
     *
     * @param string $code
     * @return $this
     */
    public function setCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * Set Type Name
     *
     * @param string $typeName
     * @return $this
     */
    public function setTypeName($typeName)
    {
        return $this->setData(self::TYPE_NAME, $typeName);
    }

    /**
     * Set Reference
     *
     * @param string $reference
     * @return $this
     */
    public function setReference($reference)
    {
        return $this->setData(self::REFERENCE, $reference);
    }
}
