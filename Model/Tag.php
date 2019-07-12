<?php

namespace RookieSoft\CustomerTags\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \RookieSoft\CustomerTags\Api\TagInterface;

/**
 * Class File
 * @package RookieSoft\CustomerTags\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class Tag extends AbstractModel implements TagInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'rookiesoft_customertags_tag';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RookieSoft\CustomerTags\Model\ResourceModel\Tag');
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
    public function getTagCode()
    {
        return $this->getData(self::CODE);
    }

    /**
     * Get Label
     * 
     * @return string|null
     */
    public function getLabel()
    {
        return $this->getData(self::LABEL);
    }

    /**
     * Get Description
     * 
     * @return string|null
     */
    public function getDescription()
    {
        return $this->getData(self::DESCRIPTION);
    }

    /**
     * Get State
     * 
     * @return int|null
     */
    public function getState()
    {
        return $this->getData(self::STATE);
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
    public function setTagCode($code)
    {
        return $this->setData(self::CODE, $code);
    }

    /**
     * Set Label
     *
     * @param string $label
     * @return $this
     */
    public function setLabel($label)
    {
        return $this->setData(self::LABEL, $label);
    }

    /**
     * set Description
     * 
     * @param string $description
     * @return $this
     */
    public function setDescription($description)
    {
        return $this->setData(self::DESCRIPTION, $description);
    }

    /**
     * Set State
     *
     * @param int $state
     * @return $this
     */
    public function setState($state)
    {
        return $this->setData(self::STATE, $state);
    }
}
