<?php

namespace OTT\Api\Filter;

/**
 * Class Teams
 * @package OTT\Api\Filter
 * @url : http://developer.axosoft.com/api/teams.html#!/teams/
 */
class Teams extends FilterAbstract
{
    /** @var int */
    private $id = null;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
}
