<?php

namespace OTT\Api\Filter;

/**
 * Class Users
 * @package OTT\Api\Filter
 * @url : http://developer.axosoft.com/api/users.html#!/users/
 */
class Users extends FilterAbstract
{
    /** @var int */
    private $id = null;
    /** @var string */
    private $search_string = null;
    /** @var bool */
    private $include_inactive = true;

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

    /**
     * @return boolean
     */
    public function isIncludeInactive()
    {
        return $this->include_inactive;
    }

    /**
     * @param boolean $include_inactive
     */
    public function setIncludeInactive($include_inactive)
    {
        $this->include_inactive = $include_inactive;
    }

    /**
     * @return string
     */
    public function getSearchString()
    {
        return $this->search_string;
    }

    /**
     * @param string $search_string
     */
    public function setSearchString($search_string)
    {
        $this->search_string = $search_string;
    }
}
