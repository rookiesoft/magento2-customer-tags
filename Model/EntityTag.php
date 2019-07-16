<?php

namespace RookieSoft\CustomerTags\Model;

use \Magento\Framework\Model\AbstractModel;
use \Magento\Framework\DataObject\IdentityInterface;
use \RookieSoft\CustomerTags\Api\EntityTagInterface;

/**
 * Class File
 * @package RookieSoft\CustomerTags\Model
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class EntityTag extends AbstractModel implements EntityTagInterface, IdentityInterface
{
    /**
     * Cache tag
     */
    const CACHE_TAG = 'rookiesoft_customertags_entity_tag';

    /**
     * Post Initialization
     * @return void
     */
    protected function _construct()
    {
        $this->_init('RookieSoft\CustomerTags\Model\ResourceModel\EntityTag');
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
     * Get Entity Id
     *
     * @return int|null
     */
    public function getEntityId()
    {
        return $this->getData(self::ENTITY_ID);
    }

    /**
     * Get Entity Type Id
     *
     * @return int|null
     */
    public function getEntityTypeId()
    {
        return $this->getData(self::ENTITY_TYPE_ID);
    }

    /**
     * Get Tag Code
     *
     * @return string|null
     */
    public function getTagCode()
    {
        return $this->getData(self::TAG_CODE);
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
     * Set Entity Id
     *
     * @param int $entitiyId
     * @return $this
     */
    public function setEntityId($entityId)
    {
        return $this->setData(self::ENTITY_ID, $entityId);
    }

    /**
     * Set Entity Type Id
     *
     * @param int $entityTypeId
     * @return $this
     */
    public function setEntity_Type_ID($entityTypeID)
    {
        return $this->setData(self::ENTITY_TYPE_ID, $entityTypeId);
    }

    /**
     * Set Tag Code
     *
     * @param string $tagCode
     * @return $this
     */
    public function setTag_Code($tagCode)
    {
        return $this->setData(self::TAG_CODE, $tagCode);
    }
}
