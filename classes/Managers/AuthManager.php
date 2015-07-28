<?php

namespace Managers;

use \PDO;

use Entities\Address;
use Entities\Person;

class AuthManager extends AbstractManager
{
    /**
     * Authenticated user entity.
     * 
     * @var \Entities\Person
     */
    protected $user = null;

    /**
     * Auth Manager bootstrap.
     *
     * @return void
     */
    public function bootstrap()
    {
        if(isset($_SESSION['user']) && ! is_null($_SESSION['user']))
        {
            $this->user = unserialize($_SESSION['user']);
        }
    }

    /**
     * Save user object in session store.
     * 
     * @param  \Entities\Person  $user
     * @return void
     */
    protected function saveUser(Person $user)
    {
        $_SESSION['user'] = serialize($user);
    }

    /**
     * Login function.
     * 
     * @param  string  $username
     * @param  string  $password
     * @return boolean
     */
    public function login($username, $password)
    {
        $username = $this->pdo->quote($username);
        $password = sha1($password);

        $user = $this->pdo->query("SELECT * FROM users WHERE username = {$username}")->fetch();

        if(empty($user))
        {
            return false;
        }

        if($user->password != $password)
        {
            return false;
        }

        $person = $this->pdo->query("SELECT * FROM persons WHERE id = {$user->persons_id}")->fetch();

        if(empty($person))
        {
            return false;
        }

        $personAddress = $this->pdo->query("SELECT * FROM addresses WHERE id = {$person->addresses_id}")->fetch();

        $address = new Address($personAddress->id, $personAddress->number, $personAddress->street, $personAddress->city);

        $this->user = new Person($person->id, $person->firstname, $person->lastname, $address);

        $this->saveUser($this->user);

        return true;
    }

    /**
     * Register function.
     * 
     * @param  string  $username
     * @param  string  $password
     * @param  \Entities\Person  $person
     * @return boolean
     */
    public function register($username, $password, Person $person)
    {
        $username = $this->pdo->quote($username);
        $password = $this->pdo->quote(sha1($password));

        $personId = intval($person->getId());

        $user = $this->pdo->query("SELECT * FROM users WHERE username = {$username}")->fetch();

        if( ! empty($user))
        {
            return false;
        }

        $this->pdo->exec("INSERT INTO users(username, password, persons_id) VALUES({$username}, {$password}, {$personId})");

        return true;
    }

    /**
     * Logout function.
     * 
     * @return void
     */
    public function logout()
    {
        $_SESSION['user'] = $this->user = null;
    }

    /**
     * Authentication checker function.
     * 
     * @return boolean
     */
    public function check()
    {
        return ( ! is_null($this->user));
    }

    /**
     * Authenticated User getter.
     * 
     * @return \Entities\Person|null
     */
    public function user()
    {
        return $this->user;
    }
}
