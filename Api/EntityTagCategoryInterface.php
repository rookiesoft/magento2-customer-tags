<?php

namespace RookieSoft\CustomerTags\Api;

interface EntityTagCategoryInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID                        = 'id';
    const ENTITY_ID                 = 'entity_id';
    const ENTITY_TYPE_ID            = 'entity_type_id';
    const TAG_CODE                  = 'tag_code';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Entity_ID
     *
     * @return int|null
     */
    public function getEntityId();

    /**
     * Get Entity_Type_ID
     *
     * @return int|null
     */
    public function getEntityTypeId();

    /**
     * Get Tag_Code
     *
     * @return string|null
     */
    public function getTagCode();

    /**
     * Set ID
     *
     * @param int $ID
     * @return $this
     */
    public function setId($id);

    /**
     * Set Entity_ID
     *
     * @param int $Entity_ID
     * @return $this
     */
    public function setEntityId($entityId);

    /**
     * Set Entity_Type_ID
     *
     * @param int $Entity_Type_ID
     * @return $this
     */
    public function setEntity_Type_ID($entityTypeID);

    /**
     * Set Tag_Code
     *
     * @param string $Tag_Code
     * @return $this
     */
    public function setTag_Code($tagCode);
}