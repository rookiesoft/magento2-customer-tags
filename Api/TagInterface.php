<?php

namespace RookieSoft\CustomerTags\Api;

interface TagInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID                    = 'id';
    const CODE                  = 'code';
    const LABEL                 = 'label';
    const DESCRIPTION           = 'description';
    const STATE                 = 'state';

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
    public function getTagCode();

    /**
     * Get Label
     *
     * @return string|null
     */
    public function getLabel();

    /**
     * Get Description
     *
     * @return string|null
     */
    public function getDescription();

    /**
     * Get State
     *
     * @return int|null
     */
    public function getState();

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
    public function setTagCode($code);

    /**
     * Set Label
     *
     * @param string $Label
     * @return $this
     */
    public function setLabel($label);

    /**
     * Set Description
     *
     * @param string $Description
     * @return $this
     */
    public function setDescription($description);

    /**
     * Set State
     *
     * @param int $State
     * @return $this
     */
    public function setState($state);
}