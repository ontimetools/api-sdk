<?php

namespace OTT\Api\Exception;

use GuzzleHttp\Exception\BadResponseException;

/**
 * Class ExceptionAbstract
 * @package OTT\Api\Exception
 */
abstract class ExceptionAbstract extends \Exception
{
    /** @var mixed|null */
    protected $result = null;

    /**
     * @param string $message
     * @param null $result
     */
    public function __construct($message, $result = null)
    {
        parent::__construct($message);
        $this->setResult($result);
    }

    /**
     * @param BadResponseException $e
     * @return string
     */
    public static function formatBadResponse(BadResponseException $e)
    {
        return $e->getResponse()->getEffectiveUrl() .
        '.' .
        PHP_EOL .
        'JSON : ' .
        print_r(self::getBadResponseResult($e), true);
    }

    /**
     * @param BadResponseException $e
     * @return mixed
     */
    public static function getBadResponseResult(BadResponseException $e)
    {
        return $e->getResponse()->json();
    }

    /**
     * @return mixed|null
     */
    public function getResult()
    {
        return $this->result;
    }

    /**
     * @param mixed|null $result
     */
    public function setResult($result)
    {
        $this->result = $result;
    }
}
