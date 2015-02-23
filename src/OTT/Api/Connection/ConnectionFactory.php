<?php

namespace OTT\Api\Connection;

use OTT\Api\Exception\ConnectionException;

/**
 * Class ConnectionFactory
 * @package OTT\Api\Connection
 */
class ConnectionFactory
{
    /** @var array */
    protected static $instances = [];
    /** @var string */
    protected $adapter;

    /** Connection types */
    const CT_APP = 'Application';
    const CT_USR = 'User';

    /**
     * @param $pAdapter
     * @param  ConnectionRequest   $request
     * @return ConnectionAbstract
     * @throws ConnectionException
     */
    public static function getInstance($pAdapter, ConnectionRequest $request)
    {
        if (!in_array($pAdapter, self::$instances)) {
            $adapter = '\\OTT\\Api\\Connection\\Adapter\\'.$pAdapter;
            if (!class_exists($adapter)) {
                throw new ConnectionException('Class '.$pAdapter.' not found.');
            }
            self::$instances[$pAdapter] = (new \ReflectionClass($adapter))->newInstance($request);
        }

        return self::$instances[$pAdapter];
    }

    /**
     * @param  ConnectionRequest       $request
     * @return null|ConnectionAbstract
     * @throws ConnectionException
     */
    public static function getConnection(ConnectionRequest $request)
    {
        $result = null;
        if (null === $request->getOntimeUrl()) {
            throw new ConnectionException('No OnTime URL specified');
        }
        $connectionType = null;
        if (
            null !== $request->getClientId() &&
            null !== $request->getRedirectUri()
        ) {
            $connectionType = self::CT_APP;
        } elseif (
            null !== $request->getUsername() &&
            null !== $request->getPassword() &&
            null !== $request->getClientId() &&
            null !== $request->getClientSecret()
        ) {
            $connectionType = self::CT_USR;
        }
        if (null !== $connectionType) {
            $result = self::getInstance($connectionType, $request);
        } else {
            throw new ConnectionException('Connection type not found because of wrong parameters');
        }

        return $result;
    }
}
