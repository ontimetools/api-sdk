<?php

namespace OTT\Api\Connection;

/**
 * Class ConnectionRequest
 * @package OTT\Api\Connection
 */
final class ConnectionRequest
{
    /**
     * Common parameters used for connection
     */
    /** @var string */
    private $ontime_url = null;
    /** @var string */
    private $api_version = 'v2';
    /** @var string */
    private $client_id = null;
    /** @var string */
    private $client_secret = null;
    /** @var string */
    private $scope = null;
    /** @var string */
    private $saved_token = null;
    /**
     * Parameters used for User type of connection
     */
    /** @var string */
    private $username = null;
    /** @var string */
    private $password = null;
    /**
     * Parameters used for Application type of connection
     */
    /** @var string */
    private $redirect_uri = null;
    /** @var string */
    private $state = null;

    /**
     * @return string
     */
    public function getApiVersion()
    {
        return $this->api_version;
    }

    /**
     * @param string $api_version
     */
    public function setApiVersion($api_version)
    {
        $this->api_version = $api_version;
    }

    /**
     * @return string
     */
    public function getClientId()
    {
        return $this->client_id;
    }

    /**
     * @param string $client_id
     */
    public function setClientId($client_id)
    {
        $this->client_id = $client_id;
    }

    /**
     * @return string
     */
    public function getClientSecret()
    {
        return $this->client_secret;
    }

    /**
     * @param string $client_secret
     */
    public function setClientSecret($client_secret)
    {
        $this->client_secret = $client_secret;
    }

    /**
     * @return string
     */
    public function getOntimeUrl()
    {
        return $this->ontime_url;
    }

    /**
     * @param string $ontime_url
     */
    public function setOntimeUrl($ontime_url)
    {
        $this->ontime_url = $ontime_url;
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
    public function getRedirectUri()
    {
        return $this->redirect_uri;
    }

    /**
     * @param string $redirect_uri
     */
    public function setRedirectUri($redirect_uri)
    {
        $this->redirect_uri = $redirect_uri;
    }

    /**
     * @return string
     */
    public function getSavedToken()
    {
        return $this->saved_token;
    }

    /**
     * @param string $saved_token
     */
    public function setSavedToken($saved_token)
    {
        $this->saved_token = $saved_token;
    }

    /**
     * @return string
     */
    public function getScope()
    {
        return $this->scope;
    }

    /**
     * @param string $scope
     */
    public function setScope($scope)
    {
        $this->scope = $scope;
    }

    /**
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
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
