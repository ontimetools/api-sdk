<?php

namespace OTT\Api\Connection;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Message\Response;
use OTT\Api\Exception\ConnectionException;
use OTT\Api\Exception\ExceptionAbstract;

/**
 * Class ConnectionAbstract
 * @package OTT\Api\Connection
 */
abstract class ConnectionAbstract
{
    /** @var Client */
    protected $http_client = null;
    /** @var string */
    protected $ontime_url = null;
    /** @var string */
    protected $ontime_api_url = null;
    /** @var string */
    protected $api_version = null;
    /** @var string */
    protected $client_id = null;
    /** @var string */
    private $client_secret = null;
    /** @var string */
    protected $scope = null;
    /** @var string */
    protected $token = null;
    /**  */
    const TOKEN_URL = 'api/oauth2/token';

    /**
     * @param  ConnectionRequest $request
     * @throws ConnectionException
     */
    public function __construct(ConnectionRequest $request)
    {
        if (null !== $request->getOntimeUrl()) {
            $this->setOntimeUrl($request->getOntimeUrl());
        } else {
            throw new ConnectionException('OnTime URL undefined');
        }
        if (null !== $request->getApiVersion()) {
            $this->setApiVersion($request->getApiVersion());
        } else {
            throw new ConnectionException('API version undefined');
        }
        $this->setOntimeApiUrl($this->getOntimeUrl() . 'api/' . $this->getApiVersion() . '/');
        if (null !== $request->getClientId()) {
            $this->setClientId($request->getClientId());
        } else {
            throw new ConnectionException('Client ID undefined');
        }
        $this->setScope($request->getScope());
        $this->setHttpClient(
            new Client(['base_url' => $this->getOntimeApiUrl()])
        );
    }

    /**
     * @param  array $parameters
     * @throws ConnectionException
     */
    public function requestToken(array $parameters = [])
    {
        if (!isset($parameters['grant_type'])) {
            throw new ConnectionException('grant_type undefined');
        }
        $parameters['client_id'] = $this->getClientId();
        $parameters['client_secret'] = $this->getClientSecret();
        if (null !== $this->getScope()) {
            $parameters['scope'] = $this->getScope();
        }
        /** @var Response $response */
        try {
            $response = $this->getHttpClient()->get(
                $this->getOntimeUrl() . self::TOKEN_URL,
                ['query' => $parameters]
            );
            if ($response->getStatusCode() === 200) {
                $result = $response->json();
                if (isset($result['access_token'])) {
                    $this->setToken($result['access_token']);
                } else {
                    throw new ConnectionException(
                        'Error while trying to get token. ' .
                        $result['error'] . ' : ' . $result['error_description'],
                        $result
                    );
                }
            }
        } catch (ClientException $e) {
            throw new ConnectionException(
                'Bad request : ' . ExceptionAbstract::formatBadResponse($e),
                ExceptionAbstract::getBadResponseResult($e)
            );
        }
    }

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
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->http_client;
    }

    /**
     * @param Client $http_client
     */
    public function setHttpClient($http_client)
    {
        $this->http_client = $http_client;
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
    public function getOntimeApiUrl()
    {
        return $this->ontime_api_url;
    }

    /**
     * @param string $ontime_api_url
     */
    public function setOntimeApiUrl($ontime_api_url)
    {
        $this->ontime_api_url = $ontime_api_url;
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
    public function getToken()
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }
}
