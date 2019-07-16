<?php

namespace RookieSoft\CustomerTags\Api;

interface EntityTypeInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID                        = 'id';
    const CODE                      = 'code';
    const TYPE_NAME                 = 'type_name';
    const REFERENCE                 = 'reference';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Code
     *
     * @return string|null
     */
    public function getCode();

    /**
     * Get Type_Name
     *
     * @return string|null
     */
    public function getTypeName();

    /**
     * Get Reference
     *
     * @return string|null
     */
    public function getReference();

    /**
     * Set ID
     *
     * @param int $ID
     * @return $this
     */
    public function setId($id);

    /**
     * Set Code
     *
     * @param string $Code
     * @return $this
     */
    public function setCode($code);

    /**
     * Set Type_Name
     *
     * @param string $Type_Name
     * @return $this
     */
    public function setTypeName($typeName);

    /**
     * Set Reference
     *
     * @param string $Type_Name
     * @return $this
     */
    public function setReference($reference);
}