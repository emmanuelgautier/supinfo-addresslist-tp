<?php

namespace Entities;

class Address
{
    /**
     * Address Id.
     * 
     * @var integer $id
     */
    protected $id;

    /**
     * Address Street Number.
     * 
     * @var integer $number.
     */
    protected $number;

    /**
     * Address Street Name.
     * 
     * @var string $street.
     */
    protected $street;

    /**
     * Address City Name.
     * 
     * @var string $city
     */
    protected $city;

    /**
     * Entity constructor.
     * 
     * @param  integer  $id
     * @param  integer  $number
     * @param  string   $street
     * @param  string   $city
     * @return \Entities\Address
     */
    public function __construct($id, $number, $street, $city)
    {
        $this->setId($id);
        $this->setNumber($number);
        $this->setStreet($street);
        $this->setCity($city);

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
     * @return \Entities\Address
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }

    /**
     * Street number attribute getter.
     * 
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Street number attribute setter.
     * 
     * @param  integer  $number
     * @return \Entities\Address
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Street name attribute getter.
     * 
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Street name attribute setter.
     * 
     * @param  string  $street
     * @return \Entities\Address
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * City attribute getter.
     * 
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * City attribute setter.
     * 
     * @param  string  $city
     * @return \Entities\Address
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }
}
