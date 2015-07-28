<?php

namespace Entities;

class Person
{
    /**
     * Person Id.
     * 
     * @var integer $id
     */
    protected $id;

    /**
     * Person Firstname.
     * 
     * @var string $firstname.
     */
    protected $firstname;

    /**
     * Person Lastname.
     * 
     * @var string $lastname.
     */
    protected $lastname;

    /**
     * Person Address.
     * 
     * @var \Entities\Address $address
     */
    protected $address;

    /**
     * Entity constructor.
     * 
     * @param  integer  $id
     * @param  string  $lastname
     * @param  string   $street
     * @param  \Entities\Address|null   $address
     * @return \Entities\Person
     */
    public function __construct($id, $firstname, $lastname, Address $address = null)
    {
        $this->setId($id);
        $this->setFirstname($firstname);
        $this->setLastname($lastname);

        if( ! is_null($address))
        {
            $this->setAddress($address);
        }

        return $this;
    }

    /**
     * Id attribute getter.
     * 
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Id attribute setter.
     * 
     * @param  integer  $id
     * @return \Entities\Person
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Firstname attribute getter.
     * 
     * @return integer
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Firstname attribute setter.
     * 
     * @param  string  $firstname
     * @return \Entities\Person
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Lastname attribute getter.
     * 
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Lastname attribute setter.
     * 
     * @param  string  $lastname
     * @return \Entities\Person
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Address attribute getter.
     * 
     * @return \Entities\Address
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Address attribute setter.
     * 
     * @param  \Entities\Address  $address
     * @return \Entities\Person
     */
    public function setAddress(Address $address)
    {
        $this->address = $address;

        return $this;
    }
}
