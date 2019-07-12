<?php

namespace RookieSoft\CustomerTags\Api;

interface GuestCustomerInterface
{
    /**
     * Constants for keys of data array. Identical to the name of the getter in snake case
     */
    const ID                    = 'id';
    const EMAIL                 = 'email';
    const TAGCODE               = 'tag_code';
    // const LASTNAME              = 'lastname';

    /**
     * Get ID
     *
     * @return int|null
     */
    public function getId();

    /**
     * Get Email
     *
     * @return string|null
     */
    public function getEmail();

    /**
     * Get Firstname
     *
     * @return string|null
     */
    public function getTagCode();

    // /**
    //  * Get Lastname
    //  *
    //  * @return string|null
    //  */
    // public function getLastname();

    /**
     * Set ID
     *
     * @param int $ID
     * @return $this
     */
    public function setID($id);

    /**
     * Set Email
     *
     * @param string $Email
     * @return $this
     */
    public function setEmail($email);

    /**
     * Set TagCode
     *
     * @param string $tagcode
     * @return $this
     */
    public function setTagCode($tagcode);
}
