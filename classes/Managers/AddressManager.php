<?php

namespace Managers;

use Entities\Address;

class AddressManager extends AbstractManager
{
    /**
     * Create address in database.
     * 
     * @param  \Entities\Address  $address
     * @return void
     */
    public function create(Address &$address)
    {
        $number = $this->pdo->quote($address->getNumber());
        $street = $this->pdo->quote($address->getStreet());
        $city   = $this->pdo->quote($address->getCity());

        $this->pdo->exec("INSERT INTO addresses(number, street, city) VALUES({$number}, {$street}, {$city})");

        $address->setId($this->pdo->lastInsertId());
    }
}
