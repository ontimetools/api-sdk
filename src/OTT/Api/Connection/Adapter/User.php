<?php

namespace OTT\Api\Connection\Adapter;

use OTT\Api\Connection\ConnectionAbstract;
use OTT\Api\Connection\ConnectionRequest;
use OTT\Api\Exception\ConnectionException;

/**
 * This method is used if you want to access datas from an application with user login
 * Allowed actions will depend on user rights
 * Class User
 * @package OTT\Api\Connection
 */
class User extends ConnectionAbstract
{
    /** @var string */
    private $username = null;
    /** @var string */
    private $password = null;

    /**
     * @param  ConnectionRequest   $request
     * @throws ConnectionException
     */
    public function __construct(ConnectionRequest $request)
    {
        parent::__construct($request);
        if (null !== $request->getUsername()) {
            $this->setUsername($request->getUsername());
        } else {
            throw new ConnectionException('Username undefined');
        }
        if (null !== $request->getPassword()) {
            $this->setPassword($request->getPassword());
        } else {
            throw new ConnectionException('Password undefined');
        }
        if (null !== $request->getClientSecret()) {
            $this->setClientSecret($request->getClientSecret());
        } else {
            throw new ConnectionException('Password undefined');
        }
    }

    /**
     * @param  array      $parameters
     * @return mixed|void
     */
    public function requestToken(array $parameters = array())
    {
        $parameters = array();
        $parameters['grant_type'] = 'password';
        $parameters['username'] = $this->getUsername();
        $parameters['password'] = $this->getPassword();
        parent::requestToken($parameters);
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
     */
    public function setPassword($password)
    {
        $this->password = $password;
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
     */
    public function setUsername($username)
    {
        $this->username = $username;
    }
}
