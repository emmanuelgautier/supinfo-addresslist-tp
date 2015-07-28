<?php

namespace Managers;

use Entities\Address;
use Entities\Person;

use PDO;

class PersonManager extends AbstractManager
{
    /**
     * Create person in database.
     * 
     * @param  \Entities\Person  $person
     * @return void
     */
    public function create(Person &$person)
    {
        $firstname = $this->pdo->quote($person->getFirstname());
        $lastname  = $this->pdo->quote($person->getLastname());

        $addressId = $person->getAddress()->getId();

        $this->pdo->exec("INSERT INTO persons(firstname, lastname, addresses_id) VALUES({$firstname}, {$lastname}, {$addressId})");

        $person->setId($this->pdo->lastInsertId());
    }

    /**
     * Update one person in database.
     * 
     * @param  integer  $id
     * @param  \Entities\Person  $person
     * @return void
     */
    public function update($id, Person $person)
    {
        $id = intval($id);

        $firstname = $this->pdo->quote($person->getFirstname());
        $lastname  = $this->pdo->quote($person->getLastname());

        $this->pdo->exec("UPDATE persons SET firstname = {$firstname}, lastname = {$lastname} WHERE id = {$id}");
    }

    /**
     * Find one person in database.
     * 
     * @param  integer  $id
     * @return \Entities\Person
     */
    public function find($id)
    {
        $id = intval($id);

        $person = $this->pdo->query("SELECT * FROM persons WHERE id = {$id}")->fetch();

        $personEntity = new Person($person->id, $person->firstname, $person->lastname);

        return $personEntity;
    }

    /**
     * Find all persons with addresses in database.
     *
     * @return array
     */
    public function findAll()
    {
        $persons = $this->pdo->query("SELECT * FROM persons")->fetchAll();

        if(count($persons) === 0)
        {
            return $persons;
        }

        $addressesId = [];
        foreach($persons as $person)
        {
            $addressesId[] = $person->addresses_id;
        }

        $addressesIdList = implode(',', $addressesId);

        $addresses = $this->pdo->query("SELECT * FROM addresses WHERE id IN ({$addressesIdList})")->fetchAll(PDO::FETCH_ASSOC);
        $addressesDbId = array_column($addresses, 'id');

        $personEntities = [];
        foreach($persons as $person)
        {
            $addressEntity = null;

            if(in_array($person->addresses_id, $addressesDbId))
            {
                $address = $addresses[array_search($person->addresses_id, $addressesDbId)];

                $addressEntity = new Address($address['id'], $address['number'], $address['street'], $address['city']);
            }

            $personEntities[] = new Person($person->id, $person->firstname, $person->lastname, $addressEntity);
        }

        return $personEntities;
    }

    /**
     * Delete one person from database.
     * 
     * @param  integer  $id
     * @return void
     */
    public function delete($id)
    {
        $id = intval($id);

        // retrieve person's address
        $person = $this->pdo->query("SELECT addresses_id FROM persons WHERE id = {$id}")->fetch();

        if(empty($person))
        {
            return;
        }

        $addressId = $person->addresses_id;

        $this->pdo->exec("DELETE FROM persons WHERE id = {$id}");
        $this->pdo->exec("DELETE FROM addresses WHERE id = {$addressId}");
    }
}
