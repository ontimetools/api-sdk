<?php

namespace OTT\Api\Connection\Adapter;

use OTT\Api\Connection\ConnectionAbstract;
use OTT\Api\Connection\ConnectionRequest;
use OTT\Api\Exception\ConnectionException;

/**
 * This method is used if you want to access datas from an application with no required user login
 * This method require to use the OAuth scheme (with auth code etc.)
 * Class Application
 * @package OTT\Api\Connection
 */
class Application extends ConnectionAbstract
{
    /** @var string */
    private $redirect_uri = null;
    /** @var string */
    private $state = null;
    /** @var string */
    private $authorization_code = null;
    /**  */
    const AUTHCODE_URL = 'auth';

    /**
     * @param  ConnectionRequest   $request
     * @throws ConnectionException
     */
    public function __construct(ConnectionRequest $request)
    {
        parent::__construct($request);
        if (null !== $request->getRedirectUri()) {
            $this->setRedirectUri($request->getRedirectUri());
        } else {
            throw new ConnectionException('Redirect URI undefined');
        }
        $this->setState($request->getState());
    }

    /**
     * To get an authorization code, user must be redirected to this address
     * @return string
     */
    public function requestAuthorizationCodeUrl()
    {
        $otUrl = $this->getOntimeUrl();
        $parameters = [];
        $parameters['response_type'] = 'code';
        $parameters['client_id'] = $this->getClientId();
        $parameters['redirect_uri'] = $this->getRedirectUri();
        if (null !== $this->getScope()) {
            $parameters['scope'] = $this->getScope();
        }
        if (null !== $this->getState()) {
            $parameters['state'] = $this->getState();
        }

        return implode('/', [$otUrl, self::AUTHCODE_URL]).'?'.http_build_query($parameters);
    }

    /**
     * @param  array               $callResult
     * @throws ConnectionException
     */
    private function handleAuthorizationCodeCallback(array $callResult)
    {
        if (isset($callResult['code'])) {
            $this->setAuthorizationCode($callResult['code']);
        } elseif (isset($callResult['error'])) {
            throw new ConnectionException(
                'Auhtorization code not returned with error : '.
                $callResult['error'].' : '.$callResult['error_description'],
                $callResult
            );
        } else {
            throw new ConnectionException('$callResult parameter is not valid');
        }
    }

    /**
     * @param  array               $callResult
     * @return mixed|void
     * @throws ConnectionException
     */
    public function requestToken(array $callResult = [])
    {
        self::handleAuthorizationCodeCallback($callResult);
        $parameters = [];
        $parameters['grant_type'] = 'authorization_code';
        $parameters['code'] = $this->getAuthorizationCode();
        $parameters['redirect_uri'] = $this->getRedirectUri();
        parent::requestToken($parameters);
    }

    /**
     * @return string
     */
    public function getAuthorizationCode()
    {
        return $this->authorization_code;
    }

    /**
     * @param string $authorization_code
     */
    public function setAuthorizationCode($authorization_code)
    {
        $this->authorization_code = $authorization_code;
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
}
