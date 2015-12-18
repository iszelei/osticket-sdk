<?php

namespace Iszelei\OsTicketSDK;

/**
 * Class Staff
 * @package Iszelei\OsTicketSDK
 */
class Staff {

    /**
     * @var string
     */
    protected $username;
    /**
     * @var string
     */
    protected $password;

    /**
     * Staff constructor.
     * @param string $username
     * @param string $password
     */
    public function __construct($username, $password)
    {
        $this->setUsername($username)
            ->setPassword($password);
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @param string $username
     * @return Staff $this
     */
    private function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param string $password
     * @return Staff $this
     */
    private function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return array
     */
    public function getCredentialArray()
    {
        return [
            'username' => $this->getUsername(),
            'password' => $this->getPassword()
        ];
    }

}